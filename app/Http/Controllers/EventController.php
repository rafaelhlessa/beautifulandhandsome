<?php
namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        return Event::all();
    }

    public function store(Request $request)
    {
        dd($request);
        $request->validate([

            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'date' => 'required|date',
            'dateEnd' => 'date',
            'timeStart' => 'required|date_format:H:i',
            'timeEnd' => 'date_format:H:i',

        ]);

        $event = Event::create(
            [
                'title' => $request->title,
                'description' => $request->description,
                'date' => $request->date,
                'dateEnd' => $request->dateEnd,
                'timeStart' => $request->timeStart,
                'timeEnd' => $request->timeEnd,
            ]
        );

        return response()->json($event, 201);
    }
}


