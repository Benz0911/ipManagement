<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    public $fillable = ['user_id',
                        'ip_id',
                        'type',
                        'prev_data',
                        'new_data',
                       ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function ip(){
        return $this->belongsTo(Ip::class);
    }
}
