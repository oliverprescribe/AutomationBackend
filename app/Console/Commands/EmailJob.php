<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Mail\Email;
use App\Jobs\MailJob;
use App\Models\Client;
use App\Models\Letter;
use App\Models\UserRole;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;

class EmailJob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:job';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {


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

                 //convert uk time column into ph time
                 $uk_to_ph_time = Carbon::parse($letter->created_at)->setTimezone('Asia/Manila');
                 $current_PH_date_time = Carbon::now()->setTimezone('Asia/Manila');

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
                 $tat = $uk_to_ph_time->diffInHoursFiltered(function (Carbon $date) use ($client_holidays, $time_zone){
                     return $date->isWeekday() && !in_array(Carbon::parse($date->format('Y-m-d'))->setTimezone($time_zone), $client_holidays);
                 }, $current_PH_date_time);

                 //check priority then send warning or overdue emails
                 if ($letter->priority == 'priority' ) {
                    if ($tat >= 12 && $tat <= 24 ) {

                        $wjn_priority [] = [$letter->client->name,$letter->job_number];

                    }else if($tat > 24){

                        $ojn_priority [] = [$letter->client->name,$letter->job_number];
                    }
                }else{
                    if ($tat >= 24 && $tat <= 48 ) {

                        $wjn_routine [] = [$letter->client->name,$letter->job_number];

                    }else if ($tat > 48){

                        $ojn_routine [] = [$letter->client->name ?? '',$letter->job_number];

                    }
                }

             }
        }


        //query all management user role
        $management = UserRole::with(['role','user'])
        ->whereHas('role', function($query) {
            $query->where('name','Management');
        })->get();

        //get all email management
        $management_email = [];
        foreach ($management as $manager) {
           $management_email [] = $manager->user->email;
        }

        //store data in details array
        $details = [
            'email' => 'o.rodriguez@prescribe-digital.com',
            'subject'=> 'Automation',
            'purpose'=> 'notifyJobs',
            'ojn_priority' => $ojn_priority,
            'wjn_priority' => $wjn_priority,
            'ojn_routine' => $ojn_routine,
            'wjn_routine' => $wjn_routine,
            'management_email' => $management_email
        ];

        //dispatch details
        MailJob::dispatch($details)->onQueue('email');


    }
}
