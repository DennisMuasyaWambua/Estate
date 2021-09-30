<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<svg
      xmlns="http://www.w3.org/2000/svg"
      width="40"
      height="40"
      fill="currentColor"
      class="bi bi-list"
      viewBox="0 0 16 16"
      onclick="openNav()"
      style="margin: 20px"
    >
      <path
        fill-rule="evenodd"
        d="M2.5 11.5A.5.5 0 0 1 3 11h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4A.5.5 0 0 1 3 7h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4A.5.5 0 0 1 3 3h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"
      />
    </svg>
    <div id="sidebar-navigation" class="profile">
            <button
                id="close"
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
                onclick="closeNav()"
                ></button>
                <div class="profile-avatar">
                    
                </div>
            <p>{{auth()->user()->name}}</p>
            
                
           {{session()->put('userEmail',auth()->user()->email)}}
           
            <nav id="top-bar">
                <div class="nav-container">
                    <ul>
                        <li class="nav-item"><a href="{{ route('logout') }}" class="nav-link underline"onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a></li>
                    </ul>
                
                </div>
            </nav>
            @auth     
                <form id="logout-form" method="POST" action="{{route('logout')}}" >@csrf</form>
            @endauth
        </div>
        <script>
            function openNav() {
                document.getElementById("sidebar-navigation").style.width = "250px";
                document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
            }
            function closeNav() {
                document.getElementById("sidebar-navigation").style.width = "0px";
            }
        </script>
</body>
</html>