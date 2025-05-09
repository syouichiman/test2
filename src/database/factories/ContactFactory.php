<?php

namespace Database\Factories;

use App\Models\Contact;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    protected $model = Contact::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $category = Category::inRandomOrder()->first();

        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'gender' => $this->faker->randomElement([1, 2, 3]),
            'email' => $this->faker->unique()->safeEmail(),
            'tel' => $this->faker->numberBetween(10000, 99999),
            'address' => $this->faker->address(),
            'building' => $this->faker->optional()->secondaryAddress(),
            'detail' => $this->faker->realText(100),
            'category_id' => $category ? $category->id : 1,
        ];
    }
}
