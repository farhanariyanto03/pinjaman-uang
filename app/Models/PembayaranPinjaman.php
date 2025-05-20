<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PembayaranPinjaman extends Model
{
    protected $table = 'pembayaran_pinjamans';
    protected $primaryKey = 'id_pembayaran_pinjaman';
    protected $fillable = ['id_pengajuan_pinjaman', 'jumlah_pembayaran', 'tanggal_pembayaran', 'metode_pembayaran', 'bukti_tf', 'status'];

    public function pengajuan()
    {
        return $this->belongsTo(PengajuanPinjaman::class, 'id_pengajuan_pinjaman', 'id_pengajuan_pinjaman');
    }
}
