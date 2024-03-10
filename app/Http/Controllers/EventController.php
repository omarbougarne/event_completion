<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Event;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;
use App\Models\Category;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
{
    $categories = Category::all();
    $query = $request->input('query');
    $events = Event::query();

    if ($query) {
        $events->where('title', 'like', '%' . $query . '%');
    }

    $events = $events->get();

    return view('events.index', compact('events', 'categories'));
}




    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $categories = Category::all();

        return view('events.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */public function showtags()
{
    $categories = Category::all();
    return $categories;
}
public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'start_date' => 'required|date',
        'end_date' => 'required|date',
        'start_time' => 'required|date_format:H:i',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'address' => 'required|string',
        'num_tickets' => 'required|integer',
        'categories' => 'array', // Ensure categories are provided as an array
    ]);

    // Move the uploaded image to public storage
    $imageName = time().'.'.$request->image->extension();
    $request->image->move(public_path('images'), $imageName);

    $event = new Event([
        'title' => $request->input('title'),
        'description' => $request->input('description'),
        'start_date' => $request->input('start_date'),
        'end_date' => $request->input('end_date'),
        'start_time' => $request->input('start_time'),
        'image' => $imageName,
        'address' => $request->input('address'),
        'num_tickets' => $request->input('num_tickets'),
        'user_id' => auth()->id(),
    ]);


    $event->save();

    if ($request->has('categories')) {
        $categoryIds = $request->input('categories');
        $event->categories()->attach($categoryIds);
    }

    return back()->with('success', 'Event created successfully.');
}



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event): View
    {

        return view('events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventRequest $request, Event $event): RedirectResponse
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            Storage::delete($event->image);
            $data['image'] = Storage::putFile('events', $request->file('image'));
        }


        $event->update($data);
        return to_route('events.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event): RedirectResponse
    {
        Storage::delete($event->image);
        $event->delete();
        return to_route('events.index');
    }
}
