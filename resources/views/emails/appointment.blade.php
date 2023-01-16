<!DOCTYPE html>
<html>
<head>
    <title>{{ $data['subject'] }}</title>
</head>
<body>
    <h1>Hello {{ $data['body']['tailor_name'] }},</h1>
    <p>Below are the booking information of customer:</p>
    <table>
        <tr>
            <td>Customer name</td>
            <td>{{ $data['body']['fullname'] }}</td>
        </tr>
        <tr>
            <td>Mobile</td>
            <td>{{ $data['body']['mobile'] }}</td>
        </tr>
        <tr>
            <td>Email</td>
            <td>{{ $data['body']['email'] }}</td>
        </tr>
        <tr>
            <td>Address</td>
            <td>{{ $data['body']['address'] }}</td>
        </tr>
        <tr>
            <td>Appointment datetime</td>
            <td>{{ $data['body']['appointment_at'] }}</td>
        </tr>
        <tr>
            <td>Click on below link to approve or disapprove appointment</td>
            <td>
                <a href="{{ route('appointment.list') }}" target="_blank">Click here</a>
            </td>
        </tr>
    </table>
    <p>Thanks & Regards!</p>
</body>
</html>