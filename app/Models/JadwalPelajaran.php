<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalPelajaran extends Model
{
    protected $guarded = [];

    public function rombel(){
        return $this->belongsTo(Rombel::class, 'rombel_id', 'id');
    }

    public function waktu_mulai(){
        return $this->belongsTo(Waktu::class, 'mulai_id', 'id');
    }

    public function waktu_selesai(){
        return $this->belongsTo(Waktu::class, 'selesai_id', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function mapel(){
        return $this->belongsTo(Mapel::class, 'mapel_id', 'id');
    }
    public function kelas(){
        return $this->belongsTo(Kelas::class, 'kelas_id', 'id');
    }

    public function jurusan(){
        return $this->belongsTo(Jurusan::class, 'jurusan_id', 'id');
    }

    public function group(){
        return $this->belongsTo(Group::class, 'group_id', 'id');
    }

    public function hari(){
        return $this->belongsTo(Hari::class, 'hari_id', 'id');
    }
}
