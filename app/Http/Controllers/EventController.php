<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventCategory;
use App\Models\EventRegistration;
use App\Models\EventSocial;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

/**
 * Author: Julius Fasema
 * Controller: EventController
 * Description: This controller contains functions for event
 * Date: 06-06-2022
 */

class EventController extends Controller
{
    // create event
    public function create(Request $request)
    {
        // collect users input
        $input = $request->only([
            'userid',
            'title',
            'hosted_by',
            'startdate',
            'enddate',
            'start_time',
            'end_time',
            'description',
            'venue',
            'event_type',
            'offline_address',
            'online_address',
            'event_category',
            'addtional_details',
            'registration_text',
            'redirect_link',
            'contact_phone',
            'guest_signin',
            'guest_share',
            'guest_bring_guest',
            'email_reminder',
            'registration',
            'event_recommendation',
            'photo_url',
            'event_social'
            
        ]);
        
        // validate user inputs
        $validate_data = [
            'title' => 'required|string|min:3',
            'hosted_by' => 'required|string|min:3',
            'startdate' => 'required|date',
            'enddate' => 'required|date|after:startdate',
            'start_time' => 'required|string',
            'end_time' => 'required|string',
            'venue' => 'required',
            'event_type' => 'required',
            'event_category' => 'required',
            'contact_phone' => 'required',
        ];

        $validator = Validator::make($input, $validate_data);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Please see errors parameter for all errors.',
                'errors' => $validator->errors()
            ]);
            return;
        }
                
        //insert record and return event id
        $event = Event::create([
            'userid' => $input['userid'],
            'title' => $input['title'],
            'hosted_by' => $input['hosted_by'],
            'startdate' => $input['startdate'],
            'enddate' => $input['enddate'],
            'start_time' => $input['start_time'],
            'end_time' => $input['end_time'],
            'description' => $input['description'],
            'venue' => $input['venue'],
            'event_type' => $input['event_type'],
            'offline_address' => $input['offline_address'],
            'online_address' => $input['online_address'],
            'event_category' => $input['event_category'],
            'addtional_details' => $input['addtional_details'],
            'registration_text' => $input['registration_text'],
            'redirect_link' => $input['redirect_link'],
            'contact_phone' => $input['contact_phone'],
            'guest_signin' => $input['guest_signin'],
            'guest_share' => $input['guest_share'],
            'guest_bring_guest' => $input['guest_bring_guest'],
            'email_reminder' => $input['email_reminder'],
            'registration' => $input['registration'],
            'event_recommendation' => $input['event_recommendation'],
            'photo_url' => $input['photo_url'],
        ]);

        Event::where('id',$event->id)->update([
            'event_url' => url('').'/api/register-event/'.$event->id,
        ]);

        // check if card_socials is selected
        if( $input['event_social']!=null ){

            foreach ($input['event_social'] as $key => $value) {
                //insert record into card_socials
                EventSocial::create([
                    'eventid' => $event->id,
                    'userid' => $input['userid'],
                    'social_media' => $value,
                ]);
         
            }  
    
        }

        return response()->json([
            'success' => true,
            'message' => 'Succesfully created',
            "eventlink" => url('').'/api/register-event/'.$event->id,
        ], 200);
        return;
    }

    // list all events
    public function listEvents(){

       $list =  Event::all();

       return response()->json([
            'success' => true,
            'event_list' => $list,
        ], 200);
        return;
    }

    // list all events that belongs to a user
    public function listMyEvents(){

        $list =  Event::where('userid',Auth::user()->id)->get();
 
        return response()->json([
             'success' => true,
             'event_list' => $list,
         ], 200);
         return;
     }

    //edit event
    public function editEvent(Request $request) {

        if(Event::where('id',$request->eventid)->exists()){
            $data = [];
            $data = Event::where('id',$request->eventid)->select('*')->first();
            $eventsocial = EventSocial::where('eventid',$request->eventid)->select('social_media')->get();
                return response()->json([
                    'success' => true,
                    'data' =>[
                        'event_data'=> $data,
                        'event_social_media'=> $eventsocial
                    ]
                ], 200);
                return;
        }
        else {
            return response()->json([
                'success' => false,
                'message' => 'Event does not exists',
            ], 200);
            return;
        }
    }

    // update event
    public function updateEvent(Request $request) {

        $input = $request->only([
            'eventid',
            'title',
            'hosted_by',
            'startdate',
            'enddate',
            'start_time',
            'end_time',
            'description',
            'venue',
            'event_type',
            'offline_address',
            'online_address',
            'event_category',
            'addtional_details',
            'registration_text',
            'redirect_link',
            'contact_phone',
            'guest_signin',
            'guest_share',
            'guest_bring_guest',
            'email_reminder',
            'registration',
            'event_recommendation',
            'photo_url',
            'event_social'
            
        ]);

        $event = Event::where('id',$input['eventid'])->update([
            'title' => $input['title'],
            'hosted_by' => $input['hosted_by'],
            'startdate' => $input['startdate'],
            'enddate' => $input['enddate'],
            'start_time' => $input['start_time'],
            'end_time' => $input['end_time'],
            'description' => $input['description'],
            'venue' => $input['venue'],
            'event_type' => $input['event_type'],
            'offline_address' => $input['offline_address'],
            'online_address' => $input['online_address'],
            'event_category' => $input['event_category'],
            'addtional_details' => $input['addtional_details'],
            'registration_text' => $input['registration_text'],
            'redirect_link' => $input['redirect_link'],
            'contact_phone' => $input['contact_phone'],
            'guest_signin' => $input['guest_signin'],
            'guest_share' => $input['guest_share'],
            'guest_bring_guest' => $input['guest_bring_guest'],
            'email_reminder' => $input['email_reminder'],
            'registration' => $input['registration'],
            'event_recommendation' => $input['event_recommendation'],
            'photo_url' => $input['photo_url'],
        ]);

        return response()->json([
            'success' => true,
            'message' => "Event successfully updated",
        ], 200);
        return;

    }
    
    // register event
    public function register($eventid)
    {
        if(Event::where('id',$eventid)->exists()){

            $event_status = Event::where('id',$eventid)->first();
            
            if($event_status->event_status==0){
                return response()->json([
                    'success' => false,
                    'message' => 'Sorry this event has been closed',
                ], 200);
                return;
            }
                return response()->json([
                    'success' => true,
                    'eventid' => $eventid,
                ], 200);
                return;
        }
        else {
            return response()->json([
                'success' => false,
                'message' => 'Event does not exists',
            ], 200);
            return;
        }

    }

    // use email to fetch user details for event
    public function fetchUserByEmail(Request $request)
    {
        if(User::where('email',$request->email)->exists()){
            $data = [];
            $data = User::where('email',$request->email)->select('firstname','middlename','lastname','gender','email','phone')->first();
                return response()->json([
                    'success' => true,
                    'user_data' => $data,
                ], 200);
                
                return;
        }
        else {
            return response()->json([
                'success' => false,
                'message' => 'User does not exists',
            ], 200);
            return;
        }

    }

    // save event registration
    public function saveEventRegistration(Request $request)
    {
        // collect users input
        $input = $request->only([

            'eventid',
            'firstname',
            'middlename',
            'lastname',
            'sex',
            'email',
            'phone',
            // 'country',
            // 'state',
            // 'city',
            'attendance_status',
            
        ]);
        
        // validate user inputs
        $validate_data = [
            'firstname' => 'required|string|min:3',
            'lastname' => 'required|string|min:3',
            'email' => 'required|email',
            'phone' => 'required',
            'sex' => 'required',
        ];

        $validator = Validator::make($input, $validate_data);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Please see errors parameter for all errors.',
                'errors' => $validator->errors()
            ]);
            return;
        }
                
        //insert record and return event id
        $event = EventRegistration::create([
            'eventid' => $input['eventid'],
            'firstname' => $input['firstname'],
            'middlename' => $input['middlename'],
            'lastname' => $input['lastname'],
            'sex' => $input['sex'],
            'email' => $input['email'],
            'phone' => $input['phone'],
            //'country' => $input['country'],
            //'state' => $input['state'],
            //'city' => $input['city'],
            
        ]);

        return response()->json([
            'success' => true,
            'message' => 'You have succesfully registered for this event'
        ], 200);
        return;
    }

     // creates even category
     public function createEvenCategory(Request $request){

        $input = $request->only([
            'category',            
        ]);
        
        // validate user inputs
        $validate_data = [
            'category' => 'required|string|min:3',
        ];

        $validator = Validator::make($input, $validate_data);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Please see errors parameter for all errors.',
                'errors' => $validator->errors()
            ]);
            return;
        }

        // insert record
        EventCategory::create([
            'category' =>  $input['category'],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Succesfully created'
        ], 200);
        return;

    }

    //fetch event category
    public function fetchEvenCategory() {

        $data = EventCategory::select('id','category')->get();

        return response()->json([
            'success' => true,
            'categorydata' => $data
        ],200);
        return;
    }
}
