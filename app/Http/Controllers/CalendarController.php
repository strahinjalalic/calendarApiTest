<?php

namespace App\Http\Controllers;

use Carbon;
use Spatie\GoogleCalendar\Event;
use App\Calendar;
use App\Http\Requests\CalendarRequest;
use Carbon\Carbon as CarbonCarbon;
use DateTime;
use Google_Client;
use Google_Service;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon as SupportCarbon;

define('STDIN',fopen("php://stdin","r"));

class CalendarController extends Controller
{
    protected $client;

    public function __construct()
    {
      $calendar = new Calendar();
      $this->client = $calendar->getClient();
    }

    public function submit(CalendarRequest $request) {

        $date_starts = $request->date . " " . $request->time;
        $date_carbon = new Carbon\Carbon(new DateTime($date_starts));
        $date_full = $date_carbon->subHours(2);

        $date_finishes = $request->date . " " . $request->time_finish;
        $date_carbon2 = new Carbon\Carbon(new DateTime($date_finishes));
        $date_full2 = $date_carbon2->subHours(2);
        //dd($date_full2);

        $service = new Google_Service_Calendar($this->client);

        $calendarId = 'primary';
        $event = new Google_Service_Calendar_Event([
            'summary' => $request->name,
            'description' => 'If additional info is nedded, call on: ' . $request->phone,
            'start' => array('dateTime' => $date_full),
            'end' => array('dateTime' => $date_full2),
            'reminders' => ['useDefault' => false, 'overrides' => array(
                array('method' => 'email', 'minutes' => 15),
                array('method' => 'email', 'minutes' => 30),
            )],
            'attendees' => array(
                array('email' => $request->email),

            ),
        ]);
        $results = $service->events->insert($calendarId, $event);
        session()->flash('success', 'You successfully added event in calendar!');
        return redirect()->back();

    // public function submit(CalendarRequest $request) {

    //     $calendar = new Calendar();
    //     $client = $calendar->getClient();
    //     $service = new Google_Service_Calendar($client);

    //     $date = $request->date . " " . $request->time;
    //     $date_carbon = new Carbon\Carbon(new DateTime($date));
    //     $date_full = $date_carbon->subHours(2);

    //     $event = new Google_Service_Calendar_Event(array(
    //         'description' => 'If additional info is nedded, call on: ' . $request->phone,
    //         'start' => array(
    //             'dateTime' => $date_full
    //         ),
    //         'end' => array(
    //             'dateTime' => $date_full->addHour()
    //         ),
    //         'attendees' => array(
    //             array('email' => $request->email)
    //         ),
    //         'reminders' => array(
    //             'useDefault' => FALSE,
    //             'overrides' => array(
    //                 array('method' => 'email', 'minutes' => 15),
    //                 array('method' => 'email', 'minutes' => 30)
    //             )
    //         )
    //     ));

    //     $calendarId = 'primary';
    //     $event = $service->events->insert($calendarId, $event);
    //     session()->flash('success', 'You successfully added event in calendar!');
    //     return redirect()->back();


    // }

        // $date = $request->date . " " . $request->time;
        // $date_carbon = new Carbon\Carbon(new DateTime($date));
        // $date_full = $date_carbon->subHours(2);

        // $event = new Event;
        // $event->name = $request->name;
        // $event->startDateTime =$date_full;
        // $event->endDateTime = $date_full->addHour();
        // $event->sendNotifications = true;
        // $event->reminders = array('useDefault' => FALSE, 'overrides' => array(
        //     array('method' => 'email', 'minutes' =>15),
        // ));

        // $event->description = "If additional info is nedded, call on: " . $request->phone;

        // // dd($event);
        // //$event->addAttendee(['email' => $request->email]);
        // $event->save();

        //return redirect()->back();
//}

}

}
