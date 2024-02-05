@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="float-left">
                <h2>Show Employee's Details</h2>
            </div>
            <div class="float-right">
                <a class="btn btn-primary" href="{{ route('employees.index') }}">Back</a>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-12 form-group">
            <strong>Name : </strong>
            {{ $employee->name }}
        </div>
        <div class="col-12 form-group">
            <strong>Email : </strong>
            {{ $employee->email }}
        </div>
        <div class="col-12 form-group">
            <strong>Date : </strong>
            {{ $employee->date }}
        </div>
        <div class="col-12 form-group">
            <strong>In Time : </strong>
            {{ $employee->in_time }}
        </div>
        <div class="col-12 form-group">
            <strong>Out Time: </strong>
            {{ $employee->out_time }}
        </div>
    </div>
@endsection
