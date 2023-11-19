<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\HistoryTestResource;
use App\Http\Resources\UserResource;
use App\Models\HistoryTest;
use App\Models\SolvedQuestion;
use App\Models\TestResult;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResultTestController extends Controller
{
    public function insert(Request $request)
    {
        DB::beginTransaction();
        //save request on text file public
        // $myfile = fopen("result.txt", "w") or die("Unable to open file!");
        // $txt = json_encode($request->all());
        // fwrite($myfile, $txt);
        // fclose($myfile);



        try {
            $userId = auth()->user()->id;
            $result = new HistoryTest();
            $result->user_id = $userId;
            $result->category_question_id = $request->category_id;
            $result->amount_question = $request->amount_question;
            $result->score = $request->score;
            $result->duration = $request->duration;
            $result->rank = $request->score - ($request->duration/100);
            $result->save();

            foreach ($request->questions as $key => $value) {
                $question = SolvedQuestion::where('question_id', $value)->where('user_id',$userId)->first();
                if($question){
                    $question->question_id = $value;
                    $question->user_id = $userId;
                    $question->is_correct = $request->answers[$key];
                    $question->save();
                }else{
                    $question = new SolvedQuestion();
                    $question->question_id = $value;
                    $question->user_id = $userId;
                    $question->is_correct = $request->answers[$key];
                    $question->save();
                }
            }

            DB::commit();
            $data = HistoryTestResource::collection(HistoryTest::where('id', $result->id)->with(['category'])->get());
            return ResponseFormatter::success($data, 'Success', 'single');
        } catch (\Exception $e) {
            DB::rollBack();
            return ResponseFormatter::error('', $e->getMessage(), 500);
        }
    }

    public function getResult()
    {
        try {
            $data = HistoryTestResource::collection(HistoryTest::where('user_id', auth()->user()->id)->orderBy('id','desc')->with(['category'])->get()->take(10));
            return ResponseFormatter::success($data, 'Success', 200);
        } catch (\Exception $e) {
            return ResponseFormatter::error('', $e->getMessage(), 500);
        }

    }

    public function getLeaderboard()
    {
        try {
            $result = HistoryTest::query();

            // $result = $result->orderBy('rank','desc')->get();
            // dd($result);
            $query = request()->query();
            if(isset($query['category_id']) && $query['category_id'] != 0){
                $category = $query['category_id'];
                $user = User::where('status',1)->with('rank',function($query)use($category){
                    $query->orderBy('rank','desc')->where('category_question_id', $category)->where('reset',0);
                })->whereHas('rank',function($query)use($category){
                    $query->where('category_question_id', $category)->where('reset',0);
                })->get();
                $user = $user->sortByDesc('rank.rank');
                //get index user in $user
                $rank = 0;
                $id = 0;
                $i = 1;
                $rankNumber = [];
                foreach ($user as $key => $value) {
                    if($value->id == auth()->user()->id){
                        $rank = $i;
                        $id = $value->rank->id;
                        $rankNumber[] = $i;
                    }else if($i<=10){
                        $rankNumber[] = $i;
                    }
                    $i++;
                }
                $user = $user->take(10)->pluck('rank.id')->toArray();
                if($rank > 10){
                    array_push($user, $id);
                }
                $result = $result->whereIn('id', $user)->orderBy('rank','desc')->get();
                foreach ($result as $key => $value) {
                    $value->rank_number = $rankNumber[$key];
                }
            }
            $data = HistoryTestResource::collection($result);
            return ResponseFormatter::success($data, 'Success', 200);
        } catch (\Exception $e) {
            return ResponseFormatter::error('', $e->getMessage(), 500);
        }

    }
    public function updateLeaderboard(){

        $result = HistoryTest::where('reset',0)->get();
        foreach ($result as $key => $value) {
            $value->rank = $value->score - ($value->duration/100);
            $value->save();
        }
        return response()->json([
          'message' => 'Success'
        ]);
      }


    public function resetLeaderboard (){

      $result = HistoryTest::where('reset',0)->update(['reset' => 1]);
      return response()->json([
        'message' => 'Success'
      ]);
    }


    public function getBestPlayer ($categoryId){
        $users = User::where('status',1)->whereHas('solvedQuestion',function($query)use($categoryId){
            $query->whereHas('question',function($query)use($categoryId){
                $query->where('category_id',$categoryId);
            })->where('is_correct',1);
        })->withCount(['solvedQuestion'=>function($query)use($categoryId){
            $query->whereHas('question',function($query)use($categoryId){
                $query->where('category_id',$categoryId);
            })->where('is_correct',1);
        }])->orderBy('solved_question_count','desc')->get()->take(3);
        $user = UserResource::collection($users);
        return ResponseFormatter::success($user, 'Success', 200);
    }
}
