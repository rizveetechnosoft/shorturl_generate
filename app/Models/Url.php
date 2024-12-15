<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    //
    protected $fillable = ['long_url', 'short_url'];
    public function definition()
    {
        return [
            'long_url' => $this->faker->url,
            'short_url' => $this->faker->unique()->word,
        ];
    }
    public function testStoreUrl()
    {
        // Create a test URL using the factory
        $url = Url::factory()->create();

        // Your test code goes here
    }

}
