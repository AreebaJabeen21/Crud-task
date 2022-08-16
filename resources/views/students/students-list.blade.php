@extends('includes.master')
@section('title', 'List of all Students')
@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
@endpush
@section('page-content')
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <div class="card-title">Students</div>
        <a href="{{ route('student.create') }}"
        class="btn btn-sm btn-link btn-primary text-light">
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
                    <th scope="col">Enroll Courses</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($students as $student)
                    <tr>
                        <th scope="col"> {{ $loop -> iteration }} </th>
                        <td scope="col">
                            <a href="{{ route('student.show', [ $student -> id ]) }}">
                                {{ $student -> name }}
                            </a>
                        </td>
                        <td scope="col">{{ $student -> cnic }} </td>
                        <td scope="col">{{ $student -> cnic }} </td>
                        <td scope="col">
                            <div class="form-button-action d-flex justify-content-around">

                                @if($student -> trashed())
                                    <form action="{{ route('student.restore', [ $student -> id ]) }}" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <button
                                            class="btn btn-sm btn-link btn-success text-light"
                                            data-bs-toggle="tooltip" data-placement="top" title="Activate"
                                        >
                                            <i class="fas fa-check-circle"></i>
                                        </button>
                                    </form>
                                @else
                                <a
                                href="{{ route('student.edit', [ $student -> id ]) }}"
                                data-bs-toggle="tooltip" data-placement="top" title="Edit"
                            >
                                <button class="btn btn-sm btn-link btn-primary text-light">
                                    <i class="fas fa-edit"></i>
                                </button>
                            </a>

                                    <a data-bs-toggle="tooltip" data-placement="top" title="Deactivate">
                                        <form action="{{ route('student.destroy', [ $student -> id ]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <button class="btn btn-sm  btn-danger"> <i class="fas fa-trash"></i></button>
                                        </form>
                                    </a>
                                @endif

                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@push('js')
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function () {
    $('#sm-datatable').DataTable();
});
    </script>
@endpush
@endsection
