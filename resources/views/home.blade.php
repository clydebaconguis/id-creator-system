@extends('layouts.app')
@section('content')
    <div class="row" id="template-wrapper">
    </div>
@endsection
@section('footerjavascript')
    <script>
        $(document).ready(function() {
            load_orgs()

            // $(document).on('click', '.onclick', function() {
            //     var id = $(this).attr('data-id');

            // })
        });

        function load_orgs() {
            $.ajax({
                type: 'GET',
                url: '{{ route('orgs') }}',
                success: function(data) {
                    console.log(data)
                    $('#template-wrapper').empty();
                    $.each(data, function(index, each) {
                        var item = `<div class="col-md-3 col-sm-12 col-12">
                                        <div class="card-body d-flex flex-column position-relative">
                                            <a href="/organization/mainpage?id=${each.id}" data-id="${each.id}" >
                                                <center>
                                                    <div>
                                                        <img src="{{ asset('dist/img/cgclogo.jpg') }}" alt="template pic" class="img-fluid card shadow"
                                                            style="max-height: 250px;">
                                                        <h2 class="text-md">${each.orgname}</h2>
                                                    </div>
                                                </center>
                                            </a>
                                        </div>
                                    </div>`;

                        $('#template-wrapper').append(item);
                    });
                }
            });
        }
    </script>
@endsection
