<?php

namespace App\Http\Controllers\v1;


use App\Traits\ApiResponder;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// use App\Models\Room;

class SearchController extends Controller
{
    use ApiResponder;
    private $posts;

    // public function search ($name)
    // {
    //     return $this->jsonSuccess(Room::searchByName($name));
    // }

    public function searchAll (Request $request)
    {
        $class = 'App\Models\\' . ucfirst($request->input('t'));
        $criterias = self::__findCriterias($request->except('t'));
        return $this->jsonSuccess($class::search($criterias));
    }

    private static function __findCriterias ($fields)
    {
        dd($fields); 
        $criterias = [];
        foreach($fields as $key => $value){
                $criterias[] = [$key, 'LIKE', '%' . $value . '%'];
        }
        return $criterias;
    }
}
