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
        <h1>Original Array</h1>
        @foreach($originalArray as $a)
        {{$a}}
        @endforeach

        <h1>Asscending Order</h1>
        @foreach($assc as $a)
        {{$a}}
        @endforeach

        <h1>Descending Order</h1>
        @foreach($desc as $a)
        {{$a}}
        @endforeach

        <h1>Unique Elements </h1>
        @foreach($uniqueArray as $a)
        {{$a}}
        @endforeach

        <h1>Removed Elements </h1>
        @foreach($dublicateArray as $a)
        {{$a}}
        @endforeach
    </div>


</body>

</html>