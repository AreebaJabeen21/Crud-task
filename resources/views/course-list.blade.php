@extends('includes.master')
@section('title', 'List of all Courses')

@section('page-content')
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <div class="card-title">Courses</div>
    </div>

    <div class="card-body table-responsive">
        <table id="sm-datatable" class="table mt-3">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Code</th>
                    <th scope="col">Title</th>
                    <th scope="col">Credit Hours</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($courses as $course)
                    <tr>
                        <th scope="col"> {{ $loop -> iteration }} </th>
                        <td scope="col">{{ $course -> course_code }}</td>
                        <td scope="col">{{ $course -> course_title }} </td>
                        <td scope="col">{{ $course -> credit_hours }} </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
