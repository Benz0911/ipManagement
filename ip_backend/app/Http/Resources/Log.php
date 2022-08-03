<?php

namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class Log extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $type_name = ['','logged_in','addition','update'];

        return [
            'new_data'=>$this->new_data !='' ? json_decode($this->new_data,1):'',
            'prev_data'=>$this->prev_data !='' ? json_decode($this->prev_data,1):'',
            'type'=>$type_name[$this->type],

        ];
    }
}
