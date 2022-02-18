<?php

namespace Modules\Train\Models;

use App\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Train\Factories\CompanyFactory;

//use Illuminate\Database\Eloquent\Model;

class CompanyTrain extends BaseModel
{
    use HasFactory;
    use SoftDeletes;

    protected $table ='bravo_company_train';
    protected $fillable = ['name','image_id'];

    protected static function newFactory()
    {
        return CompanyFactory::new();
    }
}
