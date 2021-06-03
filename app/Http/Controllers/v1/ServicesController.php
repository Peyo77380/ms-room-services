<?php

namespace App\Http\Controllers\V1;

use App\Traits\ApiResponder;

use App\Http\Controllers\Controller;

use App\Models\Services;
use Illuminate\Http\Request;

use App\Http\Requests\Services\ServicesStoreRequest;

class ServicesController extends Controller
{
    use ApiResponder;

    function get()
    {
        return $this->jsonSuccess(Services::get());
    }

    function getById($id)
    {
        return $this->jsonById($id, Services::find($id));
    }

    public function destroy($id)
    {
        return $this->jsonSuccess('item : ' . $id . ' successfully deleted', Services::destroy($id), 204);
    }

    public function add(ServicesStoreRequest $request)
    {
        $services = new Services($request->all());
        $services->save();
    }
    public function update($id, ServicesStoreRequest $request)
    {
        $services = Services::find($id);
        $services->fill($request->all());
        $services->save();
    }

}
