@extends('layouts.app')

@section('content')
    <div class="container">
<div class="card p-5 text-center">
     <h1>Dashboard</h1>
</div>
        <div class="row">
            <div class="col-md-6">
                <div class="card p-5">
                    <a href="{{ url('/student') }}" class="btn btn-danger"> Add Student</a>
                    <table class="table my-5">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Class</th>
                                <th scope="col">Adress</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($record as $item)
                                <tr>
                                    <th scope="row">{{ $item->id ?? '' }}</th>
                                    <td>{{ $item->name ?? '' }}</td>
                                    <td>{{ $item->class ?? '' }}</td>
                                    <td>{{ $item->address ?? '' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
            <div class="col-md-6">
                <div class="card p-5">
                    <a href="{{ url('/course') }}" class="btn btn-warning"> Add Course</a>

                    <table class="table my-5">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Code Course</th>
                                <th scope="col">Name Course</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($CourseModel as $item)
                                <tr>
                                    <th scope="row">{{ $item->id ?? '' }}</th>
                                    <td>{{ $item->code ?? '' }}</td>
                                    <td>{{ $item->name ?? '' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection
