@extends('layouts.app')
@section('content')
@include('course/coursejs')
<div class="container">
  <a href="{{ url('/course') }}">Back</a>
     <div class="d-flex justify-content-center ">
          <div class="col-md-5 pt-5 mt-3">
               <form id="courseUpdate">
                    <div class="form-group">
                      <label for="code">Course Code</label>
                      <input type="hidden" class="form-control" name='id' value="{{ $post->id }}">
                      <input type="text" class="form-control" name='code' value="{{ $post->code }}" placeholder="Course Code" id="code">
                    </div>
                    <div class="form-group">
                      <label for="name">Course Name</label>
                      <input type="text" class="form-control" name='name' value="{{ $post->name }}" placeholder="Name" id="name">
                    </div>
                    <button   class="btn btn-primary">Update Course</button>
                  </form>
          </div>
     </div>
</div>
@endsection