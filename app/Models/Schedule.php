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
        'keterangan',
        'created_by', 
        'created_ip',
        'updated_by', 
        'updated_ip',
        'verifikasi_pegawai',
        'verifikator_id'
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

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function verifikator()
    {
        return $this->belongsTo(Pegawai::class, 'verifikator_id');
    }


}
