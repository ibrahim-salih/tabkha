<!DOCTYPE html>
<html>
<head>
    <title>طبخة بيتى دوت كوم</title>
</head>
<body>
    <h1>{{ $mailData['title'] }}</h1>
    <p>{{ $mailData['body'] }}</p>
    <p>اهلا بك يا / {{ $mailData['name'] }}</p>
    <p>الرجاء الضغط على الرابط أدناه لتأكيد حساب الطباخ الخاص بك :-
    <a href="{{ url('cooker/confirm/'.$mailData['code']) }}">{{ url('cooker/confirm/'.$mailData['code']) }}.</p>
     
    <p>شكرا لك</p>
</body>
</html>
