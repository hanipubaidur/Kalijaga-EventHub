<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EventController extends Controller
{
    /**
     * Menampilkan semua event yang sudah disetujui.
     */
    public function index(Request $request)
    {
        $events = Event::query()
            ->with('category') // Eager load relasi kategori
            ->where('status', 'approved')
            ->where('start_datetime', '>=', now()) // Hanya event yang akan datang
            ->orderBy('start_datetime', 'asc')
            ->paginate(12);

        return Inertia::render('Home', [
            'events' => $events,
        ]);
    }

    /**
     * Menampilkan detail satu event.
     */
    public function show(Event $event)
    {
        // Pastikan hanya event yang disetujui yang bisa diakses
        if ($event->status !== 'approved') {
            abort(404);
        }

        return Inertia::render('EventDetail', [
            'event' => $event->load('category'), // Load relasi kategori
        ]);
    }
}