@extends('layouts.app')
@section('pagespecificscripts')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    {{-- <style>
        @media print {
            body {
                margin: 0;
                padding: 0;
            }
        }
    </style> --}}
@endsection
@section('content')
    <div class="modal fade" id="addStudModal" tabindex="-1" role="dialog" aria-labelledby="addSchoolModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addSchoolModalLabel">New Student Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span>×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card card-primary">
                        <form>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="idnumber" class="required">ID No.</label>
                                    <input type="text" class="form-control" id="idnumber" placeholder="Enter ID No."
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="firstname" class="required">Firstname</label>
                                    <input type="text" class="form-control" id="firstname" placeholder="Enter firstname"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="lastname" class="required">Lastname</label>
                                    <input type="text" class="form-control" id="lastname" placeholder="Enter lastname"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="level">Grade Level</label>
                                    <input type="text" class="form-control" id="level" placeholder="Enter Level"
                                        required>
                                </div>

                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="number" class="form-control" id="phone" placeholder="Enter Phone">
                                </div>
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" class="form-control" id="address" placeholder="Enter Address">
                                </div>
                                <div class="form-group">
                                    <label for="picurl">Pic Url</label>
                                    <input type="text" class="form-control" id="picurl" placeholder="Enter Pic Url">
                                </div>
                                <div class="form-group">
                                    <label for="select-template">Select Template</label>
                                    <select class="form-control select2" id="select-template" style="width: 100%;">
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Birthdate:</label>
                                    <div>
                                        <input type="date" class="form-control " id="birthdate"
                                            value="{{ date('Y-m-d') }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-success add_student">Save</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="editStudModal" tabindex="-1" role="dialog" aria-labelledby="editStudModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editStudModalLabel">Edit Student Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span>×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card card-primary">
                        <form>
                            <div class="card-body">
                                {{-- <div class="form-group">
                                    <label for="idnumber2">ID No.</label>
                                    <input type="text" class="form-control" id="idnumber2"
                                        placeholder="Enter ID No.">
                                </div> --}}
                                <div class="form-group">
                                    <label for="firstname2">Firstname</label>
                                    <input type="text" class="form-control" id="firstname2"
                                        placeholder="Enter firstname">
                                </div>
                                <div class="form-group">
                                    <label for="lastname2">Lastname</label>
                                    <input type="text" class="form-control" id="lastname2"
                                        placeholder="Enter lastname">
                                </div>
                                {{-- <div class="form-group">
                                    <label for="level2">Grade Level</label>
                                    <input type="text" class="form-control" id="level2" placeholder="Enter Level">
                                </div> --}}

                                <div class="form-group">
                                    <label for="contact">Phone</label>
                                    <input type="number" class="form-control" id="contact" placeholder="Enter Phone">
                                </div>
                                {{-- <div class="form-group">
                                    <label for="address2">Address</label>
                                    <input type="text" class="form-control" id="address2"
                                        placeholder="Enter Address">
                                </div> --}}
                                {{-- <div class="form-group">
                                    <label for="picurl2">Pic Url</label>
                                    <input type="text" class="form-control" id="picurl2"
                                        placeholder="Enter Pic Url">
                                </div> --}}
                                <div class="form-group">
                                    <label for="select-template2">Select Template</label>
                                    <select class="form-control select2" id="select-template2" style="width: 100%;">
                                    </select>
                                </div>
                                {{-- <div class="form-group">
                                    <label>Birthdate:</label>
                                    <div>
                                        <input type="date" class="form-control " id="birthdate2"
                                            value="{{ date('Y-m-d') }}" />
                                    </div>
                                </div> --}}
                            </div>
                            <div class="card-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-success update_student">Save</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="row" style="width: 100%;">

        <div class="col-12 pt-3" id="col1" style="width: 100%;">
            <div class="container-fluid">
                <h2 class="p-2" id="orgname"> {{ $data[0]->orgname }} </h2>
                <div style="padding: 10px; height: 80vh">
                    <div class="d-flex align-items-center ">

                        <button type="button" class="btn btn-success btn-sm newstud">
                            <i class="fas fa-plus"></i> New Registration
                        </button>
                        <button type="button" class="btn btn-sm newstud ml-2"
                            style="background-color: blueviolet; color: white;">
                            <i class="fas fa-users"></i> Batch Registration
                        </button>
                        <button type="button" class="btn btn-sm newstud ml-auto"
                            style="background-color: magenta; color: white;">
                            <i class="fas fa-print"></i> Batch Print
                        </button>
                    </div>
                    <div class="row mt-3" style="width: 100%;">
                        <div class="col-md-12" style="width: 100%;">
                            <div class="card shadow" style="">
                                <div class="card-body  p-3">
                                    <div class="row mt-2">
                                        <div class="col-md-12" style="font-size:.9rem !important">

                                            <table class="table-hover table table-striped table-sm table-bordered"
                                                id="students_datatable" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th width="10%">SID</th>
                                                        <th width="10%">Firstname</th>
                                                        <th width="10%">Lastname</th>
                                                        <th width="10%">Middlename</th>
                                                        <th width="10%">Level</th>
                                                        <th width="10%">Phone</th>
                                                        <th width="10%">Template</th>
                                                        <th width="10%" class="align-middle">Print</th>
                                                        <th width="10%" class="align-middle"></th>
                                                        <th width="10%" class="align-middle"></th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 pt-3" id="col2" style="width: 100%;">
            <div class="container-fluid">
                <h2 class="p-2 text-center">Preview</h2>
                <h4 id="current-person"> Person Name </h4>
                <h5 id="current-status"> Status: Pending </h5>

                <form id="customPaperForm" style="width: 100%;">

                    <div class="form-group">
                        <label for="paperWidth">Paper Width:</label>
                        <input type="number" id="paperWidth" name="paperWidth" required placeholder="Enter width">
                    </div>

                    <div class="form-group">
                        <label for="paperHeight">Paper Height:</label>
                        <input type="number" id="paperHeight" name="paperHeight" required placeholder="Enter height">
                    </div>

                    <div class="form-group">
                        <label for="unit">Unit:</label>
                        <select id="unit" name="unit">
                            <option value="inches">Inches</option>
                            <option value="cm">Centimeters</option>
                        </select>
                    </div>

                    <button type="button" class="btn btn-primary" onclick="openPrintWindow()">Proceed</button>
                    <button type="button" class="btn btn-primary download">Download</button>
                </form>



                <div id="preview" class="row mt-2">
                </div>
            </div>
        </div>
    </div>

    <div class="canva-wrapper" style="height: 900px; width: 100%; overflow-x: scroll; overflow-y:scroll;">
        <canvas id="canvas" width="1200" height="1200" style="width: 100%; "></canvas>
    </div>
