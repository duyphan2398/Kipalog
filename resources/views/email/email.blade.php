<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Mail</title>
</head>
<body>
    <h1>Hello {{$details['name']}}, I am Kipalog</h1>
    <h3>To reset the password , click here : </h3> <br>
    <a href="{{$details['link']}}">{{$details['link']}}</a>
</body>
</html>
