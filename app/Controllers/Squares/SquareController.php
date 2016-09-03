<?php

namespace App\Controllers\Squares;

use App\Models\Squares\Square;
use App\Controllers\BaseController;

class SquareController extends BaseController
{
    public function get($id)
    {
        return Square::findOrFail($id);
    }

    public function set($attributes = ['id' => 3, 'name' => 'TEST', 'width' => 123, 'height' => 321])
    {
        $square = Square::findOrNew($attributes['id']);
		foreach($attributes as $name => $value)
		{
			$square->{$name} = $value;
		}
		$square->save();
		return $square;
    }
}
