
@extends('layouts.app')



@section('timesheets')
<div class="container">
        @if (isset($timesheet))
        {{var_dump($timesheet)}}
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Clocked In</th>
                <th>Went to Lunch At</th>
                <th>Came Back From Lunch At</th>
                <th>Clocked Out</th>
                <th>Marked for Review</th>
            </tr>
        </thead>
        <tbody>
                

            <tr>
                <td>{{ $timesheet->first_name }} {{ $timesheet->last_name }}</td>
                <td>{{ $timesheet->clocked_in_at }}</td>
                <td>{{ $timesheet->lunch_in_at }}</td>
                <td>{{ $timesheet->lunch_out_at }}</td>
                <td>{{ $timesheet->clocked_out_at }}</td>
                <td>{{ $timesheet->marked_for_review }}</td>
            </tr>
                  
                
            
        </tbody>
    </table>
    @else
    <div class="row">
            <div class="col-md-12">No Date Today</div>
    </div>
    @endif
    
    <div class="row">
        {{-- //{{ $timesheet->lunch_in_at != null ? '' : 'disabled' }} --}}
  
            <div class="col-md-3">@if (!isset($timesheet->clocked_in_at)) <a href="{{ route('clockin') }}" class="btn btn-primary" >Clock In</a> @endif</div>
            <div class="col-md-3">@if (!isset($timesheet->lunch_in_at)) <a href="{{ isset($timesheet->id) ? route('lunchin', ['id' => $timesheet->id])  : '' }}"  class="btn btn-primary"  >Go to Lunch</a> @endif</div>
            <div class="col-md-3">@if (!isset($timesheet->lunch_out_at))<button class="btn btn-primary"  >Come Back from Lunch</button> @endif</div>
            <div class="col-md-3">@if (!isset($timesheet->clocked_out_at))<button class="btn btn-primary">Clock Out</button> @endif</div>
    </div>
    
</div>

@endsection