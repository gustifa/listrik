<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Support\Facades\DB;

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

    public static function anggotaRombel(){
        $anggota_rombel = DB::table('anggota_rombels')->select('rombel_id')->groupBy('rombel_id')->get();
        return $anggota_rombel;
    }

    

}
