<!DOCTYPE html>
<html>

<head>
    <title>Car Rental Notification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7f7f7;
        }

        .container {
            width: 100%;
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h3 {
            color: #333;
            font-size: 24px;
            border-bottom: 2px solid #ddd;
            padding-bottom: 10px;
        }

        p {
            color: #555;
            font-size: 16px;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        li {
            color: #333;
            padding: 8px 0;
            border-bottom: 1px solid #eee;
        }

        li strong {
            color: #444;
        }

        .highlight {
            background-color: #f0f8ff;
            padding: 10px;
            margin-top: 20px;
            border-radius: 5px;
            border-left: 5px solid #007bff;
        }

        .footer {
            margin-top: 20px;
            font-size: 14px;
            text-align: center;
            color: #888;
        }
    </style>
</head>

<body>
    <div class="container">
        <h3>Rental Notification: Serial Number {{ $mail_data['id'] }}</h3>
        <p>Dear Admin,</p>
        <p>A car has been successfully rented by the <b>{{ $mail_data['name'] }}</b></p>
        
        <ul>
            <li><strong>Customer Name:</strong> {{ $mail_data['name'] }}</li>
            <li><strong>Customer Email:</strong> {{ $mail_data['email'] }}</li>
            <li><strong>Customer Phone:</strong> {{ $mail_data['phone'] }}</li>
        </ul>

        <p>Rental Details:</p>
        <ul>
            <li><strong>Car Name:</strong> {{ $mail_data['car_name'] }}</li>
            <li><strong>Car Brand:</strong> {{ $mail_data['car_brand'] }}</li>
            <li><strong>Car Model:</strong> {{ $mail_data['car_model'] }}</li>
            <li><strong>Car Type:</strong> {{ $mail_data['car_type'] }}</li>
            <li><strong>Year of Manufacture:</strong> {{ $mail_data['car_year'] }}</li>
            <li><strong>Rental Start Date:</strong> {{ $mail_data['start_date'] }}</li>
            <li><strong>Rental End Date:</strong> {{ $mail_data['end_date'] }}</li>
            <li><strong>Total Cost:</strong> ${{ $mail_data['total_cost'] }}</li>
        </ul>

        <div class="highlight">
            <p><strong>Note:</strong> Please ensure that the car is ready for delivery on the specified start date and that all rental agreements are in place.</p>
        </div>

        <p class="footer">Thank you for using our service!</p>
    </div>
</body>

</html>
