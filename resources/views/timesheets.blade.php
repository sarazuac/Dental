
@extends('layouts.app')



@section('timesheets')
{{-- 
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"> --}}
<script
  src="https://code.jquery.com/jquery-2.2.4.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css" />
<div class="container">
        @if (isset($timesheets))
        {{-- {{var_dump($timesheets)}} --}}
{{-- 
<div class="row">
    <div class="col-md-5">Time controls go here</div>
    <div class="col-md-3"><input type='date'/></div>
    <div class="col-md-3"><input type='date'/></div>
</div> --}}
<br>
        <div class="row">  

        
    <table class="table table-bordered table-hover " style="margin-top:20px">
        <thead class="thead-dark">
            <tr>
                <th>Name</th>
                <th>Clocked In</th>
                <th>Went to Lunch At</th>
                <th>Came Back From Lunch At</th>
                <th>Clocked Out</th>
                <th>Marked for Review</th>
                @if (Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Manager'))  <th>Modify</th> @endif
            </tr>
        </thead>
        <tbody>
                
                
                    @foreach ($timesheets as $row)

                            <tr class="{{ $row->marked_for_review ==1 ? 'table-danger' : '' }}">
                                <td>{{ $row->first_name }} {{ $row->last_name }}</td>
                                <td>{{ (isset($row->clocked_in_at)) ? \Carbon\Carbon::parse($row->clocked_in_at)->toDayDateTimeString() : ' -- ' }}</td>
                                <td>{{ (isset($row->lunch_in_at)) ? \Carbon\Carbon::parse($row->lunch_in_at)->toDayDateTimeString() : ' -- ' }}</td>
                                <td>{{ (isset($row->lunch_out_at)) ? \Carbon\Carbon::parse($row->lunch_out_at)->toDayDateTimeString() : ' -- ' }}</td>
                                <td>{{ (isset($row->clocked_out_at)) ? \Carbon\Carbon::parse($row->clocked_out_at)->toDayDateTimeString() : ' -- ' }}</td>
                                <td>{{ $row->marked_for_review }}</td>
                                @if (Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Manager'))
                                <td><button class="btn btn-info timesheet-edit" data-rowid="{{$row->id}}">Edit</button> </td>
                                @endif
                            </tr>
                            @if (Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Manager'))
                            <form action="{{ action('TimesheetController@putTimesheet') }}" method="POST">
                                {{csrf_field()}}
                                <tr class="table-info erows d-none edit_{{$row->timesheet_id}}">
                                    <td><input type="hidden" name="id" value="{{ $row->timesheet_id }}"/></td>
                                    <td>
                                        <input type="text" name="clocked_in_at" value="{{ $row->clocked_in_at }}"/> 
                                        {{-- <div class="form-group">
                                            <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker1"/>
                                                <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div> --}}
                                    </td>
                                    <td><input type="text" name="lunch_in_at" value="{{ $row->lunch_in_at }}"/></td>
                                    <td><input type="text" name="lunch_out_at" value="{{ $row->lunch_out_at }}"/></td>
                                    <td><input type="text" name="clocked_out_at" value="{{ $row->clocked_out_at }}"/></td>
                                    <td></td>
                                    <td><button class="btn btn-primary" type="submit">Save</button></td>
                                </tr>
                            </form>
                            @endif

                    @endforeach
                
            
        </tbody>
    </table>
    {{ $timesheets->links() }}
    @endif
</div>
</div>



<script type="text/javascript">
 $(function () {
           
            });

</script>  


@endsection