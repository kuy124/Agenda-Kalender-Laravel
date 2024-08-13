<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

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

    public function listguest()
    {
        $events = Event::all();
        return view('events.listguest', compact('events'));
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

        return response()->json([
            'id' => $event->id,
            'title' => $event->title,
            'start' => $event->start,
            'end' => $event->end,
            'description' => $event->description,
            'location' => $event->location,
            'category' => $event->category,
            'image' => $event->image ? url('storage/' . $event->image) : null,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'start' => 'required|date',
            'end' => 'nullable|date',
            'description' => 'required|string',
            'location' => 'nullable|string',
            'category' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096',
        ]);

        $event = new Event();
        $event->title = $request->input('title');
        $event->start = $request->input('start');
        $event->end = $request->input('end');
        $event->description = $request->input('description');
        $event->location = $request->input('location');
        $event->category = $request->input('category');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $event->image = $imageName;
        }

        $event->save();

        return response()->json($event);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'start' => 'required|date',
            'end' => 'nullable|date',
            'description' => 'required|string',
            'location' => 'nullable|string',
            'category' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096',
        ]);

        $event = Event::findOrFail($id);
        $event->title = $request->input('title');
        $event->start = $request->input('start');
        $event->end = $request->input('end');
        $event->description = $request->input('description');
        $event->location = $request->input('location');
        $event->category = $request->input('category');

        if ($request->hasFile('image')) {
            // Delete old image
            if ($event->image) {
                Storage::delete('public/images/' . $event->image);
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $event->image = $imageName;
        }

        $event->save();

        return response()->json($event);
    }


    public function getTodaysEvents()
    {
        $today = Carbon::today();
        $events = Event::whereDate('start', $today)->get();
        return response()->json($events);
    }

    public function TodayNow()
    {
        $today = Carbon::today();
        $events = Event::whereDate('start', $today)->get();
        return response()->json($events);
    }

    public function indexUser()
    {
        $events = Event::all();
        return response()->json($events);
    }

    public function destroy($id)
    {
        $event = Event::find($id);
        if ($event) {
            if ($event->image && Storage::exists('public/images/' . $event->image)) {
                Storage::delete('public/images/' . $event->image);
            }
            $event->delete();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Event not found'], 404);
    }


    private function isLocationBooked($location, $start, $excludeId = null)
    {
        return Event::where('location', $location)
            ->whereDate('start', $start)
            ->where('id', '!=', $excludeId)
            ->exists();
    }
}
