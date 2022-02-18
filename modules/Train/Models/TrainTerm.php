<?php

namespace Modules\Train\Models;

use App\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;

class TrainTerm extends BaseModel
{
    use HasFactory;

    protected $table = 'bravo_train_term';
    protected $fillable = [
        'term_id',
        'target_id'
    ];
}
