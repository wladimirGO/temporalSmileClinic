<?php

namespace Database\Factories;

use App\Models\Appointment;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Laravel\Jetstream\Features;
use App\Models\User;

class AppointmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Appointment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        return [
            'hour' => $this->faker->time($format = 'H:i',$min='8:30', $max = '18:00'),
            'date' => $this->faker->dateTimeBetween($startDate = '-9 months', $endDate = 'now'),
            'total' => $this->faker->numberBetween($min = 40, $max = 2000),
            'patient_id' => Patient::all()->random()->id,
            'user_id' => User::all()->random()->id,
        ];
        
    }
}
