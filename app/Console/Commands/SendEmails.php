<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Mail\Email;
use App\Jobs\MailJob;
use App\Models\Client;
use App\Models\Letter;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:send';

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

         //query all letters where status is not completed and withdrawn
        //  $letters = Letter::whereNot('status', 'completed')->whereNot('status','withdrawn')->get();

         $letters = Letter::where('id', '190')->get();



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

                        $details = [
                            'email' => 'o.rodriguez@prescribe-digital.com',
                            'subject'=> 'Automation Job Warning',
                            'message' => 'This is to notify you that a letter is nearing its due date. Its been '.$tat.' hrs since it was assigned.',
                            'job_number' => $letter->job_number,
                            'priority' => $letter->priority
                        ];

                        MailJob::dispatch($details)->onQueue('emails');

                    }else if($tat > 24){
                        $details = [
                            'email' => 'o.rodriguez@prescribe-digital.com',
                            'subject'=> 'Automation Job Overdue',
                            'message' => 'This is to notify you that a letter is already overdue. Its been '.$tat.' hrs since it was assigned.',
                            'job_number' => $letter->job_number,
                            'priority' => $letter->priority
                        ];

                        MailJob::dispatch($details)->onQueue('emails');
                    }
                }else{
                    if ($tat >= 24 && $tat <= 48 ) {
                        $details = [
                            'email' => 'o.rodriguez@prescribe-digital.com',
                            'subject'=> 'Automation Job Warning',
                            'message' => 'This is to notify you that a letter is nearing its due date. Its been '.$tat.' hrs since it was assigned.',
                            'job_number' => $letter->job_number,
                            'priority' => $letter->priority
                        ];

                        MailJob::dispatch($details)->onQueue('emails');
                    }else if ($tat > 48){
                        $details = [
                            'email' => 'o.rodriguez@prescribe-digital.com',
                            'subject'=> 'Automation Job Overdue',
                            'message' => 'This is to notify you that a letter is already overdue. Its been '.$tat.' hrs since it was assigned.',
                            'job_number' => $letter->job_number,
                            'priority' => $letter->priority
                        ];

                        MailJob::dispatch($details)->onQueue('emails');
                    }
                }

             }
        }



        // $letter = Letter::find(172);
        // Mail::to('o.rodriguez@prescribe-digital.com')->send(new Email($letter));


    }
}
