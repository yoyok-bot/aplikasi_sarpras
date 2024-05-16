<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kembali extends Model
{
    protected $guarded = [''];
    protected $table = 'tb_kembalis';
    protected $primaryKey = 'id';
    protected $fillable = ['id','kdtransaksi','tglkembali','jumlahkembali','tglkonfirmasi','statuskembali'];
}
