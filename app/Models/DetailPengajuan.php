<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPengajuan extends Model
{
    protected $table = 'detail_pengajuans';
    protected $primaryKey = 'id_detail_pengajuan';
    protected $fillable = ['id_pengajuan_pinjaman', 'tujuan_pinjaman', 'alasan_peminjaman'];

    public function pengajuan()
    {
        return $this->belongsTo(PengajuanPinjaman::class, 'id_pengajuan_pinjaman', 'id_pengajuan_pinjaman');
    }
}
