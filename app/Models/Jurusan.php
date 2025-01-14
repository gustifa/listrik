<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class, 'ka_proka_id', 'id');
    }
    public function proka(){
        return $this->belongsTo(Proka::class, 'proka_id', 'id');
    }
}
