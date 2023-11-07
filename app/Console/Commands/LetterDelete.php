<?php

namespace App\Console\Commands;

use Exception;
use Carbon\Carbon;
use App\Mail\Email;
use App\Jobs\MailJob;
use App\Models\Letter;
use App\Models\UserRole;
use App\Mail\DeleteLetterMail;
use App\Mail\LetterDeleteMail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
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
        try {
            //query letters with status completed and withdrawn
            // $letters = Letter::whereIn('status',['completed','withdrawn'])
            // ->get();
            $letters = Letter::where('id',179)
            ->get();

            if(count($letters)>0){
                //get all letter id's that have a time difference of over 3 months
                foreach ($letters as $letter) {
                    if($letter->date_return != null){
                        if($letter->date_return->setTimezone('Asia/Manila')->diffInMonths(Carbon::now()->setTimezone('Asia/Manila')) > 3){
                            $letter_find = Letter::find($letter->id);
                            if ($letter_find){
                               $this->letter_delete($letter_find);
                            }

                        }
                    }
                }


                //send mail
                Mail::to($this->get_manager_email())->send(new LetterDeleteMail($this->get_details()));

                // return response()->json([
                //     'details' => $this->get_details()
                // ]);

            }else {
                return response()->json([
                    'message' => 'no letter found!'
                ]);
            }

        } catch (Exception $e) {
            Log::error($e->getMessage());

            return response()->json([
                'message' => 'something went wrong!'
            ]);
        }




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

    //delete letter
    public function letter_delete($letter){
        $letter->assignments()->delete();
        $letter->audio()->delete();
        $letter->letter_comments()->delete();
        $letter->uploaders()->delete();
        $letter->delete();
    }

    //details response
    public function get_details(){
        return [
            'email' => 'o.rodriguez@prescribe-digital.com',
            'subject'=> 'Automation'
        ];
    }
}
