<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;

    protected $table = 'nilais';

    protected $fillable = [
        'average_sertime',
        'average_waittime',
        'average_supel',
        'ceklis_pelayanan',
        'status',
    ];
}
