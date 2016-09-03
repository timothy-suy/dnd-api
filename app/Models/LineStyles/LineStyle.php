<?php

namespace App\Models\LineStyles;

use App\Models\BaseEloquentModel;

class LineStyle extends BaseEloquentModel 
{
    protected $table = 'line_styles';
	protected $fillable = array('line_width', 'miter_limit');
	
	public function lineJoin()
	{
		return $this->hasOne('App\Models\LineJoins\LineJoin');
	}
	
	public function lineCap()
	{
		return $this->hasOne('App\Models\LineCaps\LineCap');
	}
	
	public function path()
	{
		return $this->belongsTo('App\Models\Paths\Path');
	}
}
