<?php

namespace App\Http\Controllers;
use App\Models\Log;
use App\Models\Author;
use App\Models\Client;
use App\Models\Letter;
use App\Models\Dashboard;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\select;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

class Monitoring extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(){
        //query dashboard, user and clients
        $datas = Dashboard::all();
        $users = Auth::user();
        $clients = Client::all('id','name');

        return response()->json([
            'data'=> $datas,
            'user'=> $users,
            'client' => $clients
        ]);
    }

    public function client($id)
    {
        //query letter based on client id
        $clients = Letter::where('client_id', $id)->whereNotIn('status', ['completed', 'withdrawn'])->where('date_completed', null)->get();

        if (count($clients) > 0) {
            return response()->json([
                'clients' => $clients
            ], 200);
        }

         //return message when no record found
        return response()->json([
            'message' => 'No client found'
        ]);


    }

    public function status($id, $status){
        //Query letters based on client and its status
        $letters = Letter::where('status',$status)->where('date_completed', null)
        ->with(['author:id,first_name','client:id,name','department:id,name','assignments.user:id,first_name'])
        ->whereHas('client', function ($query)  use ($id){
            $query->where('id', $id);
        })->get();


        if (count($letters) > 0) {
            return response()->json([
                'letters'=>  $letters
            ],200);
        }

        //return message when no record found
        return response()->json([
            'message' => 'No record found'
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
}
