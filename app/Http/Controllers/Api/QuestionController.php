<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategoryQuestion;
use App\Models\Question;
use App\Providers\UserActivity;

class QuestionController extends Controller
{
    public function getAllQuestionByCategory($id)
    {
        $questions = Question::where('status', 1)->where('category_id',$id)->get();
        $amount_question = $questions[0]->category->amount_question;
        $questions = $questions->random($amount_question);
        $number =0;
        foreach ($questions as $key => $question) {
            $number++;
            $question->number = $number;
            $question->options;
            $question->image_url = $question->image? url('storage/'.$question->image) : '';
            $question->category_name = $question->category->name;
        }
        event(new UserActivity(auth()->user()->id, 'Test '.$questions[0]->category->name,request()->ip()));
        return ResponseFormatter::success($questions, 'Success', 200);
    }


    public function getAllCategory()
    {
        $categories = CategoryQuestion::where('status', 1)->get();
        return ResponseFormatter::success($categories, 'Success', 200);
    }





}
