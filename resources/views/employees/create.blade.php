@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="float-left">
                <h2>Add Employee</h2>
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
    <form action="{{ route('employees.store') }}" method="POST" id="empform">
        @csrf
        <div class="row">
            <div class="col-12 form-group">
                <strong>Name:</strong>
                <input type="text" name="name" class="form-control" placeholder="Employee's name"
                    value="{{ old('name') }}">
            </div>
            <div class="col-12 form-group">
                <strong>Email:</strong>
                <input type="email" name="email" class="form-control" placeholder="Employee's Email"
                    value="{{ old('email') }}">
            </div>
            <div id="attendanceFields">
                <div class="attendance-field">
                    <div class="row">
                        <div class="col-3 form-group">
                            <label for="date">Date:</label>
                            <input type="date" name="date[]" class="form-control" value="{{ old('date[]') }}">
                        </div>
                        <div class="col-3 form-group">
                            <label for="in_time">In Time:</label>
                            <input type="time" name="in_time[]" class="form-control" value="{{ old('in_time[]') }}">
                        </div>
                        <div class="col-3 form-group">
                            <label for="out_time">Out Time:</label>
                            <input type="time" name="out_time[]" class="form-control" value="{{ old('out_time[]') }}">
                        </div>
                        <div class="col-3 form-group">
                            <div class="row">
                                <button type="button" class="add btn btn-primary form-control"
                                    onclick="addMoreFields()">Add
                                    More</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 form-group">
                <button type="submit" class="row btn btn-success mx-auto d-block">Add Employee</button>
            </div>
        </div>
    </form>
    <script>
        function addMoreFields() {
            var newField = document.createElement('div');
            newField.className = 'attendance-field';

            newField.innerHTML = `
                    <div class="row">
                        <div class="col-3 form-group">
                            <label for="date">Date:</label>
                            <input type="date" name="date[]" class="form-control" value="{{ old('date[]') }}">
                        </div>
                        <div class="col-3 form-group">
                            <label for="in_time">In Time:</label>
                            <input type="time" name="in_time[]" class="form-control" value="{{ old('in_time[]') }}">
                        </div>
                        <div class="col-3 form-group">
                            <label for="out_time">Out Time:</label>
                            <input type="time" name="out_time[]" class="form-control" value="{{ old('out_time[]') }}">
                        </div>
                        <div class="col-3 form-group">
                                <button type="button" class="add btn btn-primary form-control"
                                    onclick="addMoreFields()">Add
                                    More</button>
                                <button type="button" class="btn btn-danger form-control delete"
                                    onclick="deleteFields(this)">Delete</button>

                        </div>
                    </div>
            `;

            document.getElementById('attendanceFields').appendChild(newField);
        }

        function deleteFields(button) {
            var fieldToRemove = button.parentNode.parentNode.parentNode;
            document.getElementById('attendanceFields').removeChild(fieldToRemove);
        }
    </script>
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.4/jquery.validate.min.js"></script>
<script>
    $(document).ready(function () {
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
            submitHandler: function (form) {
                form.submit();
            }
        });
    });
</script> --}}
@endsection
