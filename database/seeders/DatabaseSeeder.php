<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Real staff login, pulled from the live navy02_sportswh database via Plesk.
        // Username: admin / Password: password
        DB::table('user')->insert([
            'userId' => 1,
            'userName' => 'admin',
            'password' => '$2y$12$hL6Hyzratvi0ACQLeOkGhOvv89twUDSMnH1kXeYvtgcetZ3jfbg9W',
        ]);

        $this->call(CategoryItemSeeder::class);
        $this->call(OrderSeeder::class);
    }
}
