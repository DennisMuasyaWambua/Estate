@extends('caretaker.caretakerTemplate')
   
    @section('content')
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
        <nav id="top-bar">
            <div class="nav-container">
            <ul>
                    <li class="nav-item"><a href="{{ route('logout') }}" class="nav-link underline"onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a></li>
            </ul>
            <form class="d-flex" method="GET" action="">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            
            </div>
        </nav>
        @auth     
            <form id="logout-form" method="POST" action="{{route('logout')}}" >@csrf</form>
        @endauth
    </div>
   
                
           
            <div class="cards">
                <div id="occupant">
                    <a
                        class="occupancy"
                        href="#occupancyModal"
                        data-bs-toggle="modal"
                        data-bs-target="#occupancyModal"
                    >
                    <div class="occupancy-overlay"></div>
                    <div class="occupancy-circle">
                    <img src="{{asset('images/house.png')}}" alt="" />
                    <p>Occupancy</p>
                    </div>
                    </a>
                </div>

                
                <div id="service-charge">
                    <a
                        href="#service-charge"
                        class="serviceCharge"
                        data-bs-toggle="modal"
                        data-bs-target="#rentserviceModal"
                    >
                        <div class="accounts-overlay"></div>
                        <div class="accounts-circle">
                        <img src="{{asset('images/rent.png')}}" alt="" />
                        <p>Service charge</p>
                        </div>  
                    </a>
                </div>

                <div class="set-payment-date">
                    <a
                        class="bills"
                        href="#billsModal"
                        data-bs-toggle="modal"
                        data-bs-target="#billsModal"
                    >
                        <div class="bills-overlay"></div>
                        <div class="bills-circle">
                        <img src="{{asset('images/bank.png')}}" alt="" />
                        <p>Set service charge payment date</p>
                        </div>
                    </a>
                </div>
               

            </div>
            

             <!-- Modals for the various cards -->
             <!-- Modal -->
             <!-- occupancy modal -->
            <div class="modal fade" id="occupancyModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Your Occupants</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                        <div id="table">
                                <form action="{{route('Dashboard.allOccupants')}}" method="POST">
                                    <table class="table">
                                        <thead class="table-dark">
                                            <a class="btn btn-sm btn-success"role="button"style="float:right;margin-bottom:5px;padding:5px;"data-bs-toggle="modal"data-bs-target="#addOccupant">create occupant</a>
                                            <tr>
                                                <th scope="col">id</th>
                                                <th scope="col">name</th>
                                                <th scope="col">email</th>
                                                <th scope="col">phone</th>
                                                <th scope="col">estate</th>
                                                <th scope="col">block number</th>
                                                <th scope="col">flat number</th>
                                                <th scope="col">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-dark">
                                            @foreach($occupants as $occupant)
                                                <tr>
                                                    <td>{{$occupant['id']}}</td>
                                                    <td>{{$occupant['name']}}</td>
                                                    <td>{{$occupant['email']}}</td>
                                                    <td>{{$occupant['phone']}}</td>
                                                    <td>{{$occupant['estate']}}</td>
                                                    <td>{{$occupant['blockNumber']}}</td>
                                                    <td>{{$occupant['flatNumber']}}</td>
                                                    <td>
                                                        <a class="btn btn-sm btn-primary" type="button" href="{{route('Dashboard.updateOccupant',$occupant->id)}}"data-bs-toggle="modal"data-bs-target="#occupancyModal">Update</a>
                                                        <a class="btn btn-sm btn-danger" type="button" href="{{route('Dashboard.deleteOccupant',$occupant->id)}}"data-bs-toggle="modal"data-bs-target="#occupancyModal">Delete</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                                                                 
                                        </tbody>
                                    </table>
                                </form>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            <!-- create occupant modal -->
            <div class="modal fade" id="addOccupant" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Add Occupant</h5>
                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('Dashboard.createOccupant')}}"method="POST">
                                @csrf
                                <div class="form-group">
                                    <input hidden="true" value="{{auth()->user()->id}}" name="caretakerId">
                                </div>
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input class="form-control" type="text" name="name" placeholder="Occupant's name" autofocus>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input class="form-control" type="email" name="email" placeholder="email" >
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input class="form-control" type="number" name="phone" placeholder="phone" value="+254" >
                                </div>
                                <div class="form-group">
                                    <label for="estate">Estate</label>
                                    <input class="form-control" type="text" name="estate" placeholder="estate" >
                                </div>
                                <div class="form-group">
                                    <label for="name">Block Number</label>
                                    <input class="form-control" type="text" name="blockNumber" placeholder="block number" >
                                </div>
                                <div class="form-group">
                                    <label for="flatNumber">Flat Number</label>
                                    <input class="form-control" type="text" name="flatNumber" placeholder="flat number" >
                                </div>

                                <button class="btn btn-sm btn-success"style="float:right;padding:5px;margin-top:5px;" type="submit">Add occupant</button>
                            </form>
                        </div>
                        
                    </div>
                </div>
            </div>
            

                
    @endsection