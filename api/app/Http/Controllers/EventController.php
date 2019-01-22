<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;

class EventController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    { 
        $request->user()->authorizeRoles(['developer', 'editor', 'local']);

        $events = new Event();

        $from = $request->from;
        $to = $request->to;

        return response()->json([
            "data" => $events->where("start_date", "<", $to)->where("end_date", ">=", $from)->get()
        ]);
    }

    public function store(Request $request)
    {
        $request->user()->authorizeRoles(['developer', 'editor', 'local']);

        $event = new Event();

        $event->text = strip_tags($request->text);
        $event->start_date = $request->start_date;
        $event->end_date = $request->end_date;
        $event->rec_type = $request->rec_type;
        $event->event_length = $request->event_length;
        $event->event_pid = $request->event_pid;
        $event->save();

        //detect deleted recurring events 
        $status = "inserted";
        if ($event->rec_type == "none") {
            $status = "deleted";
        }

        return response()->json([
            "action" => "inserted",
            "tid" => $event->id
        ]);
    }

    /**
     * when user modifies or deletes a recurring series, we should delete 
     * all modified occurrences of that series. It is required, because modified 
     * occurrences are linked to the original ones via timestamps.
     */
    private function deleteRelated($event)
    {
        if ($event->event_pid && $event->event_pid !== "none") {
            RecurringEvent::where("event_pid", $event->id)->delete();
        }
    }

    public function update($id, Request $request)
    {
        $request->user()->authorizeRoles(['developer', 'editor', 'local']);

        $event = Event::find($id);

        $event->text = strip_tags($request->text);
        $event->start_date = $request->start_date;
        $event->end_date = $request->end_date;
        $event->rec_type = $request->rec_type;
        $event->event_length = $request->event_length;
        $event->event_pid = $request->event_pid;
        $event->save();
        $this->deleteRelated($event);

        return response()->json([
            "action" => "updated"
        ]);
    }

    public function destroy($id)
    {
        $request->user()->authorizeRoles(['developer', 'editor', 'local']);
        
        $event = RecurringEvent::find($id);
 
        // delete the modified instance of the recurring series
        if ($event->event_pid) {
            $event->rec_type = "none";
            $event->save();
        } else {
        // delete a regular instance
            $event->delete();
        }
        $this->deleteRelated($event);
        return response()->json([
            "action" => "deleted"
        ]);
    }
}