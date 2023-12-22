@extends('layouts.app')
@section('content')
    <div class="card m-2">
        <form id="uploadForm" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="image">Image File </label>
                    <input type="file" name="image" class="form-control" id="image">
                    <br>
                    <button type="button" class="btn btn-success upload">Upload Image</button>
                </div>
            </div>
        </form>
    </div>

    <div class="container-fluid">
        <div class="row" id="img-wrapper">

        </div>
    </div>
@endsection
@section('footerjavascript')
    <script>
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 2000
        });

        $(document).ready(function() {
            load_images();

            $(document).on('click', '.upload', function(event) {
                upload();
            });
        });

        function load_images() {
            $.ajax({
                type: 'GET',
                url: '{{ route('file.load') }}',
                success: function(data) {
                    console.log(data);
                    var result = data[0].data;
                    $('#img-wrapper').empty();
                    $.each(result, function(index, item) {
                        console.log(item);

                        var elem = `<div class="col-md-3 p-2">
                                    <center>
                                        <img class="card shadow" style="width: auto; height: 200px; border-radius: 10px;"
                                        src="{{ asset('dist/img/templates/') }}/${item}" alt="Uploaded Image">
                                    </center>
                                </div>`;

                        $('#img-wrapper').append(elem);
                    });
                },
                error: function(xhr, status, error) {
                    console.error(xhr);
                    // Handle error if needed
                }
            });
        }


        function upload() {
            // Get the file input element
            var fileInput = $('#image')[0];
            console.log(fileInput)

            // Check if the file input has a file selected
            if (!fileInput.files.length) {
                notify("warning", "Please select a file for upload")

                return;
            }
            var formData = new FormData($('#uploadForm')[0]);
            console.log(formData)
            $.ajax({
                type: 'POST', // Make sure this is set to POST
                data: formData,
                processData: false,
                contentType: false,
                url: '{{ route('file.upload') }}',
                success: function(data) {
                    console.log(data);
                    load_images();
                    notify(data[0].statusCode, data[0].message)

                }
            });
        }

        function notify(code, message) {
            Toast.fire({
                icon: code,
                title: message,
            });
        }
    </script>
@endsection
