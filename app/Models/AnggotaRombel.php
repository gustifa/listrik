<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class AnggotaRombel extends Model
{
    protected $guarded = [];
    use HasUuids;

    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'id';

    public function peserta_didik(){
        return $this->belongsTo(User::class, 'siswa_id', 'id');
    }

    public function rombel(){
        return $this->belongsTo(Rombel::class, 'rombel_id', 'id');
    }

    public function walas(){
        return $this->belongsTo(User::class, 'walas_id', 'id');
    }

}
