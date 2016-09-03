<?php

namespace App\Models\Texts;

use App\Models\BaseEloquentModel;

class Text extends BaseEloquentModel 
{
    protected $table = 'texts';
	protected $fillable = array('value');
	
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
	
	public function alignStyle()
	{
		return $this->hasOne('App\Models\AlignStyles\AlignStyle');
	}
	
	public function baselineStyle()
	{
		return $this->hasOne('App\Models\BaselineStyles\BaselineStyle');
	}
}
