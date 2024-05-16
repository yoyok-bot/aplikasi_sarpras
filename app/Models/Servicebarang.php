<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicebarang extends Model
{
    protected $guarded = [''];
    protected $table = 'tb_barangperbaikans';
    protected $primaryKey = 'id';
    protected $fillable = ['id','jumlahperbaikan','status','keterangan','id_barang'];
    public function barang()
    {
        return $this->belongsTo('App\Models\Barang','id_barang','id');
    }
}
