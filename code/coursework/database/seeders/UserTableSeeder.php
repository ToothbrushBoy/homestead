<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $u = new User;
        $u->name = "Test Admin User";
        $u->email = "admin@test.com";
        $u->admin = True;
        $u->password = Hash::make("12345678");
        $u->save();

        'App\Models\User'::factory()->count(14)->create();
    }
}
