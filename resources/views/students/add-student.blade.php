@extends('includes.master')
<?php
$students = $students ?? null;
$courses = $courses ?? $enroll_courses;
$enroll_courses = $enroll_courses ?? null;
$students_array = $students_array ?? null;
?>
@section('title', 'Add New Student')
@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
        .bootstrap-select {
            display: block !important;
            width: 100% !important;
        }
    </style>
@endpush
@section('page-content')
    <div class="card m-auto">
        <div class="card-header">
            <div class="card-text">{{ $students ? 'Edit' : 'Create' }} Student</div>
        </div>
        <div class="card-body">
            @if (session()->has('message'))
                <div class="alert alert-info">
                    {{ session('message') }}
                </div>
            @endif
            <div id="save_msgList"></div>
            <form id="student_form" enctype="multipart/form-data">
                @csrf
                @if ($students)
                    @method('put')
                @endif
                <div class="mb-3">
                    <label class="form-label">Full Name</label>
                    <input type="text" name="name" class="form-control"
                        value="{{ old('name') ?? optional($students)->name }}">
                    @error('name')
                        <p class="text-danger my-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">CNIC Number</label>

                    <input type="text" name="cnic" class="form-control" id="js_cnic"
                        data-inputmask="'mask': '99999-9999999-9'" placeholder="XXXXX-XXXXXXX-X"
                        value="{{ old('cnic') ?? optional($students)->cnic }}">
                    @error('cnic')
                        <p class="text-danger my-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Date Of Birth</label>
                    <input type="text" id="js_birthday" name="dob" class="form-control"
                        value="{{ old('dob') ?? optional($students)->dob }}">
                    @error('dob')
                        <p class="text-danger my-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Age</label>
                    <input type="number" name="age" class="form-control"
                        value="{{ old('age') ?? optional($students)->age }}">
                    @error('age')
                        <p class="text-danger my-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Gender</label>
                    <select class="form-select" name="gender" id="gender">
                        <option value="">--Select Gender--</option>
                        <option value="Male"
                            {{ old('gender') ?? optional($students)->gender == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female"
                            {{ old('gender') ?? optional($students)->gender == 'Female' ? 'selected' : '' }}>Female
                        </option>
                    </select>
                    @error('gender')
                        <p class="text-danger my-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Course</label>
                    <select class="form-select selectpicker" multiple data-live-search="true" name="course[]"
                        id="select_course" value="">
                        <option value="">--Select Course--</option>

                        @foreach ($courses as $course)
                            <option value="{{ $course->id }}" {{ $enroll_courses ? 'selected' : '' }}>
                                {{ $course->course_title }}</option>
                        @endforeach
                    </select>

                </div>
                <button type="submit" class="btn btn-primary btn-submit">{{ $students ? 'Update' : 'Create' }}
                    Student</button>
            </form>
        </div>
    </div>
    <div class="card mt-5">
        <div class="card-header d-flex justify-content-between">
            <div class="card-title">Students</div>
            <a href="{{ route('student.create') }}" class="btn btn-sm btn-link btn-primary text-light">
                Add new Student
            </a>
        </div>

        <div class="card-body table-responsive">
            @if (session()->has('message'))
                <div class="alert alert-info">
                    {{ session('message') }}
                </div>
            @endif
            <table id="sm-datatable" class="table mt-3">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">CNIC</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>

                <tbody>
                    {{-- @foreach ($students_array as $student)
                        <tr>
                            <th scope="col"> {{ $loop->iteration }} </th>
                            <td scope="col">
                                <a href="{{ route('student.show', [$student->id]) }}">
                                    {{ $student->name }}
                                </a>
                            </td>
                            <td scope="col">{{ $student->cnic }} </td>
                            <td scope="col">{{ $student->cnic }} </td>
                            <td scope="col">
                                <div class="form-button-action d-flex justify-content-around">

                                    @if ($student->trashed())
                                        <form action="{{ route('student.restore', [$student->id]) }}" method="POST">
                                            @csrf
                                            @method('PUT')

                                            <button class="btn btn-sm btn-link btn-success text-light"
                                                data-bs-toggle="tooltip" data-placement="top" title="Activate">
                                                <i class="fas fa-check-circle"></i>
                                            </button>
                                        </form>
                                    @else
                                        <a href="{{ route('student.edit', [$student->id]) }}" data-bs-toggle="tooltip"
                                            data-placement="top" title="Edit">
                                            <button class="btn btn-sm btn-link btn-primary text-light">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </a>

                                        <a data-bs-toggle="tooltip" data-placement="top" title="Deactivate">
                                            <form action="{{ route('student.destroy', [$student->id]) }}" method="POST">
                                                @csrf
                                                @method('DELETE')

                                                <button class="btn btn-sm  btn-danger"> <i
                                                        class="fas fa-trash"></i></button>
                                            </form>
                                        </a>
                                    @endif

                                </div>
                            </td>
                        </tr>
                    @endforeach --}}
                </tbody>
            </table>
        </div>
    </div>

{{-- Edit Modal --}}
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit & Update Student Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">

                <ul id="update_msgList"></ul>

                <input type="hidden" id="stud_id" />

                <div class="form-group mb-3">
                    <label for="">Full Name</label>
                    <input type="text" name="name" class="form-control"
                    value="{{ old('name') ?? optional($students)->name }}">
                </div>
                <div class="form-group mb-3">
                    <label for="">CNIC</label>
                    <input type="text" name="cnic" class="form-control"
                        value="{{ old('cnic') ?? optional($students)->cnic }}">
                </div>
                <div class="form-group mb-3">
                    <label for="">Date of Birth</label>
                    <input type="text" name="dob" class="form-control"
                        value="{{ old('dob') ?? optional($students)->dob }}">
                </div>
                <div class="form-group mb-3">
                    <label for="">Age</label>
                    <input type="text" name="age" class="form-control"
                    value="{{ old('age') ?? optional($students)->age }}">
                </div>


                <div class="form-group mb-3">
                    <label for="">Gender</label>
                    <select class="form-select" name="gender" id="gender">
                        <option value="">--Select Gender--</option>
                        <option value="Male"
                            {{ old('gender') ?? optional($students)->gender == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female"
                            {{ old('gender') ?? optional($students)->gender == 'Female' ? 'selected' : '' }}>Female
                        </option>
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label for="">Course</label>
                    <select class="form-select selectpicker" multiple data-live-search="true" name="course[]"
                    id="select_course" value="">
                    <option value="">--Select Course--</option>

                    @foreach ($courses as $course)
                        <option value="{{ $course->id }}" {{ $enroll_courses ? 'selected' : '' }}>
                            {{ $course->course_title }}</option>
                    @endforeach
                </select>

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary update_student">Update</button>
            </div>

        </div>
    </div>
</div>
{{-- Edn- Edit Modal --}}
    @push('js')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>

        <script>
            $('#js_birthday').flatpickr({
                altInput: true,
                altFormat: "d-m-Y",
                altInputClass: "form-control bg-white",
                disableMobile: true,
            });
            $("#js_cnic").inputmask();
            // store student


            $(document).ready(function() {
                fetchstudent();

        function fetchstudent() {
            $.ajax({
                type: "GET",
                url: "{{ route('student.index') }}",
                dataType: "json",
                success: function (response) {
                    $('tbody').html("");
                    $.each(response.students, function (key, student) {
                        $('tbody').append('<tr>\
                            <td>' + student.id + '</td>\
                            <td>' + student.name + '</td>\
                            <td>' + student.cnic + '</td>\
                            <td><button type="button" value="' + student.id + '" class="btn btn-primary editbtn btn-sm" data-toggle="modal" data-target="#editModal">Edit</button></td>\
                            <td><button type="button" value="' + student.id + '" class="btn btn-danger deletebtn btn-sm">Delete</button></td>\
                        \</tr>');
                    });
                }
            });
        }
                $("#student_form").on('submit', function(e) {

                    e.preventDefault();
                    var data = {
                        name: $("input[name=name]").val(),
                        cnic: $("input[name=cnic]").val(),
                        age: $("input[name=age]").val(),
                        dob: $("input[name=dob]").val(),
                        gender: $("#gender").val(),
                        course: $("#select_course").val(),
                    };

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('student.store') }}",
                        data: data,
                        success: function(response) {
                            if (response.status == 400) {

                                $.each(response.errors, function(key, err_value) {
                                    $('#save_msgList').append('<li>' + err_value + '</li>');
                                });
                            } else {
                                $('#save_msgList').html("");

                                alert('Student added');
                                fetchstudent();
                            }

                        }
                    });

                });
            });
        </script>
    @endpush
@endsection
