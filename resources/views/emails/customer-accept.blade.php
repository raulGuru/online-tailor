<!DOCTYPE html>
<html>
<head>
    <title>{{ $data['subject'] }}</title>
</head>
<body>
    <h1>Hello {{ $data['body']['customer_name'] }},</h1>
    <p style="margin-top: 20px">We have accepted your request and Stylist experts will visit at home</p>
    <table style="margin-top: 20px">
        <tr>
            <td>Tailor Name</td>
            <td>{{ $data['body']['tailor_name'] }}</td>
        </tr>
        <tr>
            <td>Shop Name</td>
            <td>{{ $data['body']['shop_name'] }}</td>
        </tr>
        <tr>
            <td>Mobile</td>
            <td>{{ $data['body']['mobile'] }}</td>
        </tr>
        <tr>
            <td>Location</td>
            <td>{{ $data['body']['location'] }}</td>
        </tr>
        <tr>
            <td>Appointment datetime</td>
            <td>{{ $data['body']['appointment_at'] }}</td>
        </tr>
        <tr>
            <td>Address</td>
            <td>{{ $data['body']['address'] }}</td>
        </tr>
    </table>
    <p style="margin-top: 20px">visit : <a href="https://bookmytailor.in">bookmytailor.in</a></p>
    <p style="margin-top: 30px">Thanks & Regards!</p>
</body>
</html>