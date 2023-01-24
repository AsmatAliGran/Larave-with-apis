@extends('layouts.app')

@section('content')
<div class="container">
     <a href="{{ url('/course') }}" class="btn btn-info">Course</a>
     <a href="{{ url('/student') }}" class="btn btn-primary">Student</a>
</div>
@endsection
