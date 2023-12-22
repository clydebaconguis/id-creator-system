@extends('layouts.app')
@section('pagespecificscripts')
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <style>
        #scrollable-container {
            width: 100%;
            overflow-x: scroll;
            white-space: nowrap;
            margin-top: 5px;
        }

        .scrollable-image {
            display: inline-block;
            margin-right: 10px;
            cursor: pointer;
            max-height: 200px;
            height: 200px;
            width: auto;
            border-radius: 10px;

        }

        .tab-content {
            display: none;
            /* Hide the content by default */
        }

        .active-tab {
            display: block;
            /* Show the content when active */
        }

        .active-btn {
            background-color: rgb(220, 217, 217);

        }

        .tab-button {
            border-radius: 10px;
            color: black;
            cursor: pointer;
        }
    </style>
@endsection
@section('modalSection')
    <div class="modal fade" id="addImageModal" tabindex="-1" role="dialog" aria-labelledby="addImageModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addImageModalLabel">Upload New Image</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span>×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card card-primary">
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
                </div>

            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="row" style="width: 100%;">
        <div class="col-md-8 col-12" style="width: 100%;">
            <div id="session-data" data-another-value="{{ $data[0]->template }}"></div>
            <div id="session-data2" data-another-value="{{ $data[1]->template }}"></div>

            <div class="d-flex justify-content-between align-items-center p-2">
                <div id="title-editor" contenteditable="true">
                    <h1 id="template-name"> {{ $data[0]->name }} </h1>
                </div>
                <div>
                    <button type="button" class="btn btn-info btn-merge">Merge</button>
                </div>
            </div>
            <div class="d-flex align-items-center">
                <div class="d-flex p-2 ml-auto">
                    <a id="front" data-tab="tab1" class="text-md px-2 tab-button active-btn">Front</a>
                    <a id="back" data-tab="tab2" class="text-md ml-2 px-2 tab-button">Back</a>
                </div>
            </div>
            <div id="tab1" class="tab-content active-tab ml-2"
                style="height: 900px; width: 100%; overflow-x: scroll; overflow-y:scroll; background-color: gainsboro;">
                <canvas id="canvas" height="1200" width="1200" style="width: 100%;"></canvas>
            </div>
            <div id="tab2" class="tab-content ml-2"
                style="height: 900px; width: 100%; overflow-x: scroll; overflow-y:scroll; background-color: bisque;">
                <canvas id="canvas2" height="1200" width="1200" style="width: 100%;"></canvas>
            </div>
        </div>
        <div class="col-md-4" style="width: 100%;">
            <div class="py-2">
                <h1 class="text-lg">Controls</h1>
            </div>
            <button class="btn btn-success btn-sm new_label"> <i class="fas fa-plus"></i> New label</button>

            <div class="row">
                <div class="col-md-4" style="width: 100%;">

                    <div class="text-container">

                    </div>
                    {{-- <label for="text-editor"> Name </label>
            <div id="text-editor" contenteditable="true">
                CLYDE BACONGUIS
            </div> --}}
                </div>
                <div id="text-controls" class="col-md-4" style="width: 100%;">
                    <div style="width: 100%;">
                        <label for="fontSize">Label ID:</label>
                        <input type="text" id="labelid">
                        <br>
                        <label for="fontFamily">Font Family:</label>
                        <select id="fontFamily">
                            <option value="Arial">Arial</option>
                            <option value="Verdana">Verdana</option>
                            <option value="Helvetica">Helvetica</option>
                            <option value="Times New Roman">Times New Roman</option>
                            <option value="Courier New">Courier New</option>
                            <option value="Georgia">Georgia</option>
                            <option value="Impact">Impact</option>
                            <!-- Add more font options as needed -->
                        </select>
                        <br>
                        <label for="alignmentSelect">Text Alignment:</label>
                        <select id="alignmentSelect">
                            <option value="left">Left</option>
                            <option value="center">Center</option>
                            <option value="right">Right</option>
                        </select>
                        <br>
                        <label for="fontSize">Font Size:</label>
                        <input type="number" id="fontSize" value="20">
                        <br>
                        <label for="fontColor">Font Color:</label>
                        <input type="color" id="fontColor" value="#000000">
                        <br>
                        <label for="bold">Bold:</label>
                        <input type="checkbox" id="bold">
                        <br>
                        <label for="italic">Italic:</label>
                        <input type="checkbox" id="italic">
                        <br>
                        <label for="underline">Underline:</label>
                        <input type="checkbox" id="underline">
                        <br>
                        <button id="delete-text" class="btn btn-sm btn-danger">Delete Text</button>
                    </div>
                </div>

                <div id="ctl-img" class="controls col-md-4" style="width: 100%;">
                    <h2 class="text-md">Image Controls</h2>
                    <label for="image-width2">Width:</label>
                    <input type="number" id="image-width2" />
                    <br>
                    <label for="image-height2">Height:</label>
                    <input type="number" id="image-height2" />
                    <br>
                    <label for="image-width">Size:</label>
                    <input type="range" id="image-width" min="1" max="1000" />
                    <br>
                    <label for="image-opacity">Opacity:</label>
                    <input type="range" id="image-opacity" min="0" max="1" step="0.1"
                        value="1" />
                    <br>
                    <label for="borderRadius">Border Radius:</label>
                    <input type="range" id="borderRadius" min="0" max="50" value="0">
                    <br>
                    <button id="delete-image" class="btn btn-sm btn-danger">Delete Image</button>
                </div>

            </div>
            <div style="width: 100%;">
                <br>
                <div class="d-flex justify-content-between align-items-center">
                    <h2 class="text-md">My Files</h2>
                    <button class="btn btn-primary upload_img">Upload</button>
                </div>
                <div id="scrollable-container">

                    <!-- Add more images as needed -->
                </div>
            </div>

            <div id="preview-wrapper" style="width: 100%;">
                <h2> Preview </h2>
                <button type="button" class="btn btn-success btn-save m-2">Save Template</button>
                <div class="form-group">
                    <label for="select-org">Select Org</label>
                    <select class="form-control select2" id="select-org" style="width: 100%;">
                    </select>
                </div>
                <div style="width: 100%; height: 600px;overflow-y: scroll; overflow-x: scroll;max-width: 100%;">
                    <div id="content" class="mr-2" style=" width: 100%; height: 700px;">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footerjavascript')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/4.5.0/fabric.min.js"></script>
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    </head>
    <script>
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 2000
        });
        var rect;
        var org;
        var frontTemplate;
        var backTemplate;
        var currentCover = '';
        var currentCover2 = '';
        var textContainer = $('#text-container');
        var textIdCounter = 1;
        var svgString;
        var svgString2;
        $('#preview-wrapper').hide();
        $('#ctl-img').hide();
        $('#text-controls').hide();
        var canvas = new fabric.Canvas('canvas');
        var canvas2 = new fabric.Canvas('canvas2');
        var currentCanva = 1;
        var images = [];
        var storedLeft = canvas.width - 20; // Default value is 100
        var storedTop = 20; // Default value is 100
        var enabled = false;
        var activeObject = canvas.getActiveObject();
        $(document).ready(function() {
            frontTemplate = $('#session-data').attr('data-another-value');
            backTemplate = $('#session-data2').attr('data-another-value');
            console.log('Session Value:', backTemplate);
            loadCurrentTemplate(frontTemplate, canvas);
            loadCurrentTemplate(backTemplate, canvas2);
            load_images();
            load_select();
            loadImagePositions();
            getLocalStorage();

            $('#front').on('click', function(even) {
                currentCanva = 1;
                $('#back').removeClass('active-btn');
                $(this).addClass('active-btn')
            });

            $('#back').on('click', function() {
                currentCanva = 2;
                console.log(currentCanva);
                $('#front').removeClass('active-btn');
                $(this).addClass('active-btn')
            });

            // Click event for tab buttons
            $('.tab-button').on('click', function() {
                // Hide all tabs
                $('.tab-content').removeClass('active-tab');

                // Show the selected tab
                $('#' + $(this).data('tab')).addClass('active-tab');
            });

            $('#select-org').on('change', function(event) {
                org = $(this).val();
                console.log(org);
            });

            $('.new_label').on('click', function() {
                addTextToCanvas('Sample text');
            });

            $(document).on('click', '.upload', function(event) {
                upload();
            });

            $('.upload_img').on('click', function() {
                $('#addImageModal').modal();
            })
            $("#title-editor").data("original-content", $("#title-editor").html());
            $('.btn-merge').on('click', function() {
                enabled = true;
                // convertToSVG();
                $('#preview-wrapper').show();
            });

            $('.btn-save').on('click', function() {
                saveTemplate();
            });

            // Handle input changes
            $("#title-editor").on("input", function() {
                var editor = $("#title-editor");
                var newContent = editor.html().trim();

                // Check if the content is cleared
                if (newContent === "") {
                    // If cleared, restore the original content
                    editor.html(editor.data("original-content"));
                }
            });

            // Load an image onto the canvas
            // fabric.Image.fromURL('{{ asset('dist/img/user8-128x128.jpg') }}', function(img1) {
            //     const desiredWidth = 100; // Adjust this value to your desired width
            //     const scale = desiredWidth / img1.width;
            //     var updatedWidth;
            //     var updatedHeight
            //     // Scale the image
            //     img1.scale(scale);

            //     // Set the position of the image
            //     img1.set({
            //         left: 0,
            //         top: 0,
            //         id: 'picurl',
            //     });
            //     images.push(img1);
            //     // Add the image to the canvas
            //     canvas.add(img1);
            //     canvas.bringToFront(img1)

            //     img1.on('scaling', function(options) {
            //         if (activeObject && activeObject.type === 'image') {
            //             var scaleX = activeObject.scaleX;
            //             var scaleY = activeObject.scaleY;

            //             // Calculate the updated width and height
            //             updatedWidth = activeObject.width * scaleX;
            //             updatedHeight = activeObject.height * scaleY;

            //             console.log(activeObject);
            //             // Update the input fields
            //             $('#image-width2').val(updatedWidth);
            //             $('#image-height2').val(updatedHeight);
            //         }
            //     });

            //     // Assume img1 is your Fabric.js image object
            //     img1.on('selected', function() {
            //         // Get the active object (selected object)
            //         activeObject = canvas.getActiveObject();

            //         if (activeObject && activeObject.type === 'image') {
            //             var scaleX = activeObject.scaleX;
            //             var scaleY = activeObject.scaleY;

            //             // Calculate the updated width and height
            //             updatedWidth = activeObject.width * scaleX;
            //             updatedHeight = activeObject.height * scaleY;

            //             console.log(activeObject);
            //             // Update the input fields
            //             $('#image-width2').val(updatedWidth);
            //             $('#image-height2').val(updatedHeight);
            //         }
            //     });
            // });

            canvas.on('mouse:up', function(options) {
                activeObject = options.target;
                if (activeObject && activeObject instanceof fabric.IText) {
                    console.log('IText clicked:', activeObject.id);
                    console.log(activeObject)
                    editTextStyle();
                    rect = canvas.getObjects().find(obj => obj.type === 'rect' && activeObject.rectid ==
                        obj.rectid);
                    console.log(`this is r : ${rect}`);
                    console.log(activeObject.id);
                    console.log(rect.id);

                    $('#text-controls').show();
                }
                if (options.target && options.target.type === 'image') {
                    $('#ctl-img').show();
                }
            });

            canvas2.on('mouse:up', function(options) {
                var rect;
                activeObject = options.target;
                if (activeObject && activeObject instanceof fabric.IText) {
                    console.log('IText clicked:', activeObject.id);
                    // console.log(activeObject)
                    editTextStyle();

                    console.log(rect)
                    $('#text-controls').show();
                }
                if (options.target && options.target.type === 'image') {
                    $('#ctl-img').show();
                }
            });

            // Event listener for hiding text controls when canvas is clicked
            canvas.on('mouse:down', function() {
                $('#text-controls').hide();
                $('#ctl-img').hide();
            });
            canvas2.on('mouse:down', function() {
                $('#text-controls').hide();
                $('#ctl-img').hide();
            });

            // Event listener for opacity control
            $('#image-opacity').on('input', function() {
                if (currentCanva == 1) {
                    activeObject = canvas.getActiveObject();
                    if (activeObject && activeObject.type === 'image') {
                        activeObject.set('opacity', parseFloat($(this).val()));
                        canvas.renderAll();
                    }
                }

                if (currentCanva == 2) {
                    activeObject = canvas2.getActiveObject();
                    if (activeObject && activeObject.type === 'image') {
                        activeObject.set('opacity', parseFloat($(this).val()));
                        canvas2.renderAll();
                    }
                }
            });

            // Event listener for delete button
            $('#delete-image').on('click', function() {
                if (currentCanva == 1) {
                    activeObject = canvas.getActiveObject();
                    if (activeObject && activeObject.type === 'image') {
                        canvas.remove(activeObject);
                    }
                }

                if (currentCanva == 2) {
                    activeObject = canvas2.getActiveObject();
                    if (activeObject && activeObject.type === 'image') {
                        canvas2.remove(activeObject);
                    }
                }

            });

            $('#delete-text').on('click', function() {
                if (currentCanva == 1) {
                    activeObject = canvas.getActiveObject();
                    if (activeObject && activeObject.type === 'i-text') {
                        canvas.remove(activeObject);
                    }
                }
                if (currentCanva == 2) {
                    activeObject = canvas2.getActiveObject();
                    if (activeObject && activeObject.type === 'i-text') {
                        canvas2.remove(activeObject);
                    }
                }
            });

            // Event listener for object moving
            canvas.on('object:moving', function(e) {
                const movedObject = e.target;
                if (images.includes(movedObject)) {
                    saveImagePositions();
                }
            });
            canvas2.on('object:moving', function(e) {
                const movedObject = e.target;
                if (images.includes(movedObject)) {
                    saveImagePositions();
                }
            });

            // Attach the updateTextStyle function to the change event of controls
            $('#fontFamily, #fontSize, #fontColor, #bold, #italic, #underline, #labelid, #alignmentSelect').on(
                'input',
                function() {
                    updateTextStyle();
                });

        });

        function loadCurrentTemplate(currentTemp, canv) {
            var rectsList = [];
            var textList = [];
            // Load SVG string into fabric canvas
            fabric.loadSVGFromString(currentTemp, function(objects, options) {
                var loadedObjects = fabric.util.groupSVGElements(objects, options);
                // Clear the existing canvas2
                canv.clear();

                // Add the loaded objects to the canvas2
                canv.add(loadedObjects).renderAll();

                loadedObjects.forEachObject(function(obj) {
                    console.log(obj)

                    obj.set({
                        selectable: true,
                        hasControls: true,
                        hasBorders: true
                    });

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

                        canv.renderAll();
                    }
                    console.log(text)
                });

                // Render canvas after adding all objects
                canv.renderAll();
            });
        }

        function load_select() {
            $.ajax({
                type: 'GET',
                url: '{{ route('orgs') }}',
                success: function(data) {
                    console.log(data)

                    // Clear existing options
                    $('#select-org').empty();

                    // Add a default option
                    $('#select-org').append('<option value="">Select Org</option>');

                    $.each(data, function(index, value) {
                        value.text = value.orgname;
                    });
                    // Initialize Select2 after updating options
                    $('#select-org').select2({
                        data: data,
                        allowClear: true,
                        placeholder: "Select Org",
                        theme: 'bootstrap4'
                    });

                }
            });
        }

        function upload() {
            // Get the file input element
            var fileInput = $('#image')[0];
            console.log(fileInput);

            // Check if the file input has a file selected
            if (!fileInput.files.length) {
                notify("warning", "Please select a file for upload")

                return;
            }
            var formData = new FormData($('#uploadForm')[0]);
            console.log(formData);
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

        function editRectPosition() {
            if (currentCanva == 1) {
                console.log(' edit rect')
                var rectobj = canvas.getObjects().find(obj => obj.type === 'rect' && activeObject.rectid ==
                    obj.rectid);

                if (rectobj) {
                    rectobj.set({
                        height: activeObject.height,
                        width: activeObject.width,
                        left: activeObject.left,
                        top: activeObject.top,
                    })
                    canvas.renderAll()
                }
            }

            if (currentCanva == 2) {
                console.log(' edit rect')
                var rectobj = canvas2.getObjects().find(obj => obj.type === 'rect' && activeObject.rectid ==
                    obj.rectid);

                if (rectobj) {
                    rectobj.set({
                        height: activeObject.height,
                        width: activeObject.width,
                        left: activeObject.left,
                        top: activeObject.top,
                    })
                    canvas2.renderAll()
                }
            }
        }

        function editTextStyle() {

            if (currentCanva == 1) {

                const activeObject = canvas.getActiveObject();
            }
            if (currentCanva == 2) {

                const activeObject = canvas2.getActiveObject();
            }

            if (activeObject && activeObject.type === 'i-text') {
                const labelID = $('#labelid');
                const fontFamily = $('#fontFamily');
                const alignment = $('#alignmentSelect');
                const fontSize = $('#fontSize');
                const fontColor = $('#fontColor');
                const boldCheckbox = $('#bold');
                const italicCheckbox = $('#italic');
                const underlineCheckbox = $('#underline');

                // Set values of controls based on active object's properties
                labelID.val(activeObject.id);
                fontFamily.val(activeObject.fontFamily);
                alignment.val(activeObject.textAlign);
                fontSize.val(activeObject.fontSize);
                fontColor.val(activeObject.fill);
                boldCheckbox.prop('checked', activeObject.fontWeight === 'bold');
                italicCheckbox.prop('checked', activeObject.fontStyle === 'italic');
                underlineCheckbox.prop('checked', activeObject.textDecoration === 'underline');

                editRectPosition()
            }
        }

        function updateTextStyle() {
            if (currentCanva == 1) {
                activeObject = canvas.getActiveObject();
            }

            if (currentCanva == 2) {
                activeObject = canvas2.getActiveObject();
            }

            if (activeObject && activeObject.type === 'i-text') {
                const labelID = $('#labelid').val();
                const fontFamily = $('#fontFamily').val();
                const alignment = $('#alignmentSelect').val();
                const fontSize = parseInt($('#fontSize').val()) || 20;
                const fontColor = $('#fontColor').val();
                const isBold = $('#bold').prop('checked');
                const isItalic = $('#italic').prop('checked');
                const isUnderline = $('#underline').prop('checked');

                activeObject.set({
                    id: labelID,
                    fontFamily: fontFamily,
                    textAlign: alignment,
                    fontSize: fontSize,
                    fill: fontColor,
                    fontWeight: isBold ? 'bold' : 'normal',
                    fontStyle: isItalic ? 'italic' : 'normal',
                    textDecoration: isUnderline ? 'underline' : 'none',
                });



                if (currentCanva == 1) {
                    changeRectID(canvas, labelID)
                    canvas.renderAll();
                }

                if (currentCanva == 2) {
                    changeRectID(canvas2, labelID)
                    canvas2.renderAll();
                }
            }
        }

        function addRectangleToCanvas(id) {
            console.log(id)
            var newRect = new fabric.Rect({
                left: 50,
                top: 50,
                width: 100,
                height: 50,
                fill: '',
                strokeWidth: 1,
                stroke: 'black',
                opacity: 0, // Set the opacity value (0 to 1) for transparency
                text: 'Your Text Here', // Embed text directly in the rectangle
                fontFamily: 'Arial',
                fontSize: 16,
                fill: 'black',
                textAlign: 'center',
                originX: 'center',
                originY: 'center',
                id: id + '_rect',
                rectid: id
            });

            if (currentCanva == 1) {
                // Add the rectangle to the canvas
                canvas.add(newRect);

                // Render the canvas after making changes
                canvas.renderAll();
            }

            if (currentCanva == 2) {
                // Add the rectangle to the canvas
                canvas2.add(newRect);

                // Render the canvas after making changes
                canvas2.renderAll();
            }
            console.log(newRect)

        }

        function addTextToCanvas(text) {
            var id = 'text_' + textIdCounter++
            var newText = new fabric.IText(text, {
                left: 100,
                top: 100,
                fontFamily: 'Arial',
                fontSize: 16,
                fontWeight: 'normal',
                fontStyle: 'normal',
                textAlign: 'center',
                originX: 'center',
                originY: 'center',
                id: id,
                rectid: id
            });

            if (currentCanva == 1) {
                console.log(newText);
                console.log(currentCanva);
                // Add the text to the canvas
                canvas.add(newText);
                canvas.setActiveObject(newText);
                canvas.bringToFront(newText);

                // Render the canvas after making changes
                canvas.renderAll();
            }

            if (currentCanva == 2) {
                console.log(newText);

                // Add the text to the canvas
                canvas2.add(newText);
                canvas2.setActiveObject(newText);
                canvas2.bringToFront(newText);

                // Render the canvas after making changes
                canvas2.renderAll();
            }

            $('#text-controls').show();

            newText.on('moved', function() {
                localStorage.setItem('textLeft', newText.left);
                localStorage.setItem('textTop', newText.top);
            });

            // Update the stored position when the text is resized
            newText.on('scaled', function() {
                localStorage.setItem('textLeft', newText.left);
                localStorage.setItem('textTop', newText.top);
            });

            addRectangleToCanvas(id);

        }

        function load_images() {
            $.ajax({
                type: 'GET',
                url: '{{ route('file.load') }}',
                success: function(data) {
                    var result = data[0].data;
                    $('#scrollable-container').empty();
                    $.each(result, function(index, item) {
                        var img =
                            `<img src="{{ asset('/dist/img/templates/') }}/${item}" class="scrollable-image" alt="Image ${index}">`

                        $('#scrollable-container').append(img);
                    });

                    // Event listener for image click
                    $('.scrollable-image').on('click', function() {
                        var imageSrc = $(this).attr('src');
                        if (currentCanva == 1) {
                            currentCover = imageSrc;
                        }
                        if (currentCanva == 2) {
                            currentCover2 = imageSrc;
                        }
                        addImageToCanvas(imageSrc);
                    });
                },
                error: function(xhr, status, error) {
                    console.error(xhr);
                    // Handle error if needed
                }
            });
        }

        // Event listener for width control
        $('#image-width2').on('input', function() {
            adjustImageSize2('w');
        });

        // Event listener for height control
        $('#image-height2').on('input', function() {
            adjustImageSize2('h');
        });

        function adjustImageSize2(value) {
            if (currentCanva == 1) {
                activeObject = canvas.getActiveObject();
            }
            if (currentCanva == 2) {
                activeObject = canvas2.getActiveObject();
            }

            if (activeObject && activeObject.type === 'image') {
                var widthInput = $('#image-width2');
                var heightInput = $('#image-height2');
                var width = parseInt(widthInput.val());
                var height = parseInt(heightInput.val());

                // Check if both width and height are valid
                if (!isNaN(width) && !isNaN(height)) {
                    // Scale the image to the specified width while maintaining aspect ratio
                    if (value == 'w') {
                        activeObject.scaleToWidth(width);
                    }
                    if (value == 'h') {
                        activeObject.scaleToHeight(height);
                    }

                    if (currentCanva == 1) {

                        canvas.renderAll();
                    }
                    if (currentCanva == 2) {

                        canvas2.renderAll();
                    }
                }
            }
        }

        $('#image-width').on('input', function() {
            adjustImageSize();
        });

        // Event listener for height control
        $('#image-height').on('input', function() {
            adjustImageSize();
        });

        // Event listener for opacity control
        $('#image-opacity').on('input', function() {
            if (currentCanva == 1) {
                activeObject = canvas.getActiveObject();
                if (activeObject && activeObject.type === 'image') {
                    activeObject.set('opacity', parseFloat($(this).val()));
                    canvas.renderAll();
                }
            }

            if (currentCanva == 2) {
                activeObject = canvas2.getActiveObject();
                if (activeObject && activeObject.type === 'image') {
                    activeObject.set('opacity', parseFloat($(this).val()));
                    canvas2.renderAll();
                }
            }
        });

        function adjustImageSize() {
            if (currentCanva == 1) {
                activeObject = canvas.getActiveObject();
                if (activeObject && activeObject.type === 'image') {
                    var widthInput = $('#image-width');
                    var heightInput = $('#image-height');
                    var width = parseInt(widthInput.val());
                    var height = parseInt(heightInput.val());

                    // Maintain the proper aspect ratio
                    var aspectRatio = activeObject.width / activeObject.height;
                    if (width && !isNaN(width)) {
                        height = width / aspectRatio;
                    } else if (height && !isNaN(height)) {
                        width = height * aspectRatio;
                    }
                    console.log(`${height} ${width}`)
                    $('#image-width2').val(width);
                    $('#image-height2').val(height);


                    // Update the image size
                    activeObject.set({
                        scaleX: width / activeObject.width,
                        scaleY: height / activeObject.height
                    });

                    canvas.renderAll();
                }
            }

            if (currentCanva == 2) {
                activeObject = canvas2.getActiveObject();
                if (activeObject && activeObject.type === 'image') {
                    var widthInput = $('#image-width');
                    var heightInput = $('#image-height');
                    var width = parseInt(widthInput.val());
                    var height = parseInt(heightInput.val());

                    // Maintain the proper aspect ratio
                    var aspectRatio = activeObject.width / activeObject.height;
                    if (width && !isNaN(width)) {
                        height = width / aspectRatio;
                    } else if (height && !isNaN(height)) {
                        width = height * aspectRatio;
                    }
                    console.log(`${height} ${width}`)
                    $('#image-width2').val(width);
                    $('#image-height2').val(height);


                    // Update the image size
                    activeObject.set({
                        scaleX: width / activeObject.width,
                        scaleY: height / activeObject.height
                    });

                    canvas2.renderAll();
                }
            }
        }

        function addImageToCanvas(imageSrc) {
            fabric.Image.fromURL(imageSrc, function(newImg) {
                // Set the position of the new image
                newImg.set({
                    left: 100, // Set your desired initial left position
                    top: 100, // Set your desired initial top position
                    id: 'cover',
                });

                // Make the new image draggable
                newImg.set({
                    hasControls: true,
                    hasBorders: true,
                    lockMovementX: false,
                    lockMovementY: false,
                });

                // Event listener for object moving
                newImg.on('moving', function(e) {
                    saveImagePositions();
                });

                // Add the new image to the canvas
                if (currentCanva == 1) {
                    console.log('one')
                    canvas.add(newImg);
                    // Bring the new image to the back
                    canvas.sendToBack(newImg);
                }

                if (currentCanva == 2) {
                    console.log('two')
                    canvas2.add(newImg);
                    canvas2.sendToBack(newImg);
                }

                images.push(newImg);



                newImg.on('scaling', function(options) {
                    if (currentCanva == 1) {
                        activeObject = canvas.getActiveObject();
                    }

                    if (currentCanva == 2) {
                        activeObject = canvas2.getActiveObject();
                    }

                    if (activeObject && activeObject.type === 'image') {
                        var scaleX = activeObject.scaleX;
                        var scaleY = activeObject.scaleY;

                        // Calculate the updated width and height
                        var updatedWidth = activeObject.width * scaleX;
                        var updatedHeight = activeObject.height * scaleY;

                        // Update the input fields
                        $('#image-width2').val(updatedWidth);
                        $('#image-height2').val(updatedHeight);
                    }
                });

                newImg.on('selected', function() {
                    if (currentCanva == 1) {
                        activeObject = canvas.getActiveObject();
                    }

                    if (currentCanva == 2) {
                        activeObject = canvas2.getActiveObject();
                    }

                    if (activeObject && activeObject.type === 'image') {
                        var scaleX = activeObject.scaleX;
                        var scaleY = activeObject.scaleY;

                        // Calculate the updated width and height
                        updatedWidth = activeObject.width * scaleX;
                        updatedHeight = activeObject.height * scaleY;

                        console.log(activeObject);
                        // Update the input fields
                        $('#image-width2').val(updatedWidth);
                        $('#image-height2').val(updatedHeight);
                    }
                });

            });
        }

        function saveImagePositions() {
            const positions = {};
            images.forEach((image, index) => {
                positions[`image${index}`] = {
                    left: image.left,
                    top: image.top
                };
            });
            localStorage.setItem('imagePositions', JSON.stringify(positions));
        }

        function loadImagePositions() {
            const positions = JSON.parse(localStorage.getItem('imagePositions')) || {};

            images.forEach((image, index) => {
                const position = positions[`image${index}`];
                if (image instanceof fabric.Object && position) {
                    image.set({
                        left: position.left,
                        top: position.top
                    });
                    image.setCoords(); // Update internal coordinates
                    if (currentCanva == 1) {
                        canvas.renderAll();
                    }
                    if (currentCanva == 2) {
                        canvas2.renderAll();
                    }
                }
            });
        }

        // Function to save image positions in local storage
        function saveImagePositions() {
            const positions = {};
            images.forEach((image, index) => {
                positions[`image${index}`] = {
                    left: image.left,
                    top: image.top
                };
            });
            localStorage.setItem('imagePositions', JSON.stringify(positions));
        }

        function getLocalStorage() {
            storedLeft = localStorage.getItem('textLeft') || canvas.width - 20;
            storedTop = localStorage.getItem('textTop') || 20; //  
        }

        function convertToSVG() {

            // if (!currentCover && currentCanva == 1) {
            //     notify("warning", "Select Cover for Front ID");
            //     return;
            // }

            // if (!currentCover2 && currentCanva == 2) {
            //     notify("warning", "Select Cover for Back ID");
            //     return;
            // }

            if (currentCover && currentCanva == 1) {
                removeRect(canvas)
                getBoundingBoxFront()
                console.log(svgString);
                $('#content').html(svgString);

            }

            if (currentCover2 && currentCanva == 2) {
                removeRect(canvas2)
                getBoundingBoxBack()
                console.log(svgString2);
                $('#content').html(svgString2);
            }

        }

        function getObjectById(canvas, id) {
            var objects = canvas.getObjects();
            for (var i = 0; i < objects.length; i++) {
                if (objects[i].id === id) {
                    return objects[i];
                }
            }
            return null;
        }

        function getObjectByIdRect(canvas, id) {
            var objects = canvas.getObjects();
            for (var i = 0; i < objects.length; i++) {
                if (objects[i].id === id) {
                    console.log(`this is rect = ${objects[i]}`)
                    console.log(objects[i])
                    return objects[i];
                }
            }
            return null;
        }

        function getBoundingBoxFront() {
            removeRect(canvas)
            var coverImage = getObjectById(canvas, 'cover');
            var bounds = coverImage.getBoundingRect();
            svgString = canvas.toSVG({
                width: bounds.width,
                height: bounds.height,
                viewBox: {
                    x: bounds.left,
                    y: bounds.top,
                    width: bounds.width,
                    height: bounds.height,
                },
            });
        }

        function getBoundingBoxBack() {
            removeRect(canvas2)
            var coverImage = getObjectById(canvas2, 'cover');
            var bounds = coverImage.getBoundingRect();
            svgString2 = canvas2.toSVG({
                width: bounds.width,
                height: bounds.height,
                viewBox: {
                    x: bounds.left,
                    y: bounds.top,
                    width: bounds.width,
                    height: bounds.height,
                },
            });
        }

        function changeRectID(canv, newid) {
            var newrect = canv.getObjects().find(obj => obj.type === 'rect' && obj.rectid == canv.getActiveObject().rectid);
            newrect.set({
                id: newid
            });
            // Render the canvas after making changes
            canvas.renderAll();
        }

        function removeRect(canv) {
            var rects = canv.getObjects().filter(obj => obj.type === 'rect');
            rects.forEach(rec => {
                rec.set({
                    opacity: 0
                });
            });
            // Render the canvas after making changes
            canvas.renderAll();
        }

        function saveTemplate() {
            if (!currentCover) {
                notify('error', "No Cover Selected For Front!");
                return;
            }
            if (!currentCover2) {
                notify('error', "No Cover Selected For Back!");
                return;
            }
            if (!org) {
                notify('error', "No Org Selected!");
                return;
            }

            getBoundingBoxFront()
            getBoundingBoxBack()

            var tempname = $("#template-name").text();
            $.ajax({
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    orgid: org,
                    name: tempname,
                    templates: [{
                            template: svgString,
                            image: currentCover,
                            type: 'front',
                        },
                        {
                            template: svgString2,
                            image: currentCover2,
                            type: 'back',
                        },
                    ],
                },
                url: '{{ route('add.template') }}',
                success: function(data) {
                    notify(data.statusCode, data.message);
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
