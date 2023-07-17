<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Vaccine Reminder</title>
</head>
<body>
    <h1>Vaccine Reminder</h1>

    <p>Dear <p>Dear {{ $infant->parent ? $infant->parent->name : 'Parent' }},</p>
    ,</p>

    <p>This is a friendly reminder that you have a vaccine appointment coming up:</p>

    <table>
        <tr>
            <th>Vaccine Name</th>
            <th>Appointment Date</th>
            <th>Appointment Time</th>
        </tr>
        <tr>
            <td>{{ $infant->last_name }}  {{ $infant->other_name }}</td>
            <td>{{ $vaccine->name }}</td>
            
        </tr>
    </table>

    <p>Please ensure to bring your child for the vaccine appointment on time. If you have any questions or need to reschedule, please contact our clinic.</p>

    <p>Thank you!</p>
</body>
</html>
