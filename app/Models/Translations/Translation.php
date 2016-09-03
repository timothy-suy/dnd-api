<?php

namespace App\Models\Translations;

use App\Models\BaseEloquentModel;

class Translation extends BaseEloquentModel 
{
    protected $table = 'translation';
	protected $fillable = array('x', 'y');
	
	public function transformation()
	{
		return $this->belongsTo('App\Models\Transformations\Transformation');
	}
}
