<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Cats;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;


    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1,10),
            'postTitle' => $this->faker->realText($maxNbChars = 40, $indexSize = 2),
            'postContent' => $this->faker->realText($maxNbChars = 1024, $indexSize = 2),
            'score' => $this->faker->numberBetween(1,10),
            'cat' => route('api.cats.get'),
        ];
    }
}
