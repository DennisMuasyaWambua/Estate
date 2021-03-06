<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- app name -->
    <title>{{config('app.name','Smart Esate')}}</title>
    <!-- local css -->
    <link href="{{asset('css/app.css')}}" rel="stylesheet" >
    <!-- material icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"/>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- javascript with pooper -->
    <script  src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <!-- jquery -->
    <script  src="https://code.jquery.com/jquery-3.5.1.js"  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="crossorigin="anonymous" ></script>
</head>
<body style="background-image:url('/images/home.jpg');background-size:cover;background-repeat:no-repeat;background-attachment:fixed;">
<div class="container">
      <nav class="nav">
        <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    login
                  </button> -->
        <ul class="nav">
          <!-- <li class="nav-item"><a class="nav-link" href="#">Home</a></li> -->
          <li class="nav-item">
          @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                    <li class="nav-item"><a href="{{ url('/home') }}" class="nav-link underline">Home</a></li>
                    <li class="nav-item"><a href="{{ route('logout') }}" class="nav-link underline"onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a></li>
                    <form id="logout-form" method="POST" action="{{route('logout')}}" >@csrf</form>
                    @else
                    <li class="nav-item"><a href="/auth" class="nav-link underline">Log in</a></li>

                        @if (Route::has('register'))
                        <li class="nav-item"><a href="{{ route('register') }}" class="nav-link underline">Register</a></li>
                        @endif
                    @endauth
                </div>
            @endif

            <!-- <a
              class="nav-link"
              href="/login"
              data-bs-toggle="modal"
              data-bs-target="#exampleModal"
              >Login</a
            > -->
          </li>
        </ul>
      </nav>

      <div class="logo">
        <img src="/images/smart1.jpeg" height="30%" width="20%" />
      </div>
      <div class="title">
        <p>SMART ESTATE</p>
      </div>
      <div class="message">
        <p>Occupancy management has never gotten easier</p>
      </div>
    </div>
</body>
</html>