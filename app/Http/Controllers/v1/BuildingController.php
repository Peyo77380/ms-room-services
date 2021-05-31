<?php

namespace App\Http\Controllers\V1;

use App\Traits\ApiResponder;

use App\Http\Controllers\Controller;

use App\Models\Building;

class BuildingController extends Controller
{
    use ApiResponder;

    function get()
    {
        return $this->jsonById("all", Building::get());
    }

    function getById($id)
    {
        return $this->jsonById($id, Building::find($id));
    }
}
