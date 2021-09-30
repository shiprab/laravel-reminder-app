<?php

namespace Database\Factories;

use App\Models\Reminder;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ReminderFactory extends Factory
{
/**
 * The name of the factory's corresponding model.
 *
 * @var string
 */
    protected $model = Reminder::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'description' => $this->faker->sentence,
            'reminder_date' => '2021-12-08'
        ];
    }
}
