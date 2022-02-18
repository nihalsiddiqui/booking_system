<?php


    namespace Modules\Train\Models;


    use App\BaseModel;
    use Illuminate\Database\Eloquent\SoftDeletes;

    class SeatType extends BaseModel
    {
        use SoftDeletes;
        protected $table = 'bravo_train_seat_type';
        protected $fillable  = ['name','code'];

    }
