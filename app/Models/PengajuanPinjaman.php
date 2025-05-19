<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengajuanPinjaman extends Model
{
    protected $table = 'pengajuan_pinjamans';
    protected $primaryKey = 'id_pengajuan_pinjaman';
    protected $fillable = ['id_user', 'jumlah_pinjaman', 'tenor', 'bunga',  'jatuh_tempo', 'status'];

    public function detailPinjaman()
    {
        return $this->belongsTo(DetailPengajuan::class, 'id_pengajuan_pinjaman', 'id_pengajuan_pinjaman');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function pembayaranPinjaman()
    {
        return $this->hasMany(PembayaranPinjaman::class, 'id_pengajuan_pinjaman', 'id_pengajuan_pinjaman');
    }
}
