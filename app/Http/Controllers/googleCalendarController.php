<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\GoogleCalendar\Event;

class googleCalendarController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Event::get();

            $mapEvent = collect($data)->map(function ($value) {
                $objEvent = new \stdClass();
                $objEvent->id = $value->googleEvent->id;
                $objEvent->title = $value->googleEvent->summary;
                $objEvent->description = $value->googleEvent->description;
                $objEvent->start = $value->googleEvent->start->date;
                $objEvent->end = $value->googleEvent->end->date;
                return $objEvent;
            });
            // dd($data);
            return response()->json($mapEvent);
        }
        return view('googleCalendar');
    }

    public function action(Request $request)
    {
        if ($request->ajax()) {
            if ($request->type == 'add') {
                $event = Event::create([
                    'title' => $request->title,
                    'start' => $request->start,
                    'end'   => $request->end
                ]);

                return response()->json($event);
            }

            if ($request->type == 'update') {
                $event = Event::find($request->id)->update([
                    'title' => $request->title,
                    'start' => $request->start,
                    'end'   => $request->end
                ]);

                return response()->json($event);
            }
            if ($request->type == 'delete') {
                $event = Event::find($request->id)->delete();

                return response()->json($event);
            }
        }
    }
}
