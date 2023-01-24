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
                      <input type="text" class="form-control" name='name' value="{{ $post->name ?? "" }}" placeholder="Name" id="name">
                    </div>
                    <div class="form-group">
                      <label for="class">Class</label>
                      <input type="text" class="form-control" name='class' value="{{ $post->class ??'' }}" placeholder="class" id="class">
                    </div>
                    <div class="form-group">
                      <label for="address">Address</label>
                      <input type="text" class="form-control" name='address' value="{{ $post->address ??'' }}" placeholder="address" id="address">
                    </div>
                    <div class="form-group">
                      <label for="class">Gender</label>
                      <select class="form-control" name="gender">
                        <option value="1" {{ $post->gender == '1' ? 'selected' : '' }}>Male</option>
                        <option value="2" {{ $post->gender == '2' ? 'selected' : '' }}>Female</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="class">Subject</label>
                      <select class="form-control" name="subject">
                        @foreach ($courses as $course)
                        <option value="{{ $course->id }}"  @if($post->subject == $course->id) selected @endif >{{ $course->name }}</option>
                        @endforeach
                      </select>
                    </div>
                    <button  class="btn btn-primary">Update Course</button>
                  </form>
          </div>
     </div>
</div>
@endsection