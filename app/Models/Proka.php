<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proka extends Model
{
    protected $guarded = [];

    public function proka(){
        return $this->belongsTo(User::class, 'proka_id', 'id');
    }
}