@endsection

@section('footerjavascript')
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/4.5.0/fabric.min.js"></script>
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>

    <script>
        $('#col2').hide();
        $('.canva-wrapper').hide()
        var canvas2 = new fabric.Canvas('canvas');
        var svgStringFront;
        var svgStringBack;
        var unit;
        var paperwidth;
        var paperheight;
        var personname;
        var currentid;

        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 2000
        });

        var template;

        $(document).ready(function() {
            students();
            templates();

            $('#select-template').on('change', function(event) {
                var value = $(this).val();
                console.log(value);
            })
            $('#select-template2').on('change', function(event) {
                template = $(this).val();
                console.log(template);
            })

            $(document).on('click', '.newstud', function(event) {
                $('#addStudModal').modal();
            });

            $(document).on('click', '.download', function(event) {
                // $('.canva-wrapper').show()
                downloadSvgAsPngWithFabric(svgStringFront, $('#current-person').text(), 'frontid.png');
                downloadSvgAsPngWithFabric(svgStringBack, $('#current-person').text(), 'backid.png');
            });

            $(document).on('click', '.edit_stud', function(event) {
                currentid = $(this).attr('data-id');
                edit_student($(this).attr('data-id'))

            });

            $(document).on('click', '.update_student', function(event) {
                update_student(currentid)

            });

            $(document).on('click', '.add_student', function(event) {
                add_student();
            });

            $(document).on('click', '.delete_stud', function(event) {
                var id = $(this).attr('data-id');
                delete_student(id);
            });

            $(document).on('click', '.btn_print', function(event) {
                var id = $(this).attr('data-id');

                print(id);
            });

            $('#unit').on('change', function() {
                unit = $(this).val();
                console.log(unit);
                paperwidth = parseFloat($('#paperWidth').val())
                paperheight = parseFloat($('#paperHeight').val())
                // Convert units to inches (1 inch = 2.54 cm)
                if (unit === 'cm' && !paperwidth && !paperheight) {
                    paperwidth /= 2.54;
                    paperheight /= 2.54;
                }
            })
        });

        function update_student() {
            $.ajax({
                type: 'GET',
                data: {
                    id: currentid,
                    template: template,
                },
                url: '{{ route('update.student') }}',
                success: function(data) {
                    notify(data[0].statusCode, data[0].message);
                }
            });
        }

        function delete_student(id) {
            Swal.fire({
                icon: 'info',
                title: 'You want to delete this student?' + id,
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
                        url: '{{ route('delete.student') }}',
                        success: function(data) {
                            notify(data[0].statusCode, data[0].message);
                            students();
                        }
                    });
                }
            })
        }

        function add_student() {
            var idnumber = $('#idnumber').val();
            var firstname = $('#firstname').val();
            var lastname = $('#lastname').val();
            var level = $('#level').val();
            var birthdate = $('#birthdate').val();
            var phone = $('#phone').val();
            var address = $('#address').val();
            var picurl = $('#picurl').val();
            var template = $('#select-template').val();

            if (!firstname || !lastname || !level || !birthdate || !phone || !address || !template) {
                notify('error', 'Fill all fields!');
                return;
            }

            $.ajax({
                type: 'GET',
                data: {
                    idnumber: idnumber,
                    firstname: firstname,
                    lastname: lastname,
                    level: level,
                    birthdate: birthdate,
                    phone: phone,
                    address: address,
                    picurl: picurl,
                    template: template,
                },
                url: '{{ route('add.student') }}',
                success: function(data) {
                    notify(data[0].statusCode, data[0].message);
                    students();
                }
            })
        }

        function students() {
            $.ajax({
                type: 'GET',
                url: '{{ route('students') }}',
                success: function(data) {
                    console.log(data);
                    load_students_datatable(data);

                }
            })
        }

        function edit_student(id) {
            $.ajax({
                type: 'GET',
                data: {
                    id: id
                },
                url: '{{ route('get.student') }}',
                success: function(data) {
                    $('#contact').val(data.stud.contactno);
                    $('#firstname2').val(data.stud.firstname)
                    $('#lastname2').val(data.stud.lastname)
                    // template.val(student.template)
                    $('#editStudModal').modal()
                }
            })
        }

        function load_students_datatable(data) {
            data.forEach(element => {
                if (!element.template) {
                    element.template = 'Not Assigned';
                }
            });

            $("#students_datatable").DataTable({
                autowidth: false,
                destroy: true,
                data: data,
                lengthChange: false,
                columns: [{
                        "data": "sid"
                    },
                    {
                        "data": "firstname"
                    },
                    {
                        "data": "lastname"
                    },
                    {
                        "data": "middlename"
                    },
                    {
                        "data": "levelid"
                    },
                    {
                        "data": "contactno"
                    },
                    {
                        "data": 'template'
                    },
                    {
                        "data": null
                    },
                    {
                        "data": null
                    },
                    {
                        "data": null
                    },
                ],
                columnDefs: [{
                        'targets': 1,
                        'orderable': false,
                        'createdCell': function(td, cellData, rowData, row, col) {
                            var disabled = '';
                            var buttons =
                                '<a>' + rowData.firstname.toUpperCase() + '</a>';
                            $(td)[0].innerHTML = buttons
                        }
                    },
                    {
                        'targets': 2,
                        'orderable': false,
                        'createdCell': function(td, cellData, rowData, row, col) {
                            var disabled = '';
                            var buttons =
                                '<a>' + rowData.lastname.toUpperCase() + '</a>';
                            $(td)[0].innerHTML = buttons
                        }
                    },
                    // {
                    //     'targets': 3,
                    //     'orderable': false,
                    //     'createdCell': function(td, cellData, rowData, row, col) {
                    //         var disabled = '';
                    //         var buttons =
                    //             '<a>' + rowData.middlename.toUpperCase() + '</a>';
                    //         $(td)[0].innerHTML = buttons
                    //     }
                    // },

                    {
                        'targets': 7,
                        'orderable': false,
                        'createdCell': function(td, cellData, rowData, row, col) {
                            var buttons =
                                // `<a href="/generate-pdf?id=${rowData.id}" target="_blank" data-id="${rowData.id}"><i class="fas fa-print " style="color: magenta;"></i></a>`;
                                `<a class="btn_print" target="_blank" data-id="${rowData.id}"><i class="fas fa-print " style="color: magenta;"></i></a>`;
                            $(td)[0].innerHTML = buttons
                            $(td).addClass('text-center')
                            $(td).addClass('align-middle')
                        }
                    },

                    {
                        'targets': 8,
                        'orderable': false,
                        'createdCell': function(td, cellData, rowData, row, col) {
                            var buttons =
                                '<a type="button" href="javascript:void(0)" class="edit_stud" data-id="' +
                                rowData.id +
                                '"><i class="far fa-edit text-primary"></i></a>';
                            $(td)[0].innerHTML = buttons
                            $(td).addClass('text-center')
                            $(td).addClass('align-middle')
                        }
                    },
                    {
                        'targets': 9,
                        'orderable': false,
                        'createdCell': function(td, cellData, rowData, row, col) {
                            var buttons =
                                '<a type="button" href="javascript:void(0)" class="delete_stud" data-id="' +
                                rowData.id +
                                '"><i class="far fa-trash-alt text-danger"></i></a>';
                            $(td)[0].innerHTML = buttons
                            $(td).addClass('text-center')
                            $(td).addClass('align-middle')
                        }
                    },
                ]

            });
        }

        function templates() {
            $.ajax({
                type: 'GET',
                url: '{{ route('templates') }}',
                success: function(data) {
                    var results = data.templates;
                    if (results.length) {
                        // Clear existing options
                        $('#select-template').empty();
                        $('#select-template2').empty();

                        // Add a default option
                        $('#select-template').append('<option value="">Select Template</option>');
                        $('#select-template2').append('<option value="">Select Template</option>');

                        $.each(results, function(index, value) {
                            value.text = value.name;
                        });
                        // Initialize Select2 after updating options
                        $('#select-template').select2({
                            data: results,
                            allowClear: true,
                            placeholder: "Select Template",
                            theme: 'bootstrap4'
                        });
                        $('#select-template2').select2({
                            data: results,
                            allowClear: true,
                            placeholder: "Select Template",
                            theme: 'bootstrap4'
                        });
                    }
                }
            });
        }

        // async function openPrintWindow() {
        //     console.log(svgStringFront);

        //     // var frontimg = await loadImageData(canvas, svgStringFront)
        //     // console.log(frontimg);

        //     var paperwidth = parseFloat($('#paperWidth').val());
        //     var paperheight = parseFloat($('#paperHeight').val());
        //     var unit = $('#unit').val();

        //     if (!paperwidth || !paperheight) {
        //         notify("warning", "Empty width and height!");
        //         return;
        //     }

        //     // Convert units to inches (1 inch = 2.54 cm)
        //     if (unit === 'cm') {
        //         paperwidth /= 2.54;
        //         paperheight /= 2.54;
        //     }

        //     var printWindow = window.open('', '_blank');
        //     printWindow.document.write('<html><head><title>Print</title>');
        //     printWindow.document.write('<style>@media print { @page { size: ' + paperwidth + 'in ' + paperheight +
        //         'in; margin: 0; } }</style>');
        //     printWindow.document.write('</head>');
        //     printWindow.document.write('<body style="margin: 0; padding: 0; height: 100%; width: 100%;">');

        //     printWindow.document.write(svgStringFront);

        //     // printWindow.document.write('<img src="' + frontimg + '" style="width: 100%; height: 100%;" />');

        //     printWindow.document.write('</body></html>');
        //     printWindow.document.close();

        //     printWindow.onload = function() {
        //         printWindow.print();
        //     };
        // }


        // function loadImageData(canvas, svgString) {
        //     return new Promise((resolve) => {
        //         fabric.loadSVGFromString(svgString, function(objects, options) {
        //             var loadedObjects = fabric.util.groupSVGElements(objects, options);
        //             canvas.add(loadedObjects).renderAll();
        //             console.log(loadedObjects)

        //             var imageDataUrl = canvas.toDataURL({
        //                 format: 'png',
        //                 multiplier: 1
        //             });

        //             var img = new Image();
        //             img.src = imageDataUrl;

        //             img.onload = function() {
        //                 var tempCanvas = document.createElement('canvas');
        //                 var tempContext = tempCanvas.getContext('2d');
        //                 tempCanvas.width = img.width;
        //                 tempCanvas.height = img.height;
        //                 tempContext.drawImage(img, 0, 0);
        //                 var imageData = tempContext.getImageData(0, 0, tempCanvas.width, tempCanvas
        //                     .height);
        //                 var boundingBox = getNonWhiteBoundingBox(imageData);
        //                 var croppedCanvas = document.createElement('canvas');
        //                 var croppedContext = croppedCanvas.getContext('2d');
        //                 croppedCanvas.width = boundingBox.width;
        //                 croppedCanvas.height = boundingBox.height;
        //                 croppedContext.drawImage(
        //                     tempCanvas,
        //                     boundingBox.x,
        //                     boundingBox.y,
        //                     boundingBox.width,
        //                     boundingBox.height,
        //                     0,
        //                     0,
        //                     boundingBox.width,
        //                     boundingBox.height
        //                 );
        //                 var croppedImageDataUrl = croppedCanvas.toDataURL('image/png');
        //                 resolve(croppedImageDataUrl);
        //                 canvas.clear();
        //             };
        //         });
        //     });

        // }

        function print(id) {
            $.ajax({
                type: 'GET',
                data: {
                    id: id,
                },
                url: '{{ route('get.student') }}',
                success: function(data) {
                    var fullname = `${data.stud.lastname} ${data.stud.firstname} ${data.stud.middlename} `
                    if (!data.stud.template) {
                        notify("error", "No Template Assigned!")
                        return;
                    }
                    $('#current-person').text(fullname);
                    $('#col2').show()
                    $('#col1').addClass('col-md-8')
                    $('#col2').addClass('col-md-4')

                    // var front = data.templates.find(temp => temp.type === "front");
                    // var back = data.templates.find(temp => temp.type === "back");
                    // // console.log(front)
                    // // console.log(back)

                    // var parser = new DOMParser();
                    // var svgDocFront = parser.parseFromString(front.template, 'image/svg+xml');
                    // var svgDocBack = parser.parseFromString(back.template, 'image/svg+xml');

                    // console.log(svgDocFront)

                    // // // Update properties based on the JSON data
                    // $.each(data.studinfo, function(key, value) {
                    //     var gElement = svgDocFront.querySelector(`g[id=${key}]`);
                    //     var gElement2 = svgDocBack.querySelector(`g[id=${key}]`);

                    //     if (gElement) {
                    //         console.log(gElement);
                    //         if (key == "picurl") {
                    //             var imageElement = gElement.querySelector('image');
                    //             if (imageElement) {
                    //                 // Change the xlink:href attribute
                    //                 var newImageUrl =
                    //                     `${window.location.protocol}//${window.location.hostname}/${value}`;
                    //                 imageElement.setAttributeNS('http://www.w3.org/1999/xlink',
                    //                     'xlink:href',
                    //                     newImageUrl);
                    //             }
                    //         } else {
                    //             var textElement = gElement.querySelector('text');

                    //             // Find the < tspan > element within the < text > element
                    //             var tspanElement = textElement.querySelector('tspan');

                    //             if (tspanElement) {
                    //                 // Set the new text content
                    //                 tspanElement.textContent = value;
                    //             }
                    //         }
                    //     }

                    //     if (gElement2) {
                    //         // console.log(gElement2);
                    //         if (key == "picurl") {
                    //             var imageElement = gElement.querySelector('image');
                    //             if (imageElement) {
                    //                 // Change the xlink:href attribute
                    //                 var newImageUrl =
                    //                     `${window.location.protocol}//${window.location.hostname}/${value}`;
                    //                 imageElement.setAttributeNS('http://www.w3.org/1999/xlink',
                    //                     'xlink:href',
                    //                     newImageUrl);
                    //             }
                    //         } else {
                    //             var textElement = gElement2.querySelector('text');

                    //             // Find the < tspan > element within the < text > element
                    //             var tspanElement = textElement.querySelector('tspan');

                    //             if (tspanElement) {
                    //                 // Set the new text content
                    //                 tspanElement.textContent = value;
                    //             }
                    //         }
                    //     }
                    // });

                    // // // Set the width and height attributes to 100%
                    // // svgDocFront.documentElement.setAttribute('width', '100%');
                    // // svgDocFront.documentElement.setAttribute('height', '100%');

                    // // Convert the modified SVG document back to an SVG string
                    // svgStringFront = new XMLSerializer().serializeToString(svgDocFront);
                    // svgStringBack = new XMLSerializer().serializeToString(svgDocBack);


                    // // The updated SVG is now in svgDoc
                    // console.log(svgStringFront);
                    // // console.log(svgBackPrev.documentElement.outerHTML);

                    // $('#preview').empty();
                    // $('#preview').append(svgStringFront);
                    // $('#preview').append(svgStringBack);
                }
            });
        }

        function getObjectById(canv, id) {
            var objects = canv.getObjects();
            console.log(objects)
            for (var i = 0; i < objects[0]._objects.length; i++) {
                console.log(objects[i]._objects)

                if (objects[0]._objects[i].id == id) {
                    return objects[0]._objects[i];
                }
            }
            return null;
        }


        function downloadSvgAsPngWithFabric(svgString, studname, fileName) {
            var rectsList = [];
            var textList = [];

            fabric.loadSVGFromString(svgString, function(objects, options) {
                var loadedObjects = fabric.util.groupSVGElements(objects, options);
                // Clear the existing canvas2
                canvas2.clear();

                // Add the loaded objects to the canvas2
                canvas2.add(loadedObjects).renderAll();

                loadedObjects.forEachObject(function(obj) {
                    console.log(obj)
                    if (obj.type === 'rect') {
                        rectsList.push(obj)
                    }

                    if (obj.type === 'text') {
                        textList.push(obj)
                    }
                });

                textList.forEach(text => {
                    var myrect = rectsList.find(obj => obj.id == text.id)
                    if (myrect && text.textAlign == "left") {
                        text.set({
                            left: myrect.left,
                            top: myrect.top,
                        });

                        canvas2.renderAll();
                    }
                    console.log(text)
                });

                canvas2.renderAll();

                // Calculate the bounding box covering non-transparent pixels
                var coverImage = getObjectById(canvas2, 'cover');
                console.log(coverImage);

                // Get the boundaries of the cover image
                var boundingBox = coverImage.getBoundingRect();

                // Adjust canvas2 size to match the loaded SVG dimensions
                canvas2.setDimensions({
                    width: loadedObjects.width, // Set dynamically based on SVG content
                    height: loadedObjects.height, // Set dynamically based on SVG content
                    redraw: true,
                });

                // Crop the canvas to the bounding box before conversion
                canvas2.setDimensions({
                    width: boundingBox.width,
                    height: boundingBox.height,
                    left: boundingBox.left,
                    top: boundingBox.top,
                    redraw: true,
                });

                // Convert fabric canvas2 to a data URL
                var dataUrl = canvas2.toDataURL({
                    format: 'png',
                    multiplier: 1,
                });

                // Create a temporary anchor element
                var anchor = document.createElement('a');

                // Set the data URL as the anchor's href
                anchor.href = dataUrl;

                // Set the download attribute with the specified file name
                anchor.download = `${studname}/${fileName || 'image.png'}`;

                // Append the anchor to the document and trigger a click event
                document.body.appendChild(anchor);
                anchor.click();

                // Remove the anchor from the document
                document.body.removeChild(anchor);

                // Clear the fabric canvas2
                canvas2.clear();
            });

        }




        // // Function to find the bounding box of non-white pixels
        // function getNonWhiteBoundingBox(imageData) {
        //     var minX = imageData.width;
        //     var minY = imageData.height;
        //     var maxX = -1;
        //     var maxY = -1;

        //     for (var y = 0; y < imageData.height; y++) {
        //         for (var x = 0; x < imageData.width; x++) {
        //             var index = (y * imageData.width + x) * 4;
        //             var alpha = imageData.data[index + 3];

        //             if (alpha > 0) {
        //                 minX = Math.min(minX, x);
        //                 minY = Math.min(minY, y);
        //                 maxX = Math.max(maxX, x);
        //                 maxY = Math.max(maxY, y);
        //             }
        //         }
        //     }

        //     return {
        //         x: minX,
        //         y: minY,
        //         width: maxX - minX + 1,
        //         height: maxY - minY + 1
        //     };
        // }

        function notify(code, message) {
            Toast.fire({
                icon: code,
                title: message,
            });

        }
    </script>
@endsection
