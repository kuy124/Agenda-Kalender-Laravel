<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::all();
        return response()->json($events);
    }

    public function list()
    {
        $events = Event::all();
        return view('events.list', compact('events'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $events = Event::where('title', 'like', "%$query%")
            ->orWhere('description', 'like', "%$query%")
            ->orWhere('location', 'like', "%$query%")
            ->orWhere('category', 'like', "%$query%")
            ->get();

        return view('events.list', ['events' => $events]);
    }

    public function show($id)
    {
        $event = Event::findOrFail($id);
        return view('events.show', compact('event'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'start' => 'required|date',
            'end' => 'required|date',
            'location' => 'required',
        ]);

        $existingEvent = Event::where('location', $request->location)
            ->whereDate('start', $request->start)
            ->first();

        if ($existingEvent) {
            return response()->json(['message' => 'Ruangan sudah dipesan pada tanggal ini.'], 400);
        }

        // Ensure date fields are in the right format
        $event = Event::create([
            'title' => $request->input('title'),
            'start' => Carbon::parse($request->input('start'))->format('Y-m-d'),
            'end' => Carbon::parse($request->input('end'))->format('Y-m-d'),
            'location' => $request->input('location'),
            'description' => $request->input('description'),
            'category' => $request->input('category')
        ]);

        return response()->json($event);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'start' => 'required|date',
            'end' => 'required|date',
            'location' => 'required',
        ]);

        $existingEvent = Event::where('location', $request->location)
            ->whereDate('start', $request->start)
            ->where('id', '!=', $id)
            ->first();

        if ($existingEvent) {
            return response()->json(['message' => 'Ruangan sudah dipesan pada tanggal ini.'], 400);
        }

        $event = Event::find($id);

        if ($event) {
            $event->update([
                'title' => $request->input('title'),
                'start' => Carbon::parse($request->input('start'))->format('Y-m-d'),
                'end' => Carbon::parse($request->input('end'))->format('Y-m-d'),
                'location' => $request->input('location'),
                'description' => $request->input('description'),
                'category' => $request->input('category')
            ]);

            return response()->json($event);
        }

        return response()->json(['message' => 'Event not found'], 404);
    }

    public function getTodaysEvents()
    {
        $today = Carbon::today();
        $events = Event::whereDate('start', $today)->get();
        return response()->json($events);
    }


    public function destroy($id)
    {
        $event = Event::find($id);

        if ($event) {
            $event->delete();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Event not found'], 404);
    }
}
