<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<div  style=" margin: 40px">
<div style="display: flex; justify-content: space-between; margin-bottom: 24px">
    <a style=" text-decoration: none; " href="/api/users/create"><div style="display: inline-block; padding: 8px 16px;  color: #000; text-align: center; border: 1px solid #000000; border-radius: 4px; transition: background-color 0.3s; ">Create User</div></a>
</div>
    <div style="display: flex; flex-wrap: wrap; gap: 36px; justify-content: space-between;">
@foreach($users as $user)

    <a href="{{url('api/users/'. $user->id)}}">
        <div style="display: flex; gap: 4px; flex-direction: column; border: 1px solid #0a0a0a;  justify-content: center; align-items: center;">
        <img src="{{ $user->photo }}" alt="User photo">
        <p style="margin: 0; padding: 0">{{ $user->name }}</p>
        <p style="margin: 0; margin-bottom: 8px; padding: 0">{{ $user->phone }}</p>
    </div>
    </a>
@endforeach

    </div>
    <div style="margin-top: 24px">
        {{ $users->links() }}
    </div>
</div>
</body>
</html>
