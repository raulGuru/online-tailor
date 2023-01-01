<!DOCTYPE html>
<html>
<head>
    <title>{{ $data['subject'] }}</title>
</head>
<body>
    <h1>Hello {{ $data['body']['customer_name'] }},</h1>
    <p>You appointment have been approved. Below are the the tailor details:</p>
    <table>
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
    <p>Thanks & Regards!</p>
</body>
</html>