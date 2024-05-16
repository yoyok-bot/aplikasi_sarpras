<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $guarded = [''];
    protected $table = 'tb_siswas';
    protected $primaryKey = 'id';
    // protected $fillable = ['kd_jabatan','nama_jabatan'];
    public function user()
    {
        return $this->belongsTo('App\Models\User','id_user','id');
    }
}
