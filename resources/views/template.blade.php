@extends('layouts.app')
@section('content')
    <a href="/canva" class="btn btn-success btn-sm m-4"> Add Template </a>
    <div class="row" id="template-wrapper">
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
            load_templates();


            $(document).on('click', '.delete-btn', function() {
                var templateId = $(this).data('id');
                delete_template(templateId)
            })
        });

        function load_templates() {
            $.ajax({
                type: 'GET',
                url: '{{ route('templates') }}',
                success: function(data) {
                    console.log(data)
                    if (data.templates.length == 0) {
                        notify("warning", "Empty Templates!");
                        return;
                    }
                    $('#template-wrapper').empty();
                    $.each(data.templates, function(index, each) {
                        var item = `<div class="col-md-3 col-sm-12 col-12">
                            <div class="card-body d-flex flex-column position-relative">
                                <center>
                                    <div>
                                        <img src="${each.image}" alt="template pic" class="img-fluid card shadow"
                                            style="max-height: 250px;">
                                        <h2 class="text-md">${each.name}</h2>
                                    </div>
                                </center>
                                <div class="position-absolute top-0 end-0 p-2">
                                    <div class="d-flex ">
                                        <div>
                                            <a type="button" href="javascript:void(0)" class="btn btn-danger btn-sm delete-btn" 
                                                data-id="${each.name}" >
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </div>
                                        <div class="ml-1">
                                            <a type="button" href="/edit-template?id=${each.id}" class="btn btn-primary btn-sm edit-btn" 
                                                data-id="${each.id}" >
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>`;
                        $('#template-wrapper').append(item);
                    });

                }
            });
        }


        function delete_template(id) {
            Swal.fire({
                icon: 'info',
                title: 'You want to delete this template?',
                text: `You can't undo this process.`,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'GET',
                        data: {
                            id: id,
                        },
                        url: '{{ route('delete.template') }}',
                        success: function(data) {
                            notify(data[0].statusCode, data[0].message);
                            load_templates();
                        }
                    });
                }
            })
        }

        function notify(code, message) {
            Toast.fire({
                icon: code,
                title: message,
            });

        }
    </script>
@endsection
