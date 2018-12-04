
@extends('layouts.app')



@section('timesheets')
<div class="container">
        @if (isset($timesheets))
        {{-- {{var_dump($timesheets)}} --}}

<div class="row">
    <div class="col-md-5">Time controls go here</div>
    <div class="col-md-3"><input type='date'/></div>
    <div class="col-md-3"><input type='date'/></div>
</div>

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
                                <td>{{ $row->clocked_in_at }}</td>
                                <td>{{ $row->lunch_in_at }}</td>
                                <td>{{ $row->lunch_out_at }}</td>
                                <td>{{ $row->clocked_out_at }}</td>
                                <td>{{ $row->marked_for_review }}</td>
                                @if (Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Manager'))
                                <td><button class="btn btn-info timesheet-edit" data-rowid="{{$row->id}}">Edit</button> </td>
                                @endif
                            </tr>
                            @if (Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Manager'))
                            <form action="{{ url('timesheet/edit') }}" method="put">
                                <tr class="table-info erows d-none edit_{{$row->timesheet_id}}">
                                    <td><input type="hidden" name="id" value="{{ $row->timesheet_id }}"/></td>
                                    <td><input type="text" name="clocked_in_at" value="{{ $row->clocked_in_at }}"/></td>
                                    <td><input type="text" name="lunch_in_at" value="{{ $row->lunch_in_at }}"/></td>
                                    <td><input type="text" name="lunch_out_at" value="{{ $row->lunch_out_at }}"/></td>
                                    <td><input type="text" name="clocked_out_at" value="{{ $row->clocked_out_at }}"/></td>
                                    <td></td>
                                    <td><button class="btn btn-primary">Save</button></td>
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

<script>
 
  

</script>



@endsection