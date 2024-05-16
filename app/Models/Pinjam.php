<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pinjam extends Model
{
    protected $guarded = [''];
    protected $table = 'tb_pinjams';
    protected $primaryKey = 'id';
    protected $fillable = ['id','kdtransaksi','tglpinjam','jumlahpinjam','statuspinjam','id_user','id_barang','id_kembali'];
    public function barang()
    {
        return $this->belongsTo('App\Models\Barang','id_barang','id');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User','id_user','id');
    }
    public function kembali()
    {
        return $this->belongsTo('App\Models\Kembali','id_kembali','id');
    }
}
