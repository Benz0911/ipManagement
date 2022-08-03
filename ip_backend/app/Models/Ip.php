<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ip extends Model
{
    public $fillable = ['ip',
                        'label'];

    public function log(){
        return $this->hasMany(Log::class);
    }
}
