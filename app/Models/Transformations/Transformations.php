<?php

namespace App\Models\Transformations;

use App\Models\BaseEloquentModel;

class Transformation extends BaseEloquentModel 
{
    protected $table = 'transformations';
	protected $fillable = array('name');
	
	public function scale()
	{
		return $this->hasOne('App\Models\Scales\Scale');
	}
	
	public function rotation()
	{
		return $this->hasOne('App\Models\Rotations\Rotation');
	}
	
	public function translation()
	{
		return $this->hasOne('App\Models\Translations\Translation');
	}
}
