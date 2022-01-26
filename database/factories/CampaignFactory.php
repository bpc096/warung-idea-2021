<?php

namespace Database\Factories;

use App\Campaign;
use Illuminate\Database\Eloquent\Factories\Factory;

class CampaignFactory extends Factory
{

    /**
     * The name of the factory's coressponding model.
     *
     * @var string
     */

    protected $model = Campaign::class;
    
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'users_id'        => 1,
            'category_id'     => mt_rand(1,6),
            'title'           => $this->faker->sentence(mt_rand(5,8)),
            'slug'            => $this->faker->slug(),
            'target_donation' => $this->faker->numberBetween(10000000,10000000000), 
            'max_date'        => $this->faker->date(),  
            'image'           => $this->faker->image('storage/app/public/campaigns',640,480, null, false),
            'description'     => $this->faker->text()
        ];
    }
}
