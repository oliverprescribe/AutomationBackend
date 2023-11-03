<?php

namespace App\Http\Controllers;


use Carbon\Carbon;

use App\Models\Client;
use App\Models\Letter;
use App\Models\Dashboard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Index extends Controller
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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

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
            ],404);
        }

        return response()->json([
            "message" => 'Successfully deleted'
        ]);

    }
}
