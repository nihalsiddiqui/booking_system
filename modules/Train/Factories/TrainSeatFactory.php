<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Train\Models\TrainModel;
use Modules\Train\Models\TrainSeat;
use Modules\Train\Models\SeatType;

class TrainSeatFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TrainSeat::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $persons=['adult','child'];
        return [
            'seat_type'=>"",
            'train_id'=>"",
            'price'=>$this->faker->numberBetween(10,99),
            'max_passengers'=>$this->faker->numberBetween(1,20),
            'person'=>$this->faker->randomElement($persons),
            'baggage_check_in'=>$this->faker->numberBetween(10,15),
            'baggage_cabin'=>$this->faker->numberBetween(3,7),
        ];
    }
}
