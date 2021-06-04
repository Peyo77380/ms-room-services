<?php

namespace App\Http\Controllers\v1;


use App\Traits\ApiResponder;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Room;

class SearchController extends Controller
{
    use ApiResponder;
    private $posts;

    public function search (Request $request, $name)
    {
        return $this->jsonSuccess(Room::searchByName($name));

    }


}
