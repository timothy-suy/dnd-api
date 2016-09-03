<?php

namespace App\Models\FillStyles;

use App\Models\BaseEloquentModel;

class FillStyle extends BaseEloquentModel 
{
    protected $table = 'fill_styles';
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
