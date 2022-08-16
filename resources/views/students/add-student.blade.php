@extends('includes.master')
<?php
$students = $students ??  null;
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
            <div class="card-text">{{ $students ? "Edit" : "Create" }} Student</div>
        </div>
        <div class="card-body">
            @if (session()->has('message'))
                <div class="alert alert-info">
                    {{ session('message') }}
                </div>
            @endif
            <form action="{{ $action_route }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if ($students)
                    @method('put')
                @endif
                <div class="mb-3">
                    <label class="form-label">Full Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') ?? optional($students)->name }}">
                    @error('name')
                        <p class="text-danger my-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">CNIC Number</label>
                    <input type="text" name="cnic" class="form-control" value="{{ old('cnic') ?? optional($students)->cnic }}">
                    @error('cnic')
                        <p class="text-danger my-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Date Of Birth</label>
                    <input type="text" id="js-birthday" name="dob" class="form-control"
                    value="{{ old('dob') ?? optional($students)->dob }}">
                    @error('dob')
                        <p class="text-danger my-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Age</label>
                    <input type="number" name="age" class="form-control" value="{{ old('age') ?? optional($students)->age }}" >
                    @error('age')
                        <p class="text-danger my-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Gender</label>
                    <select class="form-select" name="gender" value="{{ old('gender') ?? optional($students)->gender }}">
                        <option value="">--Select Gender--</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                    @error('gender')
                        <p class="text-danger my-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Course</label>
                    <select class="form-select selectpicker" multiple data-live-search="true" name="course[]"
                    id="select_course" value="{{ old('course') ?? optional($students)->course }}">
                        <option value="">--Select Course--</option>
                        @foreach ($courses as $course)
                            <option value="{{ $course -> id }}">{{ $course -> course_title }}</option>
                        @endforeach
                    </select>

                </div>
                <button type="submit" class="btn btn-primary">{{ $students ? "Update" : "Create" }}  Student</button>
            </form>
        </div>
    </div>
    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script>
            $('#js-birthday').flatpickr({
                altInput: true,
                altFormat: "d-m-Y",
                altInputClass: "form-control bg-white",
                disableMobile: true,
            });


        </script>
    @endpush
@endsection
