<?php

namespace App\Models\BaselineStyles;

use App\Models\BaseEloquentModel;

class BaselineStyles extends BaseEloquentModel 
{
    protected $table = 'baseline_styles';
	protected $fillable = array('name', 'value');
	
	public function text()
	{
		return $this->belongsTo('App\Models\Texts\Text');
	}
}
