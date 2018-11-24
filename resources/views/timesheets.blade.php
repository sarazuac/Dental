
@extends('layouts.app')



@section('timesheets')
<div class="container">
        @if (isset($timesheets))
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
                
                
                    @foreach ($timesheets as $row)

                            <tr>
                                <td>{{ $row->first_name }} {{ $row->last_name }}</td>
                                <td>{{ $row->clocked_in_at }}</td>
                                <td>{{ $row->lunch_in_at }}</td>
                                <td>{{ $row->lunch_out_at }}</td>
                                <td>{{ $row->clocked_out_at }}</td>
                                <td>{{ $row->marked_for_review }}</td>
                            </tr>
                    @endforeach
                
            
        </tbody>
    </table>
    @endif

</div>



@endsection