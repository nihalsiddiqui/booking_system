<?php


    namespace Modules\Train\Models;


    use Illuminate\Database\Eloquent\SoftDeletes;
    use Modules\Booking\Models\Bookable;
    use Modules\Booking\Models\Booking;

    class BookingPassengers extends Bookable
    {
        use SoftDeletes;
        protected $slugField = false;
        protected $slugFromField = false;
        protected $table ='booking_passengers_train';
        protected $fillable = [
            'train_id',
            'train_seat_id',
            'booking_id',
            'seat_type',
            'email',
            'first_name',
            'last_name',
            'phone',
            'dob',
            'price',
            'id_card'
        ];
        public function booking(){
            return $this->belongsTo(Booking::class,'booking_id');
        }
    }
