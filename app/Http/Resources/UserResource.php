<?php

namespace App\Http\Resources;

use App\Models\CategoryQuestion;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $category = CategoryQuestion::where('status',1)->get();
        $scores = [];
        foreach ($category as $key => $value) {
            $scores[] = [
                'id' => (int) $value->id,
                'category' => $value->name,
                'total_question'=> $value->questions()->where('status',1)->count(),
                'correct' => $this->solvedQuestion?$this->solvedQuestion()->whereHas('question', function($query) use ($value){
                    $query->where('category_id',$value->id);
                })->where('is_correct', 1)->count() : 0,
                'total' => $this->solvedQuestion?$this->solvedQuestion()->whereHas('question', function($query) use ($value){
                    $query->where('category_id',$value->id);
                })->count():0,
            ];
        }
        return [
        "id"=> $this->id,
        "name"=> $this->name,
        "energy"=> (int) $this->energy,
        "username"=> $this->username,
        "image_url"=> $this->photo_url && $this->photo_url != "null" ? $this->photo_url : url('profil.png'),
        "email"=> $this->email,
        "created_at"=> $this->created_at->format('d F Y'),
        "google_id"=> $this->google_id,
        'correct_answer' =>  $this->solvedQuestion? $this->solvedQuestion()->where('is_correct', 1)->count() : 0,
        'answer' =>  $this->solvedQuestion?$this->solvedQuestion()->count() : 0,
        'group_category' => $scores
        ];
    }
}
