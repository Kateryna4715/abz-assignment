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


<div style="margin: 36px; display: flex; flex-direction: column" >


<div style="width: 300px; padding: 20px; border: 1px solid #ccc; border-radius: 8px; background-color: #f9f9f9; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); ">


    <div style="text-align: center;">
        <img src="{{$user->photo}}" alt="User Image" style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover;">
    </div>
    <div style="text-align: center; margin-top: 10px;">
        <h2 style="font-size: 20px; color: #333; margin: 10px 0;">{{$user->name}}</h2>
        <p style="font-size: 14px; color: #777; margin: 5px 0;">Position: {{$position}}</p>
        <p style="font-size: 14px; color: #777; margin: 5px 0;">Email: {{$user->email}}</p>
        <p style="font-size: 14px; color: #777; margin: 5px 0;">Phone: {{$user->phone}}</p>
        <p style="font-size: 14px; color: #777; margin: 5px 0;">Date of registration: {{$user->created_at}}</p>

    </div>
</div>

    <div style=" margin-top: 20px;">
        <a href="{{url('/api/users')}}" style="padding: 10px 20px; color: #000; text-decoration: none; border: #000 solid 1px; border-radius: 5px; cursor: pointer;">
            Back
        </a>
    </div>
</div>
</body>
</html>
