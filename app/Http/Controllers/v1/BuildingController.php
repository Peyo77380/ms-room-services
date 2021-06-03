<?php

namespace App\Http\Controllers\V1;

use App\Traits\ApiResponder;

use App\Http\Controllers\Controller;

use App\Models\Building;
use Illuminate\Http\Request;

use App\Http\Requests\Building\BuildingStoreRequest;

class BuildingController extends Controller
{
    use ApiResponder;
    private $posts;



    function get()
    {
        return $this->jsonSuccess(Building::get());
    }

    function getById($id)
    {
        return $this->jsonById($id, Building::find($id));
    }

    public function destroy($id)
    {
        return $this->jsonSuccess('item : ' . $id . ' successfully deleted', Building::destroy($id), 204);
    }

    public function add(BuildingStoreRequest $request)
    {


        $building = new Building();
        $building->location = $request->input('location');

        $building->surface = $request->input('surface');
        //TODO: A faire
        $building->openingHours = [1, 2, 3];
        // TODO : gérer ajout ID floor avec $floor = ['_id' => new ObjectId()] + le reste des données + use MongoDB\BSON\ObjectId;
        $building->description = $request->input('description');
        $building->characteristics = $request->input('characteristics');
        $building->state = $request->input('state');
        $building->enabled = $request->input('enabled');
        $building->floors =  $request->input('floors');
        $building->save();
    }
}
