<?php

namespace App\Models\Rotations;

use App\Models\BaseEloquentModel;

class Rotation extends BaseEloquentModel 
{
    protected $table = 'rotations';
	protected $fillable = array('angle');
	
	public function transformation()
	{
		return $this->belongsTo('App\Models\Transformations\Transformation');
	}
}
