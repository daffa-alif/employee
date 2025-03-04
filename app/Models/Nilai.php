<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Nilai extends Model
{
    use HasFactory;

    protected $table = 'nilais';

    protected $fillable = [
        'id_berkas',
        'average_sertime',
        'average_waittime',
        'average_supel',
        'ceklis_pelayanan',
        'status',
    ];

    // Relasi ke BerkasEmployee (Many to One)
    public function berkasEmployee(): BelongsTo
    {
        return $this->belongsTo(BerkasEmployee::class, 'id_berkas');
    }
}
