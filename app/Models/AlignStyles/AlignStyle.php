<?php

namespace App\Models\AlignStyles;

use App\Models\BaseEloquentModel;

class AlignStyles extends BaseEloquentModel 
{
    protected $table = 'align_styles';
	protected $fillable = array('name', 'value');
	
	public function text()
	{
		return $this->belongsTo('App\Models\Texts\Text');
	}
}
