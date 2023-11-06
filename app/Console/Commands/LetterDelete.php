<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Mail\Email;
use App\Jobs\MailJob;
use App\Models\Letter;
use App\Models\UserRole;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class LetterDelete extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'letter:delete';

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
        //query letters with status completed and withdrawn
        // $letters = Letter::whereIn('status',['completed','withdrawn'])
        // ->get();
        $letters = Letter::where('id',176)
        ->get();

        $letter_id = [];

        //get all letter id's that have a time difference of over 3 months
        foreach ($letters as $letter) {
            if($letter->date_return != null){
                if($letter->date_return->setTimezone('Europe/London')->diffInMonths(Carbon::now()->setTimezone('Europe/London')) > 3){
                    $letter_id [] = $letter->id;

                }
            }
        }


        if (count($letter_id) > 0) {

            //delete all letter from different relationships
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
            
            $details = [
                'email' => 'o.rodriguez@prescribe-digital.com',
                'subject'=> 'Automation',
                'purpose'=> 'deleteLetter',
                'management_email' => $management_email
            ];

            //send mail
            Mail::to($details['management_email'])->send(new Email($details));

        }else {
            return response()->json([
                "message" => 'No letter found!'
            ],404);
        }


    }
}
