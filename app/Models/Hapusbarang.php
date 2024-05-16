<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hapusbarang extends Model
{
    protected $guarded = [''];
    protected $table = 'tb_barangrusaks';
    protected $primaryKey = 'id';
    protected $fillable = ['id','jumlahrusak','status','id_barang'];
    public function barang()
    {
        return $this->belongsTo('App\Models\Barang','id_barang','id');
    }
}
