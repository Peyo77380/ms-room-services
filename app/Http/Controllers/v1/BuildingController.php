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
        $building = new Building($request->all());
        $building->save();
    }

    public function update($id, BuildingStoreRequest $request)
    {
        $building = Building::find($id);
        $building->fill($request->all());
        $building->save();
    }
}
