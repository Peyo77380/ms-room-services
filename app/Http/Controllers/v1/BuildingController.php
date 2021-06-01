<?php

namespace App\Http\Controllers\V1;

use App\Traits\ApiResponder;

use App\Http\Controllers\Controller;

use App\Models\Building;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

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

    public function add(Request $request)
    {
        $validatedData = $this->buildingSubmissionValidator($request);
        if ($validatedData->fails()) {
            return $this->jsonError('Invalid data', 400);
        }

        $building = new Building();
        $building->location = $request->input('location');

        $building->surface = $request->input('surface');
        //TODO: A faire
        $building->openingHours = [1, 2, 3];

        $building->description = $request->input('description');
        $building->characteristics = $request->input('characteristics');
        $building->state = $request->input('state');
        $building->enabled = $request->input('enabled');
        $building->floors =  $request->input('floors');
        $building->save();
    }

    function buildingSubmissionValidator($request)
    {
        $validator = Validator::make(
            $request->all(),
            $rules = [
                'location' => 'required|json',
                'surface' => 'required|integer|min:0',
                'openingHours' => 'required',
                'characteristics' => 'required'
            ],
            $messages = [
                'required' => 'The :attribute field is required',
            ]
        );
        return $validator;
    }


}
