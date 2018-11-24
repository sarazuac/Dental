<?php

namespace App\Http\Controllers;

use App\Models\Timesheet;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use \Datetime;
use Webpatser\Uuid\Uuid;
use Illuminate\Support\Facades\Auth;

use DB;

class TimesheetController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function getTimesheets(){

            $data = [];
            $timesheets = DB::table('timesheets')->join('users', 'timesheets.user_id', '=', 'users.id') ->get();
            // $response = [
            //     'timesheets' => $timesheets
            // ];
            //return response()->json($response, 200);

            $data['timesheets'] = $timesheets;
            return view('timesheets', $data);

    }
    public function getTimestampsByUser(Request $request){

        $data = [];
        $timesheet = DB::table('timesheets')->join('users', 'timesheets.user_id', '=', 'users.id')
        ->where('user_id', '=', Auth::user()->id)
        ->where('timesheets.clocked_in_at', '>=','2018-11-24 00:00:00')
        ->orderBy('clocked_in_at', 'desc')->first();
        
        $data['timesheet'] = $timesheet;
        //return response()->json($response, 200);
        return view('mytimesheet', $data);

}
    public function postClockIn(Request $request){

        $timesheet = new Timesheet();
        $timesheet->id = (string) Uuid::generate(4);

        $timesheet->clocked_in_at = new DateTime();
        $timesheet->save();
        return response()->json($timesheet, 201);

    }
    public function putClockIn(Request $request, $id){

        $timesheet = new Timesheet();
        $timesheet->user_id = $request->input('user_id');
        $timesheet->clocked_in_at = new DateTime();        ;
        $timesheet->save();
        return response()->json(['timesheet' =>$timesheet], 201);

    }
    public function putLunchIn(Request $request, $id){

        echo $id;
        $timesheet = Timesheet::find($id);
        if(!$timesheet){
            return response()->json(['message' => 'Timesheet not found'], 404);
        }
        $timesheet->lunch_in_at = new DateTime();
        $timesheet->save();
        

        return redirect('timesheet');
    }
    public function postLunchOut(Request $request, $id){
        $timesheet = Timesheet::find($id);
        if(!$timesheet){
            return response()->json(['message' => 'Timesheet not found'], 404);
        }
        $timesheet->lunch_out_at = new DateTime();
        $timesheet->save();
        return response()->json(['timesheet' => $timesheet], 200);
    }
    public function postClockOut(Request $request, $id){
        $timesheet = Timesheet::find($id);
        if(!$timesheet){
            return response()->json(['message' => 'Timesheet not found'], 404);
        }
        $timesheet->clocked_out_at = new DateTime();
        $timesheet->save();
        return response()->json(['timesheet' => $timesheet], 200);
    }
    public function deleteTimesheet(Request $request, $id){
        $timesheet = Timesheet::find($id);
        if(!$timesheet){
            return response()->json(['message' => 'Timesheet not found'], 404);
        }
        $timesheet->delete();
        return response()->json(['message' => 'Timesheet deleted'], 200);
    }






    //
}
