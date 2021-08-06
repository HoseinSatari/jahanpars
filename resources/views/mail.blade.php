<!doctype html>
<html lang="en">
<head>
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <link href="{{ asset('css/persianfonts.css') }}" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{option()->sitename}}</title>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-4"></div>
        <div class="col-4 mt-5" style="text-align: center">{{$text}}</div>
        <div class="col-4"></div>
    </div>
</div>

</body>
</html>
