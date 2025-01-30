<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jurnal extends Model
{
    protected $guarded = [];


    public function rombel(){
        return $this->belongsTo(Rombel::class, 'rombel_id', 'id');
    }
}
