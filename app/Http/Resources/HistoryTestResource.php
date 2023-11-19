<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HistoryTestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => (int)$this->id,
            'user_id' => (int)$this->user_id,
            'category'=> $this->category->name,
            'name' => $this->user->name,
            'image_url' => $this->user->photo_url && $this->user->photo_url != "null"?$this->user->photo_url :  url('profil.png'),
            'amount_question' => (int)$this->amount_question,
            'duration' => (float)$this->duration,
            'score' => (int)$this->score,
            'rank' => (int)$this->rank_number,
            'correct' => (int)$this->score / 100 * $this->amount_question,
            'wrong' => (int)$this->amount_question - ($this->score / 100 * $this->amount_question),
            'created_at' => $this->created_at->format('d-m-Y H:i:s'),
        ];
    }
}
