@extends('layouts.app')
@section('content')
@include('student/studentjs')
<div class="container">
  <a href="{{ url('/student') }}">Back</a>
     <div class="d-flex justify-content-center ">
          <div class="col-md-5 pt-5 mt-3">
               <form id="studentform">
                    <div class="form-group">
                      <label for="name">Name</label>
                      <input type="text" class="form-control" name='name' placeholder="Name" id="name">
                    </div>
                    <div class="form-group">
                      <label for="class">Class</label>
                      <input type="text" class="form-control" name='class' placeholder="class" id="class">
                    </div>
                    <div class="form-group">
                      <label for="address">Address</label>
                      <input type="text" class="form-control" name='address' placeholder="address" id="address">
                    </div>
                    <div class="form-group">
                      <label for="class">Gender</label>
                      <select class="form-control" name="gender">
                        <option value="1">Male</option>
                        <option value="2">Female</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="class">Subject</label>
                      <select class="form-control" name="subject">
                        @foreach ($courses as $course)
                        <option value="{{ $course->id }}">{{ $course->name }}</option>
                        @endforeach
                      </select>
                    </div>
                    <button  class="btn btn-primary">Add Course</button>
                  </form>
          </div>
     </div>
</div>
@endsection