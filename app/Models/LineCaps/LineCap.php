<?php

namespace App\Models\LineCaps;

use App\Models\BaseEloquentModel;

class LineCap extends BaseEloquentModel 
{
    protected $table = 'line_caps';
	protected $fillable = array('name', 'value');

	public function lineStyle()
	{
		return $this->belongsTo('App\Models\LineStyles\LineStyle');
	}
}
