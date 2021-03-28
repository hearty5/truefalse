<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->

    <style>
        body {
            font-family: 'Nunito';
        }
    </style>
   <!--  <script src="{{ mix('/js/app.js')}}" defer></script>
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet" type="text/css"> -->
    <link href="vendor/hearty5/resources/css/animate.css" rel="stylesheet" type="text/css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body class="antialiased container mt-5">


    <div id="app">

        <true-false-component></true-false-component>
        
    </div>
</body>

</html>