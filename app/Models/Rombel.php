<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Support\Str;

class Rombel extends Model
{

    // Specify the primary key
    protected $primaryKey = 'id';
    // Define the key type as UUID
    protected $keyType = 'string';
    // Disable incrementing for UUIDs
    public $incrementing = false;
    // Generate UUID before saving the model
    // protected static function boot()
    // {
    //     parent::boot();
    //     static::creating(function ($model) {
    //         $model->id = Uuid::uuid4()->toString();
    //     });
    // }
    // Other model code...
    // techsolutionstuff.com



    use HasUuids;
    // public $incrementing = false;
    // protected $primaryKey = 'id';
    // public $incrementing = false;
    // protected $keyType = 'string';
    // protected $primaryKey = 'id';
    // protected $guarded = [];

    // public static function boot() {
    //     parent::boot();

    //     static::creating(function ($model) {
    //         $model->id = Str::uuid();
    //     });
    // }

    // protected static function boot()
    // {
    //     parent::boot();
    //     static::creating(function ($model) {
    //         $model->uuid = (string) Str::uuid();
    //     });
    // }

    public function walas(){
        return $this->belongsTo(User::class, 'walas_id', 'id');
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
}
