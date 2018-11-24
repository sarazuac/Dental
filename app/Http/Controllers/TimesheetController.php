<?php

namespace App\Http\Controllers;

use App\Models\Timesheet;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use \Datetime;
use Webpatser\Uuid\Uuid;

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

            $timesheet = DB::table('timesheets')->join('users', 'timesheets.user_id', '=', 'users.id') ->get();
            $response = [
                'timesheets' => $timesheet
            ];
            return response()->json($response, 200);

    }
    public function getTimestampsByUser(Request $request, $user_id){

        $timestamp = Timesheet::where('user_id', '=', $user_id)->get();;
        $response = [
            'timesheet' => $timesheet
        ];
        return response()->json($response, 200);

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
    public function postLunchIn(Request $request, $id){
        $timesheet = Timesheet::find($id);
        if(!$timesheet){
            return response()->json(['message' => 'Timesheet not found'], 404);
        }
        $timesheet->lunch_in_at = new DateTime();
        $timesheet->save();
        return response()->json(['timesheet' => $timesheet], 200);
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
