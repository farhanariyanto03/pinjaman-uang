<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InformasiPribadi extends Model
{
    protected $table = 'informasi_pribadis';
    protected $primaryKey = 'id_informasi_pribadi';
    protected $fillable = ['id_user', 'foto_ktp', 'foto_kk', 'foto_user'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
