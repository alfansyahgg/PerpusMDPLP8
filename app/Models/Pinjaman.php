<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pinjaman extends Model
{
    use HasFactory;

    protected $table = "tb_pinjam";
    protected $fillable = [
        'id_user', 'id_buku', 'tanggal_pinjam', 'tanggal_kembali'
    ];
    protected $primaryKey = 'id';
    public $timestamps = false;

}
