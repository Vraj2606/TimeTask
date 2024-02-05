<?php
if (Session::exists('success')) {
    alert()->success(Session::get('success'));
    Session::forget('success');
}
$i = 1;
?>
@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="float-left">
                <h2>Employee List</h2>
            </div>
            <div class="float-right">
                <a type="button" class="btn btn-success" href="{{ route('employees.create') }}">Add Employee Details</a>
            </div>
        </div>
    </div>
    <div class="form-group">
        <input type="text" id="search" name="search" class="form-control"
            placeholder="Search for Name, Email, Date & Time">
    </div>
    <div style="height: 400px; overflow-y: auto;" id="employeeTable">
        @if (count($employees) > 0)
            <table class="table table-bordered">
                <thead class="thead-dark sticky-top">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Date</th>
                        <th>In Time</th>
                        <th>Out Time</th>
                        <th>Effective Time</th>
                        <th>Break Time</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employees as $employee)
                        @php
                            $rowClass = '';
                            if ($employee['break'] > 60) {
                                $rowClass = 'table-success';
                            } elseif ($employee['time'] < 240) {
                                $rowClass = 'table-warning';
                            } elseif ($employee['time'] < 480) {
                                $rowClass = 'table-danger';
                            }
                        @endphp
                        <tr class="{{ $rowClass }}">
                            <th>{{ $employee['id'] }}</th>
                            <td>{{ $employee['name'] }}</td>
                            <td>{{ $employee['email'] }}</td>
                            <td>
                                @foreach ($employee['attendance'] as $employee_date)
                                    <p>{{ $employee_date['date'] }}</p>
                                @endforeach
                            </td>
                            <td>
                                @foreach ($employee['attendance'] as $employee_in_time)
                                    <p>{{ $employee_in_time['in_time'] }}</p>
                                @endforeach
                            </td>
                            <td>
                                @foreach ($employee['attendance'] as $employee_out_time)
                                    <p>{{ $employee_out_time['out_time'] }}</p>
                                @endforeach
                            </td>
                            <td>{{ $employee['time'] }}</td>
                            <td>{{ $employee['break'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <h3>Employees will be shown here.</h3>
        @endif
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.4/jquery.validate.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#search').on('keyup', function() {
                var search = $('#search').val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "get",
                    data: {
                        'search': search
                    },
                    url: "{{ url('/search') }}",
                    success: function(data) {
                        console.log(data);
                        $('#employeeTable tbody').empty();
                        if (data.length > 0) {
                            $.each(data, function(index, employee) {
                                var rowClass = '';
                                if (employee.break > 60)
                                    rowClass = 'table-success';
                                else if (employee.time < 240) {
                                    rowClass = 'table-warning';
                                } else if (employee.time < 480) {
                                    rowClass = 'table-danger';
                                }
                                $('#employeeTable tbody').append(
                                    `<tr class="${rowClass}">
                                        <th>${employee.id}</th> 
                                        <td>${employee.name}</td>
                                        <td>${employee.email}</td>
                                        <td>
                                            ${employee.attendance.map(entry => 
                                                `<p>${entry.date}</p>`).join('')}
                                        </td>
                                        <td>
                                            ${employee.attendance.map(entry => 
                                                `<p>${entry.in_time}</p>`).join('')}
                                        </td>
                                        <td>
                                            ${employee.attendance.map(entry => 
                                                `<p>${entry.out_time}</p>`).join('')}
                                        </td>
                                        <td>${employee.time}</td>
                                        <td>${employee.break}</td>
                                    </tr>`
                                );
                            });
                        } else {
                            $('#employeeTable tbody').append(
                                '<tr><td colspan="12">No employees found</td></tr>');
                        }
                    },
                    error: function(error) {
                        console.error("AJAX Error:", error);
                    }
                });
            });
        });
    </script>
@endsection
