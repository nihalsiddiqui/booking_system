<?php

namespace Modules\Train\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Log;
use Modules\Flight\Models\Airline;
use Modules\Flight\Models\Airport;
use Modules\Train\Models\CompanyTrain;
use Modules\Train\Models\Stations;
use Modules\Train\Models\TrainModel;

class TrainFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TrainModel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $departure_time = $this->faker->dateTimeBetween('+1 days','+7 days');
        $duration = $this->faker->numberBetween(1,10);
        $stations = Stations::pluck('id')->toArray();
        $companyTrain = CompanyTrain::pluck('id')->toArray();
        return [
            'title'=>$this->faker->name,
            'code'=>'VJ'.$this->faker->numberBetween(100,1000),
            'departure_time'=>$departure_time->format('Y-m-d H:i:s'),
            'arrival_time'=>$departure_time->add(new \DateInterval("PT{$duration}H"))->format('Y-m-d H:i:s'),
            'duration'=>$duration,
            'airport_from'=>$this->faker->randomElement($stations),
            'airport_to'=>$this->faker->randomElement($stations),
            'company_id'=>$this->faker->randomElement($companyTrain),
            'status'=>'publish',
        ];
    }
}
