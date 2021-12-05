@extends('admin.adminTemplate')
@section('content')
    <div class="splash">
        <div class="fade-in">
            <img src="{{asset('images/smart1.jpeg')}}">
                <p>Smart Estate</p>
        </div>            
    </div>
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
    <div id="nav-bar">
            <button
                id="close"
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
                onclick="closeNav()"
                ></button>
        <div id="profile-image">
            <img src="" alt="">
        </div>
        <div class="info">
            <div id="admin-name">
                <!-- posting the name of the authenticated admin using auth->user->name -->
                <p></p>
            </div>
            <div id="caretakers">
                <a href="#">Caretakers</a>
            </div>
        </div>
    </div>
    <div class="container">
         <div class="mdc-card">
                 <table>
                     <thead>
                         <th>Caretaker Name</th>
                         <th>Caretaker Estates</th>
                         <th>Caretaker Rate</th>
                         <th>Action</th>
                     </thead>
                     <tbody>
                         <tr>
                             
                         </tr>
                     </tbody>
                 </table>
         </div>
    </div>
    <!-- script to load the splash screen -->
    <script>
        //for the splash screen
        const splash  = document.querySelector('.splash');
        document.addEventListener('DOMContentLoaded',(e)=>{
            setTimeout(() => {
                splash.classList.add('display-none');

            }, 2000);
        });
    </script>
    <script>
         //for the navigation panel
            function openNav() {
                document.getElementById("nav-bar").style.width = "250px";
                document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
            }
            function closeNav() {
                document.getElementById("nav-bar").style.width = "0px";
            }
    </script>
@endsection