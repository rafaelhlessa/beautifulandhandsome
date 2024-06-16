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
            'start' => 'required|date',
            'end' => 'date',


        ]);

        $event = Event::create(
            [
                'title' => $request->title,
                'description' => $request->description,
                'start' => $request->date,
                'end' => $request->dateEnd,
                'user_id' => Auth::id(),

            ]
        );

        return response()->json($event, 201);
    }
}


