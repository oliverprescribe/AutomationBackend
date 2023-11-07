<?php

namespace App\Http\Controllers;
use Exception;

use App\Models\Author;
use App\Models\Client;
use App\Models\Letter;
use App\Models\Dashboard;
use App\Models\Department;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use function Laravel\Prompts\select;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

class MonitoringController extends Controller
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

    //get all clients letter
    public function client($id)
    {

        try {

            if (count($this->get_client_letter($id)) > 0) {
                return response()->json([
                    'clients' => $this->get_client_letter($id),
                    'status_counts' =>  $this->get_letter_groupBy_status($id)
                ], 200);
            }

            //return message when no record found
            return response()->json([
                'message' => 'No client found'
            ]);
        } catch (Exception $e) {

            Log::error($e->getMessage());

            return response()->json([
                'message' => 'something went wrong!'
            ]);
        }


    }

    //query all letter based on client id
    public function get_client_letter($id){
        return Letter::where('client_id', $id)
        ->whereNotIn('status', ['completed', 'withdrawn'])
        ->where('date_completed', null)
        ->get();
    }

    //count all letters based on status
    public function get_letter_groupBy_status($id){
        return Letter::selectRaw('status, count(id) as total')
        ->where('client_id', $id)
        ->whereNotIn('status', ['completed', 'withdrawn'])
        ->where('date_completed', null)
        ->groupBy('status')
        ->get();
    }


    //get status of letters based on client id and its status
    public function status($id, $status){

        try {

            if (count($this->get_letters_client_and_status($id,$status)) > 0) {
                return response()->json([
                    'letters'=>  $this->get_letters_client_and_status($id,$status)
                ],200);
            }

            //return message when no record found
            return response()->json([
                'message' => 'No record found'
            ]);

        } catch (Exception $e) {

            Log::error($e->getMessage());

            return response()->json([
                'message' => 'something went wrong!'
            ]);
        }




    }

    //query letters based on client id and status
    public function get_letters_client_and_status($id, $status){

        return Letter::where('status',$status)->where('date_completed', null)
        ->with(['author:id,first_name','client:id,name','department:id,name','assignments.user:id,first_name'])
        ->whereHas('client', function ($query)  use ($id){
            $query->where('id', $id);
        })->get();
    }


}
