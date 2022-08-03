<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;
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
        $createdAt = Carbon::parse($this->created_at);
        $type_name = ['','logged_in','Add','Update'];

        return [
            'new_data'=>$this->new_data !='' ? json_decode($this->new_data,1):'',
            'prev_data'=>$this->prev_data !='' ? json_decode($this->prev_data,1):'',
            'type'=>$type_name[$this->type],
            'name'=>$this->user->name,
            'audit_date'=>$createdAt->toDayDateTimeString()
        ];
    }
}
