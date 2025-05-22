<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bunga extends Model
{
    protected $table = 'bungas';
    protected $primaryKey = 'id_bunga';

    protected $fillable = [
        'bunga',
    ];
}
