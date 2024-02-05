@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="float-left">
                <h2>Update Employee Detail</h2>
            </div>
            <div class="float-right">
                <a class="btn btn-primary" href="{{ route('employees.index') }}">Back</a>
            </div>
        </div>
    </div>


    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form action="{{ route('employees.update', $employee->id) }}" method="POST" id="empForm">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-12 form-group">
                <strong>Name : </strong>
                <input type="text" name="name" class="form-control" placeholder="Employee's Name"
                    value="{{ old('name', $employee->name) }}">
            </div>
            <div class="col-12 form-group">
                <strong>Email : </strong>
                <input type="email" name="email" class="form-control" placeholder="Employee's Email"
                    value="{{ old('email', $employee->email) }}">
            </div>
            <div class="col-12 form-group">
                <strong>Date : </strong>
                <input type="date" name="date" class="form-control" value="{{ old('date', $employee->date) }}">
            </div>
            <div class="col-12 form-group">
                <strong>In Time : </strong>
                <input type="time" name="in_time" class="form-control" value="{{ old('in_time', $employee->in_time) }}">
            </div>
            <div class="col-12 form-group">
                <strong>Out Time : </strong>
                <input type="time" name="out_time" class="form-control"
                    value="{{ old('out_time', $employee->out_time) }}">
            </div>
            <button type="submit" class="btn btn-success mx-auto d-block">Update Employee</button>
        </div>


    </form>
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.4/jquery.validate.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#compForm").validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 3
                    },
                    address: {
                        required: true,
                        minlength: 10
                    }
                },
                messages: {
                    name: {
                        required: "Name is required!",
                        minlength: "Name must be at least 3 characters long"
                    },
                    address: {
                        required: "Address is required!",
                        minlength: "Address must be at least 10 characters long"
                    }
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
    </script> --}}
@endsection
