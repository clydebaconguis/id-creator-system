<!-- student-id.html -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student ID</title>

    <style>
        /* Add your styles here */
        body {
            font-family: Arial, sans-serif;
        }

        .student-id {
            display: flex;
            justify-content: space-between;
            width: 300px;
            margin: 20px;
        }

        .student-id .card {
            border: 1px solid #ccc;
            padding: 20px;
            margin: 10px;
            text-align: center;
            line-height: 0;
        }

        .your-div {
            width: 150px;
            height: 150px;
            background-image: url('{{ asset('dist/img/avatar5.png') }}');
            background-size: contain;
            background-position: center;
            border-radius: 50%;
        }
    </style>
</head>

<body>

    <div class="student-id">
        <div class="card">
            <!-- Front side content with dummy details -->
            <h2 style="color: rgb(242, 87, 113);">afsdf</h2>
            <div style="width: 100%;">
                <div class="your-div" draggable="true" style="margin-left: auto; margin-right: auto;"></div>
            </div>
            <p draggable="true" style="font-weight: bold; margin: 0;">sdfsdf,
                sfsd</p>
            {{-- <p style="margin: 0;">{{ $data->level }}</p>
            <p style="margin: 0;">ID NO: {{ $data->idnumber }}</p>
            <p style="margin: 0;">DOB: {{ $data->birthdate }}</p> --}}
            <p style="margin: 0;">EXP DATE: Dec 25, 2023</p>
            <!-- Add more details as needed -->
        </div>

        <div class="card">
            <!-- Back side content with dummy details -->
            <h2>Contact Information</h2>
            <img src="https://cdn.britannica.com/17/155017-050-9AC96FC8/Example-QR-code.jpg" alt="QRcode">
            <p>Email: john.doe@example.com</p>
            <p>Phone: 123-456-7890</p>
            <!-- Add more details as needed -->
        </div>
    </div>


</body>

</html>
