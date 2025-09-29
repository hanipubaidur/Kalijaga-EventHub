<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index(){
        $events = Event::select('id','judul','gambar','deskripsi','tanggal','lokasi')->get();
        return response(['data' => $events]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|max:255',
            'gambar_file' =>'required|mimes:jpg,png',
            'deskripsi' => 'required|max:255',
            'tanggal' => 'required|date|after_or_equal:today',
            'lokasi' => 'required|max:255',
            'kategory_id'=> 'required|'.Rule::in(['1','2','3','4','5','6','7','8']),

        ]);

        if($request->file('gambar_file')){

            $file = $request->file('gambar_file');
            $fileName = $file->getClientOriginalName();
            $newName = Carbon::now()->timestamp.'_'.$fileName;

            Storage::disk('public')->putFileAs('events',$file,$newName);
            $request['gambar'] = $newName;
        }
        $event = Event::create($request->all());

        return response(['data' => $event]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|max:255',
            'gambar_file' =>'nullable|mimes:jpg,png',
            'deskripsi' => 'required|max:255',
            'tanggal' => 'required|date|after_or_equal:today',
            'lokasi' => 'required|max:255',
            'kategory_id'=> 'required|'.Rule::in(['1','2','3','4','5','6','7','8']),
            ]);

        if($request->file('gambar_file')){

            $file = $request->file('gambar_file');
            $fileName = $file->getClientOriginalName();
            $newName = Carbon::now()->timestamp.'_'.$fileName;

            Storage::disk('public')->putFileAs('events',$file,$newName);
            $request['gambar'] = $newName;
        }

        $event = Event::findOrFail($id);
        $event->update($request->all());
        
        return response(['data'=> $event]);
    }
    public function destroy($id)
    {
        $event = Event::findOrFail($id);

        if ($event->gambar && Storage::disk('public')->exists('events/'.$event->gambar)) {
            Storage::disk('public')->delete('events/'.$event->gambar);
        }

        $event->delete();

        return response(['message' => 'Event berhasil dihapus']);
    }
}
