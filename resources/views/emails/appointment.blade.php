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
            <td>Services</td>
            <td class="text-capitalize">
                <ol>
                    @foreach($data['body']['services'] as $service)
                        <li>{{ ucfirst($service) }}</li>
                    @endforeach
                </ol>
            </td>
        </tr>
        <tr>
            <td>Service Description</td>
            <td>
                {{ $data['body']['service_description'] }}
            </td>
        </tr>
        <tr>
            <td>Click on below link to approve or disapprove appointment</td>
            <td>
                <a href="{{ route('appointment.show', $data['body']['appointment_id']) }}" target="_blank">Click here</a>
            </td>
        </tr>
    </table>
    <p>Thanks & Regards!</p>
</body>
</html>