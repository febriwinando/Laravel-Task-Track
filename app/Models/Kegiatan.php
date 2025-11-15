<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'task',
        'keterangan',
        'status',
        'created_by', 'created_ip',
        'updated_by', 'updated_ip',
    ];

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}
