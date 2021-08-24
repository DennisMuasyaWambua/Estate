<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{config('app.name', 'Smart Estate')}}</title>
     <!-- CSRF Token -->
     <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- custom css -->
    <link href="{{asset('css/app.css')}}" rel="stylesheet" >
     <!-- material icons -->
     <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"/>
    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    <!-- jquery -->
    <script  src="https://code.jquery.com/jquery-3.5.1.js"  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="crossorigin="anonymous" ></script>
    <link rel="shortcut icon" href="{{asset('images/favicon.ico')}}" type="image/x-icon">
</head>
<body style="background-image:url('/images/home.jpg');background-size:cover;background-repeat:no-repeat;background-position:center;">
    <div id="app">
        <main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
            @yield('content')
        </main>
    </div>
</body>
</html>