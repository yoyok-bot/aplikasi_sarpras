<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{

    protected $table = 'tb_barangs';
    protected $primaryKey = 'id';
    protected $fillable = ['kd_barang','no_urut','nama_barang','merk','tahun_perolehan','status','jumlah','anggaran','id_ruangan','update_at','create_at'];
    public $keyType = 'int';
    public function ruang()
    {
        return $this->belongsTo('App\Models\Ruangan','id_ruangan','id');
    }
}

