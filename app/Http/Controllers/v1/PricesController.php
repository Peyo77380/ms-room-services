<?php

namespace App\Http\Controllers\V1;

use App\Traits\ApiResponder;

use App\Http\Controllers\Controller;

use App\Models\Prices;
use Illuminate\Http\Request;

use App\Http\Requests\Prices\PricesStoreRequest;

class PricesController extends Controller
{
    use ApiResponder;

    function get()
    {
        return $this->jsonSuccess(Prices::get());
    }

    function getById($id)
    {
        return $this->jsonById($id, Prices::find($id));
    }

    public function destroy($id)
    {
        return $this->jsonSuccess('item : ' . $id . ' successfully deleted', Prices::destroy($id), 204);
    }

    public function add(PricesStoreRequest $request)
    {
        $services = new Prices($request->all());
        $services->save();
    }
    public function update($id, PricesStoreRequest $request)
    {
        $services = Prices::find($id);
        $services->fill($request->all());
        $services->save();
    }

}
