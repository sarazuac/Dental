import axios from 'axios';
import React, { Component } from 'react';
import { Link } from 'react-router-dom';

class TimesheetList extends Component {
    constructor() {
        super();
        this.state = {
            timesheets: []
        };
    }

    componentDidMount() {
        var headers = {
            'Content-Type': 'application/json'
        };

        axios.get('/api/timesheets', { headers: headers }).then(response => {
            console.log(response);
            this.setState({
                timesheets: response.data.timesheets
            });
        });
    }

    render() {
        const { timesheets } = this.state;
        return (
            <div className="container">
                <table>
                    <thead className="table table-bordered table-striped table-bordered">
                        <tr>
                            <th>Name</th>
                            <th>Clocked In At</th>
                            <th>Went To Lunch At</th>
                            <th>Came Back From Lunch At</th>
                            <th>Clocked Out At</th>
                            <th>Marked For Review</th>
                        </tr>
                    </thead>

                    <tbody>
                        {timesheets.map(timesheet => (
                            <tr to={`/${timesheet.id}`} key={timesheet.id}>
                                <td>
                                    {timesheet.first_name} {timesheet.last_name}
                                </td>
                                <td> {timesheet.clocked_in_at}</td>
                                <td> {timesheet.lunch_in_at}</td>
                                <td> {timesheet.lunch_out_at}</td>
                                <td> {timesheet.clocked_out_at}</td>
                                <td> {timesheet.marked_for_review}</td>
                            </tr>
                        ))}
                    </tbody>
                </table>
            </div>
        );
    }
}

export default TimesheetList;
