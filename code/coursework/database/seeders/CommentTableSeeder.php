<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Comment;

class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        'App\Models\Comment'::factory()->count(300)->create();
        'App\Models\Comment'::factory()->count(100)->create(['commentable_type' => "App\Models\Comment"]);
    }
}
