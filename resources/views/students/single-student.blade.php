@extends('includes.master')
@section('title', 'Student Profile')
@section('page-content')
    <div class="card">
        <div class="card-header">
            <div class="card-text">{{ $student -> name}} profile</div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                <h6 class="fw-bold">Full Name</h6>
                <p>{{ $student -> name }}</p>
            </div>
            <div class="col-6">
                <h6 class="fw-bold">CNIC NUmber</h6>
                <p>{{ $student -> cnic }}</p>
            </div>
            <div class="col-6">
                <h6 class="fw-bold">Date of Birth</h6>
                <p>{{ $student -> dob }}</p>
            </div>
            <div class="col-6">
                <h6 class="fw-bold">Age</h6>
                <p>{{ $student -> age }}</p>
            </div>
            <div class="col-6">
                <h6 class="fw-bold">Gender</h6>
                <p>{{ $student -> gender }}</p>
            </div>
            <div class="col-6">
                <h6 class="fw-bold">Enroll Courses</h6>
                <p>{{ $student -> gender }}</p>
            </div>
            </div>

        </div>
    </div>
@endsection
