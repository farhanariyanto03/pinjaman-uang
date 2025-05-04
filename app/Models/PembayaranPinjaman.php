<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PembayaranPinjaman extends Model
{
    protected $table = 'pembayaran_pinjamans';
    protected $primaryKey = 'id_pembayaran_pinjaman';
    protected $fillable = ['id_pinjaman', 'id_user', 'jumlah_pembayaran', 'tanggal_pembayaran', 'metode_pembayaran', 'status'];
}
