<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Pegawai extends Model
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = ['name', 'nik', 'employee_id', 'email', 'nomor_wa', 'level', 'status', 'inactive_reason', 'password', 'foto'];

    protected $hidden = ['password', 'remember_token'];
}
