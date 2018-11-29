
@extends('layouts.app')



@section('timesheets')
<div class="container">
        @if (isset($timesheet))
        {{-- {{var_dump($timesheet)}} --}}
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Clocked In</th>
                <th>Went to Lunch At</th>
                <th>Came Back From Lunch At</th>
                <th>Clocked Out</th>
                <th>Total</th>
                <th>Marked for Review</th>
            </tr>
        </thead>
        <tbody>
                

            <tr>
                <td>{{ $timesheet->first_name }} {{ $timesheet->last_name }}</td>
                <td>{{ \Carbon\Carbon::parse($timesheet->clocked_in_at)->toDayDateTimeString() }}</td>
                <td>{{ (isset($timesheet->lunch_in_at)) ? \Carbon\Carbon::parse($timesheet->lunch_in_at)->toDayDateTimeString() : ' -- ' }}</td>
                <td>{{ (isset($timesheet->lunch_out_at)) ? \Carbon\Carbon::parse($timesheet->lunch_out_at)->toDayDateTimeString() : ' -- ' }}</td>
                <td>{{ (isset($timesheet->clocked_out_at)) ? \Carbon\Carbon::parse($timesheet->clocked_out_at)->toDayDateTimeString() : ' -- ' }}</td>
                <td>

                @php
                    $worked = round(\Carbon\Carbon::parse($timesheet->clocked_in_at)->diffInRealMinutes($timesheet->clocked_out_at)  / 60, 2);
                    $lunch =  round(\Carbon\Carbon::parse($timesheet->lunch_in_at)->diffInRealMinutes($timesheet->lunch_out_at)  / 60, 2); 
                    echo ($worked-$lunch) ." hrs" ;     
                @endphp
                
                </td>
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
            <div class="col-md-3">@if (!isset($timesheet->lunch_out_at))<a href="{{ isset($timesheet->id) ? route('lunchout', ['id' => $timesheet->id])  : '' }}" class="btn btn-primary"  >Come Back from Lunch</a> @endif</div>
            <div class="col-md-3">@if (!isset($timesheet->clocked_out_at))<a href="{{ isset($timesheet->id) ? route('clockout', ['id' => $timesheet->id])  : '' }}" class="btn btn-primary">Clock Out</a> @endif</div>
    </div>
    
</div>

@endsection