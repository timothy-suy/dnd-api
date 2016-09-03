<?php

namespace App\Models\StrokeStyles;

use App\Models\BaseEloquentModel;

class StrokeStyle extends BaseEloquentModel 
{
    protected $table = 'stroke_styles';
	protected $fillable = array('color', 'gradient', 'pattern');
	
	public function path()
	{
		return $this->belongsTo('App\Models\Paths\Path');
	}
	
	public function text()
	{
		return $this->belongsTo('App\Models\Texts\Text');
	}
}
