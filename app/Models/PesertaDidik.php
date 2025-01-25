<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PesertaDidik extends Model
{
    use HasFactory, SoftDeletes;
    // public $incrementing = false;
	// public $keyType = 'string';
	//protected $table = 'peserta_didiks';
	// protected $primaryKey = 'peserta_didik_id';
	// protected $guarded = [];
	// protected $appends = ['tanggal_lahir_indo'];


    public function pekerjaan_ayah(){
		return $this->hasOne(Pekerjaan::class, 'pekerjaan_id', 'kerja_ayah');
	}
	public function pekerjaan_ibu(){
		return $this->hasOne(Pekerjaan::class, 'pekerjaan_id', 'kerja_ibu');
	}
	public function pekerjaan_wali(){
		return $this->hasOne(Pekerjaan::class, 'pekerjaan_id', 'kerja_wali');
	}
}
