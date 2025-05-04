<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengajuanPinjaman extends Model
{
    protected $table = 'pengajuan_pinjamans';
    protected $primaryKey = 'id_pengajuan_pinjaman';
    protected $fillable = ['id_pinjaman', 'id_user', 'jatuh_tempo', 'status'];
}
