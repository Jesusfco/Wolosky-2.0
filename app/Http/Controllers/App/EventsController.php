<?php

namespace Wolosky\Http\Controllers\App;

use Illuminate\Http\Request;
use Wolosky\Http\Controllers\Controller;
use Wolosky\Event;
use Wolosky\User;
use Wolosky\Receipt;
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
        $event = Event::where('id',$id)->with('participants')->first();

        if($event == null) 
            return response()->json(['message' => 'Event No Found'], 401);                

        $users = User::select('user_type_id', 'id', 'gender', 'status', 'name')->orderBy('name', 'ASC')->get();
        $receipts = Receipt::where('event_id', $id)->orderBy('id', 'DESC')->get();

        return response()->json([
            'event' => $event,
            'users' => $users,
            'receipts' => $receipts
            ]);
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

    public function createParticipant(Request $re) {

        $creator = JWTAuth::parseToken()->authenticate();

        if($re->id == NULL )
            $participant = new EventParticipant();
        else
            $participant = EventParticipant::find($re->id);

        if($participant == NULL) return response()->json('message', 'Error al buscar participante', 401);
        
        $participant->status = $re->status;        

        $participant->event_id = $re->event_id;
        $participant->user_id = $re->user_id;
        $participant->cost = $re->cost;
        $participant->creator_id = $creator->id;
        $participant->save();

        return response()->json($participant);

    }

    public function createReceipt(Request $re) {

        $creator = JWTAuth::parseToken()->authenticate();
        $receipt = new Receipt();

        $receipt->user_id = $re->user_id;
        $receipt->event_id = $re->event_id;
        $receipt->creator_id = $creator->id;
        $receipt->amount = $re->amount;
        $receipt->type = 5;
        $receipt->save();

        return response()->json($receipt);

    }
}
