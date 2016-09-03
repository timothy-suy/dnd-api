<?php

namespace App\Models\Images;

use App\Models\BaseEloquentModel;

class Image extends BaseEloquentModel 
{
    protected $table = 'images';
	protected $fillable = array('name', 'source', 'x', 'y', 'width', 'height', 'source_x', 'source_y', 'source_width', 'source_height');
}
