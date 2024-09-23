<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Result</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <a href="/manage" class="btn btn-primary">home</a>

        <h1>Your Funny Predictions Results</h1>
        <h3>your name is : </h3>
        <h5>{{ $name }}</h5>
        <h3>your age is : </h3>
        <h5>{{ $age }}</h5>
        <h3>Advice : </h3>
        <h5>{{ $advice }}</h5>
        <img src="{{$image}}" alt="Girl in a jacket" width="25%" height="25%">

    </div>


</body>

</html>