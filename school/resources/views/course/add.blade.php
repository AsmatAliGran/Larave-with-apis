@extends('layouts.app')
@section('content')
@include('course/coursejs')
<div class="container">
  <a href="{{ url('/course') }}">Back</a>
     <div class="d-flex justify-content-center ">
          <div class="col-md-5 pt-5 mt-3">
               <form id="courseform">
                    <div class="form-group">
                      <label for="code">Course Code</label>
                      <input type="text" class="form-control" name='code' placeholder="Course Code" id="code">
                    </div>
                    <div class="form-group">
                      <label for="name">Course Name</label>
                      <input type="text" class="form-control" name='name' placeholder="Name" id="name">
                    </div>
                    <button  class="btn btn-primary">Add Course</button>
                  </form>
          </div>
     </div>
</div>
@endsection