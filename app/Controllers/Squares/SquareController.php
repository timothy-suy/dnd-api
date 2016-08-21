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
}
