<?php

namespace App\Http\Controllers\v1;

use App\Traits\ApiResponder;

use App\Http\Controllers\Controller;
use App\Http\Requests\Events\EventsStoreRequest as EventsEventsStoreRequest;
use App\Http\Requests\Events\EventsUpdateRequest as EventsEventsUpdateRequest;
use App\Models\Events;

use App\Http\Requests\V1\Company\EventsStoreRequest;

use App\Http\Requests\V1\Company\EventsUpdateRequest;

class EventsController extends Controller
{
    use ApiResponder;

    function get($id)
    {
        return $this->jsonById($id, Events::find($id));
    }

    /**
     * create event
     */
    function store(EventsEventsStoreRequest $request)
    {
        $events = Events::create($request->all());
        if ($events) {
            return $this->jsonSuccess($events);
        }
        return $this->jsonError('Event already exist', 409);
    }

    /**
     * update event
     */
    public function update(EventsEventsUpdateRequest $request, $id)
    {
        $event = Events::find($id);

        if (!$event) {
            return $this->jsonError('Something is wrong, please check datas - Code B30', 409);
        }

        $updatedEvent = $event->update($request->all());

        if(!$updatedEvent) {
            return $this->jsonError('Could not update this item - Code R31', 502);
        }

        return $this->jsonSuccess($updatedEvent);

    }

    /**
     * delete event
     */
    function delete($id)
    {
        $event = Events::find($id);
        if($event){
            $event->status=99;
            return $this->jsonSuccessNoDatas("The event '$event->title' has been archived");
        }
    }

}
