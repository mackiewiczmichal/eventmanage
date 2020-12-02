<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Events;
use App\Models\Participants;
use App\Models\Messages;
use App\Models\Images;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class EventsController extends Controller
{
    public function index(){
        $events = Auth::user()->events;
        return view('eventsList',[
            'events'=>$events,
        ]);
    }
    public function showJoined(){
        $participatedEvents = Events::leftJoin('participants', 'participants.events_id', '=', 'events.id')
        ->select('events.*')
        ->where('participants.users_id', Auth::id())->get();
        return view('eventsJoined',[
            'events'=>$participatedEvents,
        ]);
    }

    public function showAll(){
        $events = Events::orderBy('event_start_date')->where('event_start_date','>=',today())->get();
        $images = Images::all();
        return view('eventsGlobalShow',[
            'events'=>$events,
            'images'=>$images
        ]);
    }

    public function details(Events $event){
        $images = Images::where('events_id','=',$event->id)->first();
        $messages = Messages::where('events_id','=',$event->id)->orderBy('created_at', 'desc')->paginate(5);
        return view('eventDetails',[
            'event'=>$event,
            'messages'=>$messages,
            'images_name'=>$images,
        ]);
    }


    public function create(){
        return view('eventAdd');
    }
    public function store(Request $request){
        $request ->validate([
            'title'=>'required|max:128',
            'description'=>'required|max:255',
            'event_start_date'=>'required|date',
            'event_end_date'=>'required|date',
            'latitude'=>'required',
            'longitude'=>'required',
            'max_participants'=>'required|integer',
        ]);
        $event = Auth::user()->events()->create($request->all());
        if($event){
            return redirect()->to('/dashboard/events');
        }
        return redirect()->back();

    }
    public function storeEventMessage(Request $request,$event_id){
        $request ->validate([
            'title'=>'required|max:128',
            'content'=>'required|max:512',
        ]);
        Messages::create([
            'events_id' => $event_id,
            'title'=>$request->title,
            'content'=>$request->content,
        ]);
        return redirect()->back();

    }
    public function edit(Events $event){
        if($event->users_id != Auth::id()){
            return abort(404);
        }
        $participants = Participants::all()
        ->where('events_id','=',$event->id);

        $messages = Messages::where('events_id','=',$event->id)->orderBy('created_at', 'desc')->paginate(3);
        $images = Images::where('events_id','=',$event->id)->first();
        return view('eventEdit',[
            'event'=>$event,
            'participants'=>$participants,
            'messages'=>$messages,
            'images'=>$images,
        ]);
    }
    public function update(Request $request, Events $event){
        if($event->users_id != Auth::id()){
            return abort(403);
        }
        $request ->validate([
            'title'=>'required|max:128',
            'description'=>'required|max:255',
            'event_start_date'=>'required|date',
            'event_end_date'=>'required|date',
            'latitude'=>'required',
            'longitude'=>'required',
            'max_participants'=>'required|integer',
        ]);
        $event->update($request->all());

        return redirect()->back();

    }
    public function destroy(Request $request, Events $event){
        if($event->users_id != Auth::id()){
            return abort(403);
        }
        $event->delete();
        return redirect()->to('/dashboard/events');
    }

    }



?>
