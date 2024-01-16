<?php

namespace Database\Factories;

use App\Models\Post; // Import the 'Post' class from the correct namespace
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User; // Import the 'User' class from the correct namespace

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->sentence();

        $slug = Str::slug($title);
        $content = $this->faker->text(2000);
        $type = $this->faker->randomElement([Post::TYPE_PRIVATE, Post::TYPE_PUBLIC]);
        if($type == Post::TYPE_PUBLIC){
            $published_at = $this->faker->dateTimeBetween('-1 year');
        }


        return [
            'title' => $title,
            'slug' => $slug,
            'content' => $content,
            'type' => $type,
            'published_at' => $published_at ?? null,
            'user_id' => User::Factory(),
            //
        ];
    }
}
