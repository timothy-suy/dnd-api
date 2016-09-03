<?php

namespace App\Models\Paths;

use App\Models\BaseEloquentModel;

class Path extends BaseEloquentModel 
{
    protected $table = 'paths';
	protected $fillable = array('name', 'width', 'height', 'parts');
	
	public function lineStyle()
	{
		return $this->hasOne('App\Models\LineStyles\LineStyle');
	}
	
	public function strokeStyle()
	{
		return $this->hasOne('App\Models\StrokeStyles\StrokeStyle');
	}
	
	public function fillStyle()
	{
		return $this->hasOne('App\Models\FillStyles\FillStyle');
	}
	
	public function shadowStyle()
	{
		return $this->hasOne('App\Models\ShadowStyles\ShadowStyle');
	}
}
