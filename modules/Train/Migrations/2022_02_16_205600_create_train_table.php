<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Train\Models\TrainModel;
use Modules\Train\Models\TrainTerm;
use Modules\Train\Models\Stations;
use Modules\Train\Models\SeatType;
use Modules\Train\Models\TrainSeat;
use Modules\Train\Models\BookingPassengers;
use Modules\Train\Models\CompanyTrain;
class CreateTrainTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->down();
        Schema::create(TrainTerm::getTableName(), function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('term_id')->nullable();
            $table->integer('target_id')->nullable();
            $table->bigInteger('create_user')->nullable();
            $table->bigInteger('update_user')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create(Stations::getTableName(), function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('code')->unique();
            $table->string('address')->nullable();
            $table->integer('location_id')->nullable();
            $table->text('description')->nullable();
            $table->string('map_lat', 20)->nullable();
            $table->string('map_lng', 20)->nullable();
            $table->integer('map_zoom')->nullable();
            $table->bigInteger('create_user')->nullable();
            $table->bigInteger('update_user')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create(CompanyTrain::getTableName(), function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->integer('image_id')->nullable();
            $table->bigInteger('create_user')->nullable();
            $table->bigInteger('update_user')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create(SeatType::getTableName(), function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->unique();
            $table->string('name')->nullable();
            $table->bigInteger('create_user')->nullable();
            $table->bigInteger('update_user')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create(TrainSeat::getTableName(), function (Blueprint $blueprint) {
            $blueprint->engine = 'InnoDB';
            $blueprint->bigIncrements('id');
            $blueprint->decimal('price', 12, 2)->nullable();
            $blueprint->integer('max_passengers')->nullable();
            $blueprint->integer('train_id')->nullable();
            $blueprint->string('seat_type')->nullable();
            $blueprint->string('person')->nullable();
            $blueprint->integer('baggage_check_in')->nullable();
            $blueprint->integer('baggage_cabin')->nullable();


            $blueprint->bigInteger('create_user')->nullable();
            $blueprint->bigInteger('update_user')->nullable();
            $blueprint->timestamps();
            $blueprint->softDeletes();
        });
        Schema::create(TrainModel::getTableName(), function (Blueprint $blueprint) {
            $blueprint->engine = 'InnoDB';
            $blueprint->bigIncrements('id');
            $blueprint->string('title')->nullable();
            $blueprint->string('code')->nullable();
            $blueprint->decimal('review_score',2,1)->nullable();
            $blueprint->dateTime('departure_time')->nullable();
            $blueprint->dateTime('arrival_time')->nullable();
            $blueprint->float('duration')->nullable();
            $blueprint->decimal('min_price', 12, 2)->nullable();
            $blueprint->integer('airport_to')->nullable();
            $blueprint->integer('airport_from')->nullable();
            $blueprint->integer('company_id')->nullable();
            $blueprint->string('status', 50)->nullable();

            $blueprint->bigInteger('create_user')->nullable();
            $blueprint->bigInteger('update_user')->nullable();
            $blueprint->timestamps();
            $blueprint->softDeletes();
        });

        Schema::create(BookingPassengers::getTableName(), function (Blueprint $blueprint) {
            $blueprint->engine = 'InnoDB';

            $blueprint->bigIncrements('id');
            $blueprint->integer('train_id')->nullable();
            $blueprint->integer('train_seat_id')->nullable();
            $blueprint->integer('booking_id')->nullable();
            $blueprint->string('seat_type')->nullable();
            $blueprint->string('email')->nullable();
            $blueprint->string('first_name')->nullable();
            $blueprint->string('last_name')->nullable();
            $blueprint->string('phone')->nullable();
            $blueprint->dateTime('dob')->nullable();
            $blueprint->decimal('price', 12, 2)->nullable();
            $blueprint->string('id_card')->nullable();


            $blueprint->bigInteger('create_user')->nullable();
            $blueprint->bigInteger('update_user')->nullable();
            $blueprint->timestamps();
            $blueprint->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(TrainModel::getTableName());
        Schema::dropIfExists(TrainTerm::getTableName());
        Schema::dropIfExists(Stations::getTableName());
        Schema::dropIfExists(CompanyTrain::getTableName());
        Schema::dropIfExists(SeatType::getTableName());
        Schema::dropIfExists(TrainSeat::getTableName());
        Schema::dropIfExists(BookingPassengers::getTableName());
    }
}
