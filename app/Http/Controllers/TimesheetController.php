<?php

namespace App\Http\Controllers;

use App\Models\Timesheet;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use \Datetime;
use Carbon\Carbon;
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

        if (Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Manager')){
            $timesheets = DB::table('timesheets')->join('users', 'timesheets.user_id', '=', 'users.id')->select('timesheets.id AS timesheet_id', 'users.*', 'timesheets.*')->orderBy('clocked_in_at', 'desc')->paginate(5);
        }else{
            $timesheets = DB::table('timesheets')->join('users', 'timesheets.user_id', '=', 'users.id')->select('timesheets.id AS timesheet_id', 'users.*', 'timesheets.*')->where('timesheets.user_id', '=', Auth::user()->id)->orderBy('clocked_in_at', 'desc')->paginate(5);
        }
    
        $data['timesheets'] = $timesheets;

        return view('timesheets', $data);

    }

    public function putTimesheet(Request $request){


        $data = [];
        try{
            $timesheet = Timesheet::find($request->id);
            $timesheet->clocked_in_at = $request->clocked_in_at;
            $timesheet->lunch_in_at = $request->lunch_in_at;
            $timesheet->lunch_out_at = $request->lunch_out_at;
            $timesheet->clocked_out_at = $request->clocked_out_at;
            $timesheet->save();
            
            toastr()->success('Data has been saved successfully!');

        }catch(Exception $e){
            toastr()->error('Opps! Something went wrong! Please Try Again.');
            throw new Exception( "Example message." );
        }finally{
             return redirect('timesheets');
        }

       

    }

    public function getTimesheetsByUser(Request $request){

        $data = [];
        $timesheet = DB::table('timesheets')->join('users', 'timesheets.user_id', '=', 'users.id')
        ->select('timesheets.id AS timesheet_id', 'users.*', 'timesheets.*')
        ->where('timesheets.user_id', '=', Auth::user()->id)
        ->where('timesheets.clocked_in_at', '>=',Carbon::today()->toDateString())
        ->orderBy('clocked_in_at', 'desc')->first();
        
        $data['timesheet'] = $timesheet;
        //return response()->json($response, 200);
        return view('mytimesheet', $data);

}
    public function postClockIn(Request $request){
        try{
            $timesheet = new Timesheet();
            $timesheet->clocked_in_at = new DateTime();
            $timesheet->user_id = Auth::user()->id;
            $timesheet->save();
            // return response()->json($timesheet, 201);
            toastr()->success('Data has been saved successfully!');

        }catch(Exception $e){
            toastr()->error('Opps! Something went wrong! Please Try Again.');
            throw new Exception( "Example message." );
        }finally{
            return redirect('timesheet');
        }

    }
    public function putClockIn(Request $request, $id){

        // try{
        //     $timesheet = new Timesheet();
        //     $timesheet->user_id = Auth::user()->id;
        //     $timesheet->clocked_in_at = new DateTime();
        //     $timesheet->save();

        // }catch(Exception $e){

        // }finally{
        //     return redirect('timesheet');
        // }

        
        // return response()->json(['timesheet' =>$timesheet], 201);

    }

    public function putLunchIn(Request $request, $id){

        try{
            $timesheet = Timesheet::find($id);
            $timesheet->lunch_in_at = new DateTime();
            $timesheet->save();
            
            toastr()->success('Data has been saved successfully!');

        }catch(Exception $e){
            toastr()->error('Opps! Something went wrong! Please Try Again.');
            throw new Exception( "Example message." );
        }finally{
            return redirect('timesheet');
        }

        // $timesheet = Timesheet::find($id);
        // $timesheet->lunch_in_at = new DateTime();
        // saveTimesheetWithToastr($timesheet);


    }
    public function putLunchOut(Request $request, $id){
        $timesheet = Timesheet::find($id);
        if(!$timesheet){
            return response()->json(['message' => 'Timesheet not found'], 404);
        }
        $timesheet->lunch_out_at = new DateTime();
        $timesheet->save();
        //return response()->json(['timesheet' => $timesheet], 200);
        toastr()->success('Data has been saved successfully!');
        return redirect('timesheet');
    }
    public function putClockOut(Request $request, $id){
        $timesheet = Timesheet::find($id);
        if(!$timesheet){
            return response()->json(['message' => 'Timesheet not found'], 404);
        }
        $timesheet->clocked_out_at = new DateTime();
        $timesheet->save();
        // return response()->json(['timesheet' => $timesheet], 200);
        toastr()->success('Data has been saved successfully!');
        return redirect('timesheet');
    }
    public function deleteTimesheet(Request $request, $id){
        $timesheet = Timesheet::find($id);
        if(!$timesheet){
            return response()->json(['message' => 'Timesheet not found'], 404);
        }
        $timesheet->delete();
        return response()->json(['message' => 'Timesheet deleted'], 200);
    }


    private function saveTimesheetWithToastr(Timesheet $t){

        try{
          
            $timesheet->save();
            
            toastr()->success('Data has been saved successfully!');

        }catch(Exception $e){
            toastr()->error('Opps! Something went wrong! Please Try Again.');
            throw new Exception( "Example message." );
        }finally{
            return redirect('timesheet');
        }

    }



    //
}
