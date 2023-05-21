<!DOCTYPE html>
<html>
<head>
    <title>{{ $data['subject'] }}</title>
</head>
<body>
    <h2>Hello {{ $data['body']['name'] }},</h2>
    <p><strong>Book Home Appointment</strong></p>
    <p>Our Stylist experts will visit at home</p>
    <p><strong>Visit Store</strong></p>
    <p>You can visit nearest store based on the nearest location</p>
    <p><strong>visit : <a href="{{ env('APP_URL') }}">bookmytailor.in</a></strong></p>
    <p>&nbsp;</p>
    <p>If you do not wish to receive these emails kindly click unsubscribe link.</p>
    <p>&nbsp;</p>
    <p>Thanks & Regards!</p>
</body>
</html>