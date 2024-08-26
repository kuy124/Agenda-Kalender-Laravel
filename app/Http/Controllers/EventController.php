<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
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

    public function getCurrentEvents()
    {
        $now = Carbon::now();

        $events = Event::where('start', '<=', $now)
            ->where('end', '>=', $now)
            ->get();

        return response()->json($events);
    }

    public function deleteEvent($id)
    {
        $event = Event::find($id);

        if ($event) {
            $imagePath = public_path('images/' . $event->image);
            $filePath = public_path('files/' . $event->file);

            $event->delete();

            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }

            if (File::exists($filePath)) {
                File::delete($filePath);
            }

            DB::statement('SET @num := 0;');
            DB::statement('UPDATE events SET id = @num := (@num + 1);');
            DB::statement('ALTER TABLE events AUTO_INCREMENT = 1;');

            return response()->json(['message' => 'Event, its image, and file deleted successfully.'], 200);
        } else {
            return response()->json(['message' => 'Event not found.'], 404);
        }
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

    public function searchuser(Request $request)
    {
        $query = $request->input('query');
        $events = Event::where('title', 'like', "%$query%")
            ->orWhere('description', 'like', "%$query%")
            ->orWhere('location', 'like', "%$query%")
            ->orWhere('category', 'like', "%$query%")
            ->get();

        return view('events.listguest', ['events' => $events]);
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,mp4,mp3|max:10240',
            'file' => 'nullable|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:20480',
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

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('files'), $fileName);
            $event->file = $fileName;
        }

        $event->save();

        DB::statement('SET @num := 0;');
        DB::statement('UPDATE events SET id = @num := (@num + 1);');
        DB::statement('ALTER TABLE events AUTO_INCREMENT = 1;');

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
            'file' => 'nullable|mimes:pdf,doc,docx|max:20480',
        ]);

        $event = Event::findOrFail($id);
        $event->title = $request->input('title');
        $event->start = $request->input('start');
        $event->end = $request->input('end');
        $event->description = $request->input('description');
        $event->location = $request->input('location');
        $event->category = $request->input('category');

        if ($request->hasFile('image')) {
            if ($event->image) {
                File::delete(public_path('images/' . $event->image));
            }
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $event->image = $imageName;
        }

        if ($request->hasFile('file')) {
            if ($event->file) {
                File::delete(public_path('files/' . $event->file));
            }
            $file = $request->file('file');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('files'), $fileName);
            $event->file = $fileName;
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
