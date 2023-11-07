<?php

namespace App\Http\Controllers;


use Exception;

use Carbon\Carbon;
use App\Models\Client;
use App\Models\Letter;
use App\Models\UserRole;
use App\Models\Dashboard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class TestingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = Dashboard::all();
        $user = Auth::user();
        $clients = Client::all('name');

        return response()->json([
            'data'=> $datas,
            'user'=> $user,
            'client' => $clients
        ]);
    }

    //EmailJobNumbers task schedule ====================================================================
    public function email(){


        //  $letters = Letter::whereNot('status', 'completed')->whereNot('status','withdrawn')->get();

        //query all letters where status is not completed and withdrawn
        $letters = Letter::whereNotIn('status', ['completed', 'withdrawn'])->where('date_completed', null)->orderBy('client_id', 'ASC')->with('client')->get();

        //  $letters = Letter::where('id', '190')->get();

         //job Numbers priority
        $ojn_priority = [];
        $wjn_priority = [];

        //job Numbers routine
        $ojn_routine = [];
        $wjn_routine = [];



         //loop through the letters query
         if(!empty($letters)){
             foreach ($letters as $letter) {

                //get client holidays
                list($time_zone, $client_holidays) = $this->get_client_holidays($letter->client_id);

                //get time difference
                $tat = $this->get_time_difference($letter->created_at, $client_holidays, $time_zone);

                 //check priority then send warning or overdue emails
                 if ($letter->priority == 'priority' ) {
                    if ($tat >= 12 && $tat <= 24 ) {

                        $wjn_priority [] = $this->get_name_Job_number($letter->client->name,$letter->job_number);

                    }else if($tat > 24){

                        $ojn_priority [] = $this->get_name_Job_number($letter->client->name,$letter->job_number);
                    }
                }else{
                    if ($tat >= 24 && $tat <= 48 ) {

                        $wjn_routine [] = $this->get_name_Job_number($letter->client->name,$letter->job_number);

                    }else if ($tat > 48){

                        $ojn_routine [] = $this->get_name_Job_number($letter->client->name ?? '',$letter->job_number);

                    }
                }

             }
        }



        //store data in details array
        $details = $this->get_details($ojn_priority,$wjn_priority,$ojn_routine,$wjn_routine);


       return response()->json([
        'details' => $details
       ]);



    //    return view ('emails.job_mail',compact('details'));

    // dd($holiday);

   }


   public function get_client_holidays($client_id){

    //query all holidays per client country
    $holidays = Client::where('id', $client_id)->with(['country.holidays'])
    ->get();

    //store holidays into array base on client country
    $client_holidays = [];
    $time_zone = null;

    //loop through hollidays then store holiday_date to client_holidays
    foreach ($holidays as $client) {
    $time_zone = $client->country->timezone;
    foreach ($client->country->holidays as $holiday) {
        $client_holidays[] = $holiday->holiday_date;
        }
    }

    return [$time_zone, $client_holidays];

   }


    //calculate time difference excluding weekends and holidays
    public function get_time_difference($created_at, $client_holidays, $time_zone){

        return Carbon::parse($created_at)->setTimezone('Asia/Manila')->diffInHoursFiltered(function (Carbon $date) use ($client_holidays, $time_zone){
            return $date->isWeekday() && !in_array(Carbon::parse($date->format('Y-m-d'))->setTimezone($time_zone), $client_holidays);
        }, Carbon::now()->setTimezone('Asia/Manila'));

    }

    //get all managers email
    public function get_manager_email(){

        return UserRole::with(['role', 'user'])
        ->whereHas('role', function($query) {
                $query->where('name','Management');
            })->get()
        ->pluck('user.email')
        ->toArray();
    }

    public function get_name_Job_number($client_name,$job_number){
        return [$client_name, $job_number];
    }


    //details response
    public function get_details($ojn_priority,$wjn_priority,$ojn_routine,$wjn_routine){
        return [
            'email' => 'o.rodriguez@prescribe-digital.com',
            'subject'=> 'Automation',
            'ojn_priority' => $ojn_priority,
            'wjn_priority' => $wjn_priority,
            'ojn_routine' => $ojn_routine,
            'wjn_routine' => $wjn_routine,
            'management_email' => $this->get_manager_email()
        ];
    }

 //=========================================================================================

    public function automationEmailTest(){

        $custom_date = '2023-11-1 7:00:00';

        $uk_to_ph_time = Carbon::parse($custom_date)->setTimezone('Asia/Manila');
        $current_PH_date_time = Carbon::now()->setTimezone('Asia/Manila');

          //store holidays into array base on client country
          $client_holidays = [];

          $holidays = Client::where('id', 1)->with(['country.holidays'])
          ->get();


          //loop through hollidays then store holiday_date to client_holidays
          $time_zone = null;
          foreach ($holidays as $client) {
              $time_zone = $client->country->timezone;
              foreach ($client->country->holidays as $holiday) {
                  $client_holidays[] = $holiday->holiday_date;
              }
          }

    //     //generate time difference excluding weekends and holidays
        $tat = $uk_to_ph_time->diffInHoursFiltered(function (Carbon $date) use ($client_holidays, $time_zone){
        return $date->isWeekday() && !in_array(Carbon::parse($date->format('Y-m-d'))->setTimezone($time_zone), $client_holidays);
    }, $current_PH_date_time);

        return response()->json([
            'tat' => $tat,
            'now' => $uk_to_ph_time->toDateTimeString(),
            'sample' => $current_PH_date_time->toDateTimeString()

        ]);
    }

    public function deleteLetter(){

        // $letters = Letter::whereIn('status',['completed','withdrawn'])
        // ->get();

        $letters = Letter::where('id',174)
        ->get();

        $letter_id = [];

        foreach ($letters as $letter) {
            if($letter->date_return != null){
                if($letter->date_return->setTimezone('Europe/London')->diffInMonths(Carbon::now()->setTimezone('Europe/London')) > 3){
                    $letter_id [] = $letter->id;
                }
            }
        }


        if (count($letter_id) > 0) {

            foreach ($letter_id as $id) {
                $letter = Letter::find($id);
                if ($letter){
                    $letter->assignments()->delete();
                    $letter->audio()->delete();
                    $letter->letter_comments()->delete();
                    $letter->uploaders()->delete();
                    $letter->delete();
                }
            }
        }else {
            return response()->json([
                "message" => 'No letter found!'
            ]);
        }

        return response()->json([
            "message" => 'Successfully deleted'
        ]);

    }

     //Letter Dellete =========================================================================================


}





