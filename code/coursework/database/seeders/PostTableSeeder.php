<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Cats;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Cats $c)
    {
        'App\Models\Post'::factory()->count(20)->create(['cat' => $c->getCat()]);
    }
}
