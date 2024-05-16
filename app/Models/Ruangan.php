<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    protected $table = 'tb_ruangans';
    protected $primaryKey = 'id';
    protected $fillable = ['ruangan','update_at','create_at'];
    public $keyType = 'int';
}
