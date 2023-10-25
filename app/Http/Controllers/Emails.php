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
        // $mailData = [
        //     'title' => 'Mail from ItSolutionStuff.com',
        //     'body' => 'This is for testing email using smtp.'
        // ];

        // Mail::to('o.rodriguez@prescribe-digital.com')->send(new Email($mailData));


        //query all letters where status is not completed and withdrawn
        // $letters = Letter::whereNot('status', 'completed')->whereNot('status','withdrawn')->get();


        // //loop through the letters query
        // if(!empty($letters)){
        //     foreach ($letters as $letter) {

        //         //convert uk time column into ph time
        //         $ph_date_time = Carbon::parse($letter->created_at)->setTimezone('Asia/Manila');
        //         $currentPH_date_time = Carbon::now();

        //         //query all holidays per client country
        //         $holidays = Client::where('id', $letter->client_id)->with(['country.holidays'])
        //         ->get();

        //         //store holidays into array base on client country
        //         $client_holidays = [];

        //         //loop through hollidays then store holiday_date to client_holidays
        //         foreach ($holidays as $client) {
        //             $time_zone =$client->country->timezone;
        //             foreach ($client->country->holidays as $holiday) {
        //                 $client_holidays[] = $holiday->holiday_date;
        //             }
        //         }

        //         //generate time difference excluding weekends and holidays
        //         $tat = $ph_date_time->diffInHoursFiltered(function (Carbon $date) use ($client_holidays, $time_zone){
        //             return $date->isWeekday() && !in_array(Carbon::parse($date->format('Y-m-d'))->setTimezone($time_zone), $client_holidays);
        //         }, $currentPH_date_time);

        //         //check priority then send warning or overdue emails
        //         if($tat != 0){
        //             if ($letter->priority == 'priority' ) {
        //                 if ($tat >= 12 && $tat < 24 ) {
        //                     // Log::info("this is warning priority " . $letter->created_at);
        //                 }else {
        //                     // Log::info("this is overdue priority " . $letter->created_at);
        //                 }
        //             }else{
        //                 if ($tat >= 24 && $tat < 48 ) {
        //                     // Log::info("this is warning routine " . $letter->created_at);
        //                 }else {
        //                     // Log::info("this is overdue routine " . $letter->created_at);
        //                 }
        //             }
        //         }
        //     }
        // }


        // return response()->json([
        //     'tat' => $tat,
        //     // 'holidays' => $holidays,
        //     // 'holiday_name' => $name,
        //     // 'holiday_date' => $date,
        //     // 'time_zone_code' => $time_zone_code,
        //     // 'time_zone_name' => $time_zone_name,
        //     'client_client' => $client_holidays
        // ]);
    }
}
