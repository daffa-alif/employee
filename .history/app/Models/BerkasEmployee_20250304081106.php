<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BerkasEmployee extends Model
{
    use HasFactory;

    protected $table = 'berkas_employees';

    protected $fillable = [
        'id_user',
        'nama_lengkap',
        'foto_user',
        'NIK',
        'jenis_kelamin',
        'email',
        'alamat',
    ];

    /**
     * Relasi ke tabel users
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
