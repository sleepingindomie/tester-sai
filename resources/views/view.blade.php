<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
    
        <title>Docsys - View BL</title>
    
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
            gap: 20px;
            padding: 20px;
        }
        .button-container {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-top: 20px;
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
        .container {
            position: relative;
            width: 1000px;
            height: 1414px;
            background: url('{{ asset('img/BL.png') }}') no-repeat center center;
            background-size: cover;
            padding: 20px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
        }
        .data-section {
            position: relative;
        }
        .item {
            position: absolute;
            font-size: 14px;
            font-weight: bold;
            width: 250px;
        }
        .A0 { top: 35px; left: 800px; }
        .A1 { top: 15px; left: 200px; }
        .A2 { top: 136px; left: 200px; }
        .A3 { top: 258px; left: 200px; }
        .A4 { top: 400px; left: 350px; }
        .A5 { top: 445px; left: 100px; }
        .A6 { top: 445px; left: 360px; }
        .A7 { top: 485px; left: 100px; }
        .A8 { top: 485px; left: 360px; }
        .A9 { top: 540px; left: 70px; width: 50px; }
        .A10 { top: 540px; left: 196px; width: 50px; }
        .A11 { top: 550px; left: 320px; }
        .A12 { top: 580px; left: 400px; width: 500px; height: 300px; }
        .A13 { top: 550px; left: 780px; width: 100px; text-align: center; }
        .A14 { top: 660px; left: 780px; width: 100px; text-align: center; }
        .A15 { top: 550px; left: 870px; width: 150px; text-align: center; }
        .A16 { top: 940px; left: 300px; width: 500px; }
        .A17 { top: 1100px; left: 120px; }
        .A18 { top: 1210px; left: 670px; }
        .A19 { top: 1305px; left: 130px; }
        .A20 { top: 1325px; left: 400px; }
        .A21 { top: 485px; left: 780px; } 
        .textarea-item {
            position: absolute;
            font-size: 14px; 
            font-weight: bold;
            width: 500px;
            height: 300px;
            resize: none;
            border: none;
            background-color: transparent;
            overflow: hidden;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="data-section">
            <div class="item A0">{{ $data->bl }}</div>
            <div class="item A1">{{ $data->shipper }}</div>
            <div class="item A2">{{ $data->consignee }}</div>
            <div class="item A3">{{ $data->notify_party }}</div>
            <div class="item A4">{{ $data->place_of_receipt }}</div>
            <div class="item A5">{{ $data->ocean_vessel }}</div>
            <div class="item A6">{{ $data->port_of_loading }}</div>
            <div class="item A7">{{ $data->port_of_discharge }}</div>
            <div class="item A8">{{ $data->place_of_delivery }}</div>
            <div class="item A9">{{ $data->container_no }}</div>
            <div class="item A10">{{ $data->seal_no }}</div>
            <div class="item A11">{{ $data->no_of_containers }}</div>
            <textarea class="textarea-item A12" readonly>{{ $data->description_of_goods }}</textarea>
            <div class="item A13">
                <div><u>GROSS WEIGHT (KGS)</u></div>
                <div>{{ number_format(floatval($data->gross_weight), 2) }}</div>
            </div>
            <div class="item A14">
                <div><u>NET WEIGHT (KGS)</u></div>
                <div>{{ number_format(floatval($data->net_weight), 2) }}</div>
            </div>
            <div class="item A15">
                <div><u>(CBM)</u></div>
                <div>{{ number_format(floatval($data->measurement), 4) }}</div>
            </div>
            <div class="item A16">{{ $data->total_no_of_containers }}</div>
            <div class="item A17">{{ $data->freight_and_charges }}</div>
            <div class="item A18">{{ $data->place_date_of_issue }}</div>
            <div class="item A19">{{ $data->date }}</div>
            <div class="item A20">{{ $data->ocean_vessel }}</div>
            <div class="item A21">{{ $data->final_destination }}</div>
        </div>
    </div>
    <div class="button-container">
        @if (!empty($data->attached_sheet_description))
            <a href="{{ route('attachedsheet', ['bl' => $data->bl]) }}" class="button">Attached Sheet</a>
        @endif
        <a href="{{ route('review') }}" class="button">Back</a>
    </div>
</body>
</html>
