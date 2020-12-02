<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Participants;
use App\Models\Events;
use Illuminate\Support\Facades\Auth;

class ParticipantsController extends Controller
{

    public function addParticipant(Events $event){
        $isParticipant = Participants::all()
        ->where('users_id','=',Auth::id())
        ->where('events_id','=',$event->id);

        if($isParticipant->isNotEmpty()){
            return redirect()->back()->with('error', 'You cannot join to the same event twice');
        }
        elseif(Auth::User()->age < 18){
            return redirect()->back()->with('error', 'You are too young to participate in this event');
        }
        elseif($event->current_participants == $event->max_participants){
            return redirect()->back()->with('error', 'The limit of participants for this event has ben reached');
        }
        elseif($event->users_id == Auth::id()){
            return redirect()->back()->with('error', 'You cannot join to your event');
        }

        Participants::create(([
            'users_id' => Auth::id(),
            'users_name'=> Auth::user()->name,
            'users_email'=>Auth::user()->email,
            'users_age'=>Auth::user()->age,
            'events_id'=>$event->id,
        ]));
        Events::where('id', $event->id)->increment('current_participants');
        return redirect()->back()->with('success', 'You succesfully added yourself to the event');
    }
    public function removeParticipant($id, Events $event){
        if($id != Auth::id()){
            return abort(404);
        }
        Participants::where('users_id', $id)->where('events_id', $event->id)->delete();
        Events::where('id', $event->id)->decrement('current_participants');
        return redirect()->back()->with('success', 'You succesfully removed yourself from the event');
    }

}

