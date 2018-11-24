
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
    @endif
    
    <div class="row">
            <div class="col-md-3"><button class="btn btn-primary" {{ ( $timesheet->clocked_in_at !=null) ? '' : 'disabled' }}>Clock In</button></div>
            <div class="col-md-3"><a href="{{ route('lunchin', ['id' => $timesheet->id]) }}" class="btn btn-primary" {{ $timesheet->lunch_in_at != null ? '' : 'disabled' }}>Go to Lunch</a></div>
            <div class="col-md-3"><button class="btn btn-primary" {{ ( $timesheet->lunch_out_at == null && $timesheet->clocked_in_at != null && $timesheet->lunch_in_at != null && $timesheet->clocked_out_at == null) ? '' : 'disabled' }}>Come Back from Lunch</button></div>
            <div class="col-md-3"><button class="btn btn-primary" {{ ( $timesheet->clocked_out_at == null && $timesheet->clocked_in_at != null && $timesheet->lunch_out_at != null && $timesheet->lunch_in_at != null) ? '' : 'disabled' }}>Clock Out</button></div>
    </div>
</div>

@endsection