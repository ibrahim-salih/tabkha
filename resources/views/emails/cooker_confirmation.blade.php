<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
</head>
<body>
<table>
    <tr><td>Dear {{ $name }}</td></tr>
    <tr><td>&nbsp;<br></td></tr>
    <tr><td>Please Click on the below link to confirm your cooker account :-</td></tr>
    <tr><td><a href="{{ url('cooker/confirm/'.$code) }}">{{ url('cooker/confirm/'.$code) }}</a></td></tr>
    <tr><td>&nbsp;<br></td></tr>
    <tr><td>Thanks & Regards</td></tr>
    <tr><td>&nbsp;</td></tr>
    <tr><td>Miny Soft</td></tr>
</table>
</body>
</html>
