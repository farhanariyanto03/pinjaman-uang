<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pinjaman extends Model
{
    protected $table = 'pinjamans';
    protected $primaryKey = 'id_pinjaman';
    protected $fillable = ['id_pinjaman', 'jumlah_uang', 'tenor', 'bunga', 'angsuran_per_bulan', 'jumlah_kotor'];
}
