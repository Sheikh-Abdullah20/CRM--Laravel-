<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Queries</title>
</head>
<body>
    <h1>Hello .....</h1>

    <p>This Mail is Comming From CRM</p>
    <hr>
    <h2>{{$request['name']}} This Person Send You a Message</h2>

    <ul>
        <li>{{ $request['name'] }}</li>
        <li>{{ $request['email'] }}</li>
        <li>{{ $request['description'] }}</li>
    </ul>
</body>
</html>