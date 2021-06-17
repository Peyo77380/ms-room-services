<?php

namespace App\Http\Controllers\V1;

use App\Traits\ApiResponder;

use App\Http\Controllers\Controller;

use App\Models\Price;
use Illuminate\Http\Request;

use App\Http\Requests\Price\PriceStoreRequest;
use App\Http\Requests\Price\PriceUpdateRequest;

class PriceController extends Controller
{
    use ApiResponder;

    function get()
    {
        return $this->jsonSuccess(Price::get());
    }

    function getById($id)
    {
        return $this->jsonById($id, Price::find($id));
    }

    public function destroy($id)
    {
        return $this->jsonSuccess('item : ' . $id . ' successfully deleted', Price::destroy($id), 204);
    }

    public function add(PriceStoreRequest $request)
    {
        $services = new Price($request->all());
        $services->save();
    }
    public function update($id, PriceUpdateRequest $request)
    {
        $services = Price::find($id);
        $services->fill($request->all());
        $services->save();
    }

}
