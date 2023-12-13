<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <title>{{$data['title']}}</title>
</head>
<body>
    <div class="row justify-content-center">
        <div class="col-8">
            <p>Hi {{$data['name']}}, Welcome to MLM System</p>
            <p>Please Verify your Email  </p>
            <a class="btn btn-primary" href="{{$data['verifyUrl']}}">Click Here</a>

            <p class="h4"> Thank You!</p>
        </div>
    </div>
    
</body>
</html>