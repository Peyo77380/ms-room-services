<?php

namespace App\Http\Controllers\v1;

use App\Models\Event;

use App\Libs\PriceLibs;
use App\Traits\ApiResponder;
use App\Http\Controllers\Controller;
use App\Http\Requests\Event\EventStoreRequest;
use App\Http\Requests\Event\EventUpdateRequest;


class EventController extends Controller
{
    use ApiResponder;

    public $__Price_RelatedEntityType_Nb = 3;

    function get()
    {
        $events = Event::whereNull('archived_at')->get();

        foreach($events as $el) {
            $el->prices = PriceLibs::find($this->__Price_RelatedEntityType_Nb, $el['_id']);
        }
        return $this->jsonSuccess($events);
    }


    function getArchived()
    {
        $events = Event::whereNotNull('archived_at')->get();

        foreach($events as $el) {
            $el->prices = PriceLibs::find($this->__Price_RelatedEntityType_Nb, $el['_id']);
        }
        return $this->jsonSuccess($events);
    }

    public function getById($id)
    {
        $event = Event::find($id);
        $event->prices = PriceLibs::find($this->__Price_RelatedEntityType_Nb, $event['_id']);
        return $this->jsonById($id, $event);
    }

    /**
     * create event
     */
    function store(EventStoreRequest $request)
    {
        $event = Event::create($request->all());
        $event->prices = PriceLibs::set($this->__Price_RelatedEntityType_Nb, $event->_id, $request->prices);

        return $this->jsonSuccess('created',$event, 201);;
    }

    function duplicate ($id)
    {
        $event = Event::find($id);

        if (!$event) {
            return $this->jsonError('Nothing at this Id', 404);
        }
        $event->endDate = null;
        $event->startDate = null;
        $event->display = "admin";
        $event->status = 0;

        $duplicate = $event->replicate();
        $saved = $duplicate->save();

        if (!$saved) {
            return $this->jsonError('Unable to duplicate', 500);
        }
        return $this->jsonSuccess($duplicate, 'duplicated', 201);

    }

    /**
     * update event
     */
    public function update(EventUpdateRequest $request, $id)
    {
        $event = Event::find($id);
        if (!$event) {
            return $this->jsonError('Something is wrong, please check datas - Code B30', 409);
        }
        $event->update($request->all());

        if ($request->prices) {
            $event->prices = PriceLibs::replace($this->__Price_RelatedEntityType_Nb, $id, $request->prices);
        }

        return $this->jsonSuccess('updated',$event, 200);

    }

    /**
     * delete event
     */
    function delete($id)
    {
        $event = Event::find($id);
        if (!$event) {
            return $this->jsonError('Something is wrong, please check datas - Code B30', 409);
        }
        if ($archived = $event->update(["archived_at" => date_format(now(), 'c')])) {
            return $this->jsonSuccess('item : ' . $id . ' successfully archived',$archived, 204);
        };

    }

}
