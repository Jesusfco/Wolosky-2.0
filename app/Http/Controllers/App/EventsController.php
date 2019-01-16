<?php

namespace Wolosky\Http\Controllers\App;

use Illuminate\Http\Request;
use Wolosky\Http\Controllers\Controller;
use Wolosky\Event;
use Wolosky\User;
use Wolosky\EventParticipant;
use JWTAuth;

class EventsController extends Controller
{

    public function get(Request $re) {
        $events = Event::where('name', 'LIKE', "%$re->name%")->paginate($re->items);
        return response()->json($events);
    }

    public function store(Request $re) {

        $event = new Event();
        $creator = JWTAuth::parseToken()->authenticate();
        $event = $this->setDataToModel($re, $event);
        $event->creator_id =  $creator->id;
        $event->save();

        return response()->json($event);

    }

    public function show($id) {
        $event = Event::find($id);

        if($event == null) 
            return response()->json(['message' => 'Event No Found'], 401);                

        return response()->json($event);
    }

    public function delete(Request $re) {
        $event = Event::find($re->id);

        if($event == null) 
            return response()->json(['message' => 'Event No Found'], 401);                

        $event->delete();

        return response()->json(true);
    }

    public function update(Request $re) {

        $event = Event::find($re->id);

        if($event == null) 
            return response()->json(['message' => 'Event No Found'], 401);
        
        $event = $this->setDataToModel($re, $event);
        $event->save();

        return response()->json($event);

    }

    private function setDataToModel($data, $model) {
        $model->name = $data->name;
        $model->cost = $data->cost;
        $model->date = $data->date;
        $model->date_to = $data->date_to;
        $model->description = $data->description;
        return $model;
    }

    public function getParticipants($id) {
        
        $users = User::select('user_type_id', 'id', 'gender', 'status', 'name')->orderBy('name', 'ASC')->get();
        $participants = EventParticipant::where('event_id', $id)->get();

        return response()->json([
            'users' => $users, 
            'participants' => $participants]
        );

    }

    public function createParticipants(Request $re) {

        

    }
}
