<?php

namespace Modules\Train\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;

use App\BaseModel;
//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Flight\Factories\AirportFactory;
use Modules\Location\Models\Location;
use Modules\Train\Factories\StationFactory;


class Stations extends BaseModel
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'bravo_stations';

    protected $fillable=[
        'name',
        'code',
        'location_id',
        'description',
        'address',
        'map_lat',
        'map_lng',
        'map_zoom',
    ];

    protected static function newFactory()
    {
        return StationFactory::new();
    }
    public function location(){
        return $this->belongsTo(Location::class,'location_id');
    }


}
