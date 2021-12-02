<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $table = "tb_buku";
    protected $primaryKey = "id";
    protected $fillable = [
        'no_buku', 'judul_buku', 'keterangan_buku', 'sinopsis_buku', 'pengarang',
        'tanggal_rilis', 'cover_buku'
    ];
    public $timestamps = false;
}
