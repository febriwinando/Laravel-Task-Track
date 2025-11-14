<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal',
        'pegawai_id',
        'kegiatan_id',
        'lokasi_id',
        'keterangan'
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class);
    }
    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class);
    }
}
