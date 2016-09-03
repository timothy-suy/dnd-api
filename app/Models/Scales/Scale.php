<?php

namespace App\Models\Scales;

use App\Models\BaseEloquentModel;

class Scale extends BaseEloquentModel 
{
    protected $table = 'scales';
	protected $fillable = array('width', 'height');
	
	public function transformation()
	{
		return $this->belongsTo('App\Models\Transformations\Transformation');
	}
}
