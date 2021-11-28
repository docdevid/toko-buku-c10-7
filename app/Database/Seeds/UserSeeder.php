<?php

namespace App\Database\Seeds;

use App\Models\UserModel;
use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        // nama_lengkap
        // no_hp
        // email
        // username
        // password
        // role
        // gambar

        $userModel = new UserModel();
        $userModel->save([
            'username' => 'admin',
            'password' => password_hash('admin', PASSWORD_BCRYPT),
            'role' => 'ADMIN',
            'gambar' => 'default.png',
        ]);
        $userModel->save([
            'nama_lengkap' => 'Risna',
            'no_hp' => '081212121212',
            'email' => 'admin@example.com',
            'username' => 'user2',
            'password' => password_hash('user2', PASSWORD_BCRYPT),
            'role' => 'MEMBER',
            'gambar' => 'default.png',
        ]);
        $userModel->save([
            'nama_lengkap' => 'Risto',
            'no_hp' => '081212121212',
            'email' => 'admin@example.com',
            'username' => 'user3',
            'password' => password_hash('user3', PASSWORD_BCRYPT),
            'role' => 'MEMBER',
            'gambar' => 'default.png',
        ]);
        $userModel->save([
            'nama_lengkap' => 'Rinso',
            'no_hp' => '081212121212',
            'email' => 'admin@example.com',
            'username' => 'user4',
            'password' => password_hash('user4', PASSWORD_BCRYPT),
            'role' => 'MEMBER',
            'gambar' => 'default.png',
        ]);
    }
}
