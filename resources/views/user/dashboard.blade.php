@extends('user.userTemplate')
   
    @section('content')
    <link rel="stylesheet" href="{{ asset('datatable/css/dataTables.bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('datatable/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{asset('sweetalert2/sweetalert2.min.css')}}">
    <link rel="stylesheet" href="{{asset('toastr/toastr.min.css')}}">   
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

                <div class="deadline">
                    <a
                        class="deadline-card"
                        href="#billsModal"
                        data-bs-toggle="modal"
                        data-bs-target="#billsModal"
                    >
                        <div class="deadline-overlay"></div>
                        <div class="deadline-circle">
                        <img src="{{asset('images/bank.png')}}" alt="" />
                        <p>Payment Date</p>
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
                                                        <button class="btn btn-sm btn-danger" onclick="event.preventDefault();document.getElementById('delete-{{$occupant->id}}').submit()">Delete</button>
                                                        <form id="delete-occupant-form-{{$occupant->id}}" action="{{route('Dashboard.deleteOccupant',$occupant->id)}}"method="POST" style="display:none;">@csrf</form>
                                                    </td>
                                                    <!-- pagination links -->
                                                        
                                                    <!-- delete modal -->
                                                    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLongTitle">Delete</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    <button type="button" class="btn btn-sm btn-danger"onclick="event.preventDefault();document.getElementById('delete-occupant-form-{{$occupant->id}}').submit()">Delete</button>
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </tr>
                                            @endforeach
                                                                                 
                                        </tbody>
                                        
                                    </table>
                                    
                                    {{$occupants->links()}}
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
                            <form id="createOccupant" auto-complete="off" action="{{route('Dashboard.createOccupant')}}"method="POST">
                                @csrf
                                <div class="form-group">
                                    <input hidden="true" value="{{auth()->user()->id}}" name="caretakerId">
                                </div>
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input id="name" class="form-control" type="text" name="name" placeholder="Occupant's name" autofocus>
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input id="email" class="form-control" type="email" name="email" placeholder="email" >
                                    <span class="text-danger error-text email_error"></span>
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input id="phone" class="form-control" type="number" name="phone" placeholder="phone" >
                                    <span class="text-danger error-text phone_error"></span>
                                </div>
                                <div class="form-group">
                                    <label for="estate">Estate</label>
                                    <input id="estate" class="form-control" type="text" name="estate" placeholder="estate" >
                                    <span class="text-danger error-text estate_error"></span>
                                </div>
                                <div class="form-group">
                                    <label for="name">Block Number</label>
                                    <input id="blockNumber" class="form-control" type="text" name="blockNumber" placeholder="block number" >
                                    <span class="text-danger error-text blockNumber_error"></span>
                                </div>
                                <div class="form-group">
                                    <label for="flatNumber">Flat Number</label>
                                    <input id="flatNumber" class="form-control" type="text" name="flatNumber" placeholder="flat number" >
                                    <span class="text-danger error-text flatNumber_error"></span>
                                </div>

                                <button class="btn btn-sm btn-success"style="float:right;padding:5px;margin-top:5px;" type="submit">Add occupant</button>
                            </form>
                        </div>
                        
                    </div>
                </div>
            </div>
            <script src="{{asset('datatable/js/jquery.dataTables.min.js')}}"></script>
            <script src="{{asset('datatable/js/dataTables.bootstrap4.min.js')}}"></script>
            <script src="{{asset('sweetalert2/sweetalert2.min.js')}}"></script>
            <script src="{{ asset('toastr/toastr.min.js') }}"></script>
            <script src="{{asset('js/jquery-3.6.0.min.js')}}"></script>
                
            <script type="text/javascript">
           //toastr.options.preventDuplicates = true;
            toastr.options.preventDuplicates = true;
             $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

            $(function(){
                // Add an occupant using Ajax
                $('#createOccupant').on('submit',function(e){
                    e.preventDefault();
                    var form = this;
                    var formData = {
                        name:$('#name').val(),
                        email:$('#email').val(),
                        phone: $('#phone').val(),
                        estate:$('#estate').val(),
                        blockNumber:$('#blockNumber').val(),
                        flatNumber:$('#flatNumber').val()
                    };
                    $.ajax(
                            {
                                url:  "Dashboard/createOccupant",
                                method: 'post',
                                data:formData,
                                headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                success: function (data) {
                                    console.log("data:\n");
                                    console.log(data);
                                    toastr.success(data.msg);
                                },
                                error: function (result) {
                                    console.log(result);   
                                }
                            }
                        )
                    });
                $('#deleteOccupant').on('submit',function(e){
                    
                    $.ajax({
                        url:'Dashboard/deleteOccupant',
                        method:'post',
                        headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        success: function(result){
                            console.log(result);
                        },
                        error:function(result){
                            console.log(result);
                        }
                        
                    })
                });
            });
                   
        </script>
                
    @endsection