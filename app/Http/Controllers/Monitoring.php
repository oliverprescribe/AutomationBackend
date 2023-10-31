<?php

namespace App\Http\Controllers;
use App\Models\Log;
use App\Models\Author;
use App\Models\Client;
use App\Models\Letter;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;

use function Laravel\Prompts\select;

class Monitoring extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index($id)
    {
        //get client based on client id
        $client = Client::find($id);

        if (count($client) > 0) {
            return response()->json([
                'client' => $client
            ], 200);
        }

        return response()->json([
            'message' => 'No client found'
        ], 404);


    }

    public function status($id, $status){

        $letters = Letter::where('status',$status)
        ->with(['author:id,first_name','client:id,name','department:id,name','assignments.user:id,first_name'])
        ->whereHas('client', function ($query)  use ($id){
            $query->where('id', $id);
        })->get();

        if (count($letters) > 0) {
            return response()->json([
                'letters'=>  $letters
            ],200);
        }

        return response()->json([
            'message' => 'No record found'
        ],404);




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
