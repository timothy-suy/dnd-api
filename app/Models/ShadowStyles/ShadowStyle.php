<?php

namespace App\Models\ShadowStyles;

use App\Models\BaseEloquentModel;

class ShadowStyle extends BaseEloquentModel 
{
    protected $table = 'shadow_styles';
	protected $fillable = array('color', 'blur', 'offset_x', 'offset_y');
	
	public function path()
	{
		return $this->belongsTo('App\Models\Paths\Path');
	}
	
	public function text()
	{
		return $this->belongsTo('App\Models\Texts\Text');
	}
}
