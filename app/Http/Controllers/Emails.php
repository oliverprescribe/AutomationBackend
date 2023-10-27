<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Mail\Email;
use App\Models\Client;
use App\Models\Letter;
use App\Models\Holiday;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;


class Emails extends Controller
{
    public function index(){

         //query all letters where status is not completed and withdrawn
        //  $letters = Letter::whereNot('status', 'completed')->whereNot('status','withdrawn')->get();

         $letters = Letter::where('id', '190')->get();

         //job Numbers priority
        $ojn_priority = [];
        $wjn_priority = [];

        //job Numbers routine
        $ojn_routine = [];
        $wjn_routine = [];



         //loop through the letters query
         if(!empty($letters)){
             foreach ($letters as $letter) {

                 //convert uk time column into ph time
                 $ph_date_time = Carbon::parse($letter->created_at)->setTimezone('Asia/Manila');
                 $current_PH_date_time = Carbon::now();

                 //query all holidays per client country
                 $holidays = Client::where('id', $letter->client_id)->with(['country.holidays'])
                 ->get();

                 //store holidays into array base on client country
                 $client_holidays = [];

                 //loop through hollidays then store holiday_date to client_holidays
                 foreach ($holidays as $client) {
                     $time_zone =$client->country->timezone;
                     foreach ($client->country->holidays as $holiday) {
                         $client_holidays[] = $holiday->holiday_date;
                     }
                 }

                 //generate time difference excluding weekends and holidays
                 $tat = $ph_date_time->diffInHoursFiltered(function (Carbon $date) use ($client_holidays, $time_zone){
                     return $date->isWeekday() && !in_array(Carbon::parse($date->format('Y-m-d'))->setTimezone($time_zone), $client_holidays);
                 }, $current_PH_date_time);

                 //check priority then send warning or overdue emails
                if ($letter->priority == 'priority' ) {
                    if ($tat >= 12 && $tat <= 24 ) {

                        $wjn_priority [] = $letter->job_number;

                    }else if($tat > 24){

                        $ojn_priority [] = $letter->job_number;
                    }
                }else{
                    if ($tat >= 24 && $tat <= 48 ) {

                        $wjn_routine [] = $letter->job_number;

                    }else if ($tat > 48){

                        $ojn_routine [] = $letter->job_number;

                    }
                }

             }
        }

        $details = [
            'email' => 'o.rodriguez@prescribe-digital.com',
            'subject'=> 'Automation',
            'ojn_priority' => $ojn_priority,
            'wjn_priority' => $wjn_priority,
            'ojn_routine' => $ojn_routine,
            'wjn_routine' => $wjn_routine
        ];

        // return response()->json([
        //     'details' => $details
        // ]);

        return view ('emails.mail',compact('details'));
    }
}
