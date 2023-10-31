<?php

namespace App\Http\Controllers;


use Carbon\Carbon;

use App\Models\Client;
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

    public function test(){

        $custom_date = '2021-06-05 11:32:53';

        $ph_date_time = Carbon::parse($custom_date)->setTimezone('Asia/Manila');
        $current_PH_date_time = Carbon::now();

          //store holidays into array base on client country
          $client_holidays = [];

          $holidays = Client::where('id', $custom_date)->with(['country.holidays'])
          ->get();


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
    }
}
