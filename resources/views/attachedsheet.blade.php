<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <title>Docsys - Attached Sheet</title>
    
    <link rel="icon" href="https://www.samudera.id/public_assets/img/logo-ico.jpg" type="image/x-icon">
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding: 20px;
            gap: 20px;
        }

        .button-container {
            display: flex;
            flex-direction: column;
            gap: 10px;
            position: absolute;
            top: 20px;
            right: 20px;
        }

        .button {
            padding: 10px 20px;
            background-color: #6bc6d6;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
            font-size: 14px;
        }

        .content {
            width: 60%;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .content h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .content p {
            text-align: justify;
            white-space: pre-wrap;
        }
    </style>
</head>

<body>
    <div class="button-container">
        <a href="{{ route('review') }}" class="button">Back</a>
    </div>
    <div class="content">
        <h1>Attached Sheet</h1>
        <p>{{ htmlspecialchars_decode($data->attached_sheet_description) }}</p>
    </div>
</body>

</html>
