@extends('layouts.app')
@section('content')
@include('course/coursejs')

<div class="container  p-2 rounded mx-md-3 mt-0">
  <a href="{{ url('/home') }}">Back</a>

    <div class="row justify-content-between mx-2">
        <div class="col-md-2 p-2">
             <a class="btn btn-primary" href="{{ route('add_course') }}">Add Course</a>
        </div>
        <div class="col-md-4 p-2">
            <input type="text" class="form-control rounded-pill bg-light" id="search_new" placeholder="{{trans('search')}}">
        </div>
    </div>
    <div class='table-responsive mx-md-3'>
        <table class='table table-sm w-100 table-border data-table'>
            <thead>
                <tr class='tex-g'>
                    <th>{{ trans('Name') }}</th>
                    <th>{{ trans('code') }}</th>
                    <th>{{ trans('actions') }}</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</div>
 <script type="text/javascript">
     var table = "";
     $(function() {
         table = $('.data-table').DataTable({
             processing: true,
             serverSide: true,
             "searching": false,
             ajax: {
                 url: "{{ route('course') }}",
                 type: 'GET',
                 data: function(d) {
                   d.search_new = $('#search_new').val();
                   d.status_filter = $('#status_filter').val();
                   d.type_filter = $('#type_filter').val();
                   // console.log(d);
                 }
             },
             columns: [
                 {data: 'name', name: 'name'},
                 {data: 'code', name: 'code'},
                 {data: 'actions', name: 'actions', class:'no-print text-end',orderable: false, searchable: false},
             ],
             "lengthMenu": [[100, 200, 500, 700, -1], [100, 200, 500, 700, "All"]]
         });
     });
     $('body').on('change', '#status_filter', function(e) {
       table.draw(true);
     });
  
     $('body').on('keyup', '#search_new', function(e) {
       table.draw(true);
     });
     $('body').on('click', '.clear', function(e) {
         $('#search_new').val("");
         $('#status_filter').val("");
         table.draw(true);
     });
 </script>
@endsection