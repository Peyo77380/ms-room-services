<?php

namespace App\Http\Controllers\v1;

use App\Traits\ApiResponder;

use App\Http\Controllers\Controller;
use App\Http\Requests\Event\EventStoreRequest;
use App\Http\Requests\Event\EventUpdateRequest;
use App\Models\Event;


class EventController extends Controller
{
    use ApiResponder;

    function get()
    {
        return $this->jsonSuccess(Event::get());
    }

    function getById($id)
    {
        return $this->jsonById($id, Event::find($id));
    }

    /**
     * create event
     */
    function store(EventStoreRequest $request)
    {
        $events = Event::create($request->all());
        if ($events) {
            return $this->jsonSuccess($events);
        }
        return $this->jsonError('Event already exist', 409);
    }

    function duplicate ($id)
    {
        $event = Event::find($id);
        if (!$event) {
            return $this->jsonError('Nothing at this Id', 404);
        }
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
        $event = Event::find($id);
        if($event){
            $event->status=99;
            return $this->jsonSuccessNoDatas("The event '$event->title' has been archived");
        }
    }

}
