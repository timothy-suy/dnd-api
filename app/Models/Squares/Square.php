<?php

namespace App\Models\Squares;

use App\Models\BaseEloquentModel;

class Square extends BaseEloquentModel 
{
    protected $table = 'squares';
	protected $fillable = array('name', 'width', 'height');
}
