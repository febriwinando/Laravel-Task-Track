<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name'          => 'Administrator',
            'nik'           => '0000000000000001',
            'employee_id'   => 'EMP-ADMIN-001',
            'email'         => 'febri@mail.com',
            'nomor_wa'      => '081234567890',
            'level'         => 'administrator',
            'status'        => 'active',
            'inactive_reason' => null,
            'password'      => Hash::make('1sampai8'),   // ubah jika mau
            'foto'          => null,
            'created_by'    => null,   // karena ini user pertama
            'created_ip'    => '127.0.0.1',
            'updated_by'    => null,
            'updated_ip'    => null,
        ]);

        // Staff Example
        User::create([
            'name'          => 'Staff Satu',
            'nik'           => '0000000000000002',
            'employee_id'   => 'EMP-STAFF-001',
            'email'         => 'nando@mail.com',
            'nomor_wa'      => '089876543210',
            'level'         => 'staff',
            'status'        => 'active',
            'inactive_reason' => null,
            'password'      => Hash::make('1sampai8'),
            'foto'          => null,
            'created_by'    => $admin->id,   // user admin yang membuat
            'created_ip'    => '127.0.0.1',
            'updated_by'    => null,
            'updated_ip'    => null,
        ]);
    }
}
