<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InformasiPribadi extends Model
{
    protected $table = 'informasi_pribadia';
    protected $primaryKey = 'id_informasi_pribadi';
    protected $fillable = ['id_user', 'foto_ktp', 'foto_kk', 'foto_user'];
}
