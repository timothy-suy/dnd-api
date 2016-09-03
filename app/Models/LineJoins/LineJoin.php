<?php

namespace App\Models\LineJoins;

use App\Models\BaseEloquentModel;

class LineJoin extends BaseEloquentModel 
{
    protected $table = 'line_joins';
	protected $fillable = array('name', 'value');

	public function lineStyle()
	{
		return $this->belongsTo('App\Models\LineStyles\LineStyle');
	}
}
