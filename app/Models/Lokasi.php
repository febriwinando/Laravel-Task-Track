<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    protected $fillable = [
        'building',
        'floor',
        'ssid',
        'ip_wifi',
        'status',
        'created_by', 'created_ip',
    ];


    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}
