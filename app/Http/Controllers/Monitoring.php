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
        // $department = Department::find(1);
        // $department->whereHas('letters', function($query){
        //     return $query->whereIn('status', ['for_typing', 'being_typed']);
        // });

        $client = Client::find($id);

        if ($client) {
            return response()->json([
                'client' => $client
            ]);
        }

        return response()->json([
            'message' => 'No client found'
        ]);


    }

    public function status($id, $status){

        $letters = Letter::where('status',$status)
        // ->select('id','reference','job_number','created_at', 'created_at', 'author_created')
        ->with(['author:id,first_name','client:id,name','department:id,name','assignments.user:id,first_name'])
        ->whereHas('client', function ($query)  use ($id){
            $query->where('id', $id);
        })
        ->get();

        if (empty($letters)) {
            return response()->json([
                'letters'=>  $letters
            ]);
        }

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
