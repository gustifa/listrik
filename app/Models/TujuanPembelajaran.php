<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TujuanPembelajaran extends Model
{
    protected $guarded = [];

    public function mapel(){
        return $this->belongsTo(Mapel::class, 'mapel_id', 'id');
    }
}
