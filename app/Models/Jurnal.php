<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jurnal extends Model
{
    protected $guarded = [];

    // protected $casts = [
    //     'siswa_id' => 'array',
    //     'kehadiran' => 'array'
    // ];


    public function rombel(){
        return $this->belongsTo(Rombel::class, 'rombel_id', 'id');
    }

    public function peserta_didik(){
        return $this->belongsTo(User::class, 'siswa_id', 'id');
    }

    public function jadwal_guru(){
        return $this->belongsTo(JadwalPelajaran::class, 'jadwal_id', 'id');
    }

    public function tp(){
        return $this->belongsTo(TujuanPembelajaran::class, 'tp_id', 'id');
    }

}
