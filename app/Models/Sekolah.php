<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use App\Traits\GenUuid;
class Sekolah extends Model
{
    // use HasFactory;
    // use GenUuid;

    // protected $table = 'sekolah';
    // protected $primaryKey = 'sekolah_id';
    // public $incrementing = false;
    // protected $keyType = 'string';
    protected $guarded = [];

    public function kepsek(){
        return $this->belongsTo(User::class, 'guru_id', 'id');
    }
}
