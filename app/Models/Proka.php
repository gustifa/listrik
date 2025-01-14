<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proka extends Model
{
    protected $guarded = [];

    public function ka_proka(){
        return $this->belongsTo(User::class, 'ka_proka_id', 'id');
    }

    
}
