<?php

namespace Modules\Train\Factories;

//use App\Models\Model;
//use Illuminate\Database\Eloquent\Factories\Factory;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use Modules\Train\Models\CompanyTrain;
use Modules\Media\Models\MediaFile;

class CompanyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CompanyTrain::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $imgAirLineImage = DB::table('media_files')->where('file_name','like','airline-%')->get()->pluck(['id'])->toArray();
        return [
            'name'=>$this->faker->city,
            'image_id'=>$this->faker->randomElement($imgAirLineImage)
        ];
    }
}
