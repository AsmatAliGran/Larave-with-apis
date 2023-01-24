<script type="text/javascript">
    // add new menu to database
    $(document).ready(function() {
        //Saving course record
        $("#courseform").on('submit', (function(e) {
            var fd = new FormData(this);
            e.preventDefault();

            $.ajax({
                url: '{{ route('save_course') }}',
                data: fd,
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                contentType: false,
                processData: false,
                cache: false,
                dataType: 'json',
                success: function(data) {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: data.text,
                        showConfirmButton: false,
                        timer: 1500
                    })
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Not Found...',
                        text: data.text,
                    })
                }
            });

        }));



        //Updating Menu record
        $("#courseUpdate").on('submit', (function(e) {
            e.preventDefault();
            var fd = new FormData(this);
            $.ajax({
                url: '{{ route('update_course') }}',
                data: fd,
                type: "POST",
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                contentType: false,
                processData: false,
                cache: false,
                success: function(data) {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: data.text,
                        showConfirmButton: false,
                        timer: 1500
                    })
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Not Found...',
                        text: data.text,
                    })
                }
            });

        }));
    });

    function destroy(id) {

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                        url: '{{ url('/course/destroy') }}',
                        type: 'post',
                        dataType: 'json',
                        data: {
                            _token: '{!! csrf_token() !!}',
                            id: id
                        },
                    })
                    .done(function(res) {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Deleted Data',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        $("#" + id).hide(1000);
                    })
                    .fail(function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Not Found...',
                            text: data.text,
                        })
                    })
                    .always(function() {
                        loading("stop");
                    });
            }
        })

    }
</script>
