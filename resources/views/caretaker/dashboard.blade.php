@extends('caretaker.caretakerTemplate')
   
    @section('content')
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('datatable/css/dataTables.bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('datatable/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{asset('sweetalert2/sweetalert2.min.css')}}">
    <link rel="stylesheet" href="{{asset('toastr/toastr.min.css')}}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.1/dist/chart.min.js"></script> 
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
                <form action="{{route('Dashboard.accountDetails')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="account-number">Account Number</label>
                        <input class="form-control" type="text" name="accountNumber" placeholder="Account Number">
                    </div>
                    <div class="form-group">
                        <label for="paybill-number">Paybill Number</label>
                        <input class="form-control" type="text" name="paybillNumber" placeholder="Paybill Number">
                    </div>
                    <button type="submit " class="btn btn-sm btn-success" style="margin-top:10px">Set Account details</button>
                    
                </form>
                <form action="{{route('Dashboard.setServiceChargeAmount')}}" method="POST">
                    @csrf
                     <div class="form-group">
                         <label for="service_amount">Service Charge Amount</label>
                         <input class="form-control"type="number" name="service_amount" placeholder="service charge amount">
                     </div>
                     <button class="btn btn-sm btn-success" type="submit" style="margin-top:10px">Set amount</button>
                </form>
            <ul>
                    <li class="nav-item"><a href="{{ route('logout') }}" class="nav-link underline"onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a></li>
            </ul>
           
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
                        data-bs-target="#serviceChargePaymentData"
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
                        data-bs-target="#dead"
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
                                                
                                                @foreach($occupant as $Occupant)
                                                
                                                <tr>
                                                    <td>{{$Occupant['id']}}</td>
                                                    <td>{{$Occupant['name']}}</td>
                                                    <td>{{$Occupant['email']}}</td>
                                                    <td>{{$Occupant['phone']}}</td>
                                                    <td>{{$Occupant['estate']}}</td>
                                                    <td>{{$Occupant['blockNumber']}}</td>
                                                    <td>{{$Occupant['flatNumber']}}</td>
                                                    <td>
                                                        <a id="updateButton"href="{{route('Dashboard.editOccupant',$Occupant->id)}}"value="{{$Occupant->id}}"class="btn btn-sm btn-primary" data-id="'.$Occupant['id'].'"type="button" >Update</a>
                                                        <!-- <a id="deleteButton"href="{{route('Dashboard.editOccupant',$Occupant->id)}}" class="btn btn-sm btn-danger" type="button"value="{{$Occupant->id}}" >Delete</a> -->
                                                        <button class="btn btn-sm btn-danger" onclick="event.preventDefault();document.getElementById('delete-occupant-form-{{$Occupant->id}}').submit()">Delete</button>
                                                        <form id="delete-occupant-form-{{$Occupant->id}}" action="{{route('Dashboard.deleteOccupant',$Occupant->id)}}"method="POST" style="display:none;">@csrf</form>
                                                    </td>
                                                    <!-- update modal -->
                                                    <div class="modal fade" id="update" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLongTitle">update</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                       <!-- this is the update form modal -->
                                                                       <div class="update-person">
                                                                    <form id="update-occupant-form-{{$Occupant->id}}" action="{{route('Dashboard.updateOccupant',$Occupant->id)}}" method="POST">
                                                                        @csrf
                                                                        <div class="update-person">
                                                                            <div class="form-group">
                                                                                    <input id="occupant-{{$Occupant->id}}" hidden="true" value="{{$Occupant->id}}" name="Occupantid"/>
                                                                                    <input hidden="true" value="{{auth()->user()->id}}" name="caretakerId">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="name">Name</label>
                                                                                <input id="occupant-name-{{$Occupant->id}}"   class="form-control" value="{{$Occupant->name}}" type="text" name="name" placeholder="Occupant's name" autofocus>
                                                                                <span class="text-danger error-text name_error"></span>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="email">Email</label>
                                                                                <input id="occupant-email-{{$Occupant->id}}"  class="form-control"value="{{$Occupant->email}}" type="email" name="email" placeholder="email" >
                                                                                <span class="text-danger error-text email_error"></span>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="phone">Phone</label>
                                                                                <input id="occupant-phone-{{$Occupant->id}}" class="form-control" value="{{$Occupant->phone}}" type="number" name="phone" placeholder="phone" >
                                                                                <span class="text-danger error-text phone_error"></span>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="estate">Estate</label>
                                                                                <input id="occupant-estate-{{$Occupant->id}}"  class="form-control" value="{{$Occupant->estate}}" type="text" name="estate" placeholder="estate" >
                                                                                <span class="text-danger error-text estate_error"></span>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="blockNumber">Block Number</label>
                                                                                <input id="occupant-blockNumber-{{$Occupant->id}}"  class="form-control" value="{{$Occupant->blockNumber}}"type="text" name="blockNumber" placeholder="block number" >
                                                                                <span class="text-danger error-text blockNumber_error"></span>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="flatNumber">Flat Number</label>
                                                                                <input id="occupant-flatNumber-{{$Occupant->id}}"  class="form-control" value="{{$Occupant->flatNumber}}" type="text" name="flatNumber" placeholder="flat number" >
                                                                                <span class="text-danger error-text flatNumber_error"></span>
                                                                            </div>
                                                                            <button  style="float:right; " class="btn btn-sm btn-primary" type="submit">Update</button>
                                                                    </form>
                                                                </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> 
                                                            
                                                                    <!-- <button type="button" class="btn btn-sm btn-danger"onclick="event.preventDefault();document.getElementById('delete-occupant-form-{{$Occupant->id}}').submit()">Delete</button>
                                                                    <form id="delete-occupant-form-{{$Occupant->id}}" action="{{route('Dashboard.deleteOccupant',$Occupant->id)}}"method="POST" style="display:none;">@csrf</form> -->
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                   
                                                        
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
                                                                    <P>Are you sure that you want to delete <span class="person"></span> </P>    
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    <a class="btn btn-sm btn-danger" type="button" href="{{route('Dashboard.deleteOccupant',$Occupant->id)}}">Delete</a>
                                                                    <!-- <button type="button" class="btn btn-sm btn-danger"onclick="event.preventDefault();document.getElementById('delete-occupant-form-{{$Occupant->id}}').submit()">Delete</button>
                                                                    <form id="delete-occupant-form-{{$Occupant->id}}" action="{{route('Dashboard.deleteOccupant',$Occupant->id)}}"method="POST" style="display:none;">@csrf</form> -->
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                </tr>
                                            @endforeach
                                            <!-- modals -->
                                                    <!-- update modal -->
                                                   
                                                    <!-- Delete Moodal -->
                                                   
                                                                                 
                                        </tbody>
                                        
                                    </table>
                                    
                                    {{$occupant->links()}}
                               
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
            <!-- register new occupant as a user with a role -->
            <form id="official-occupant" class="official-occupant" style="display:none;" class="form-floating" method="POST" action="{{route('register')}}">
                @csrf
                <img src="{{asset('images/smart1.jpeg')}}" style="border-radius: 150px; width:100px;height:100px;" >
                <div class="login-title">
                    <p>SMART ESTATE</p>
                    <p>Create your account</p>
                </div>
                        
                <div class="form-group">
                    <label class="form-control" for="name"  id="name" >Name</label>
                    <input id="new-occupant-name" name="name" type="text" class="form-control is-invalid" placeholder="Name"  autofocus> 
                    @error('name')
                        <span class="invalid-feedback is-invalid" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>

                <div class="form-group">
                    <label class="form-control" for="email"  id="email" >Email</label>
                    <input id="new-occupant-email" name="email" type="email" class="form-control is-invalid" placeholder="Email"> 
                    @error('email')
                        <span class="invalid-feedback is-invalid" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-control" for="password"  id="password" >Password</label>
                    <input id="new-occupant-password" name="password" type="password" class="form-control is-invalid" placeholder="Password" >
                    @error('password')
                        <span class="invalid-feedback is-invalid" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
    
                </div>

                <div class="form-group">
                    <label class="form-control" for="password"  id="password-confirm" >Confirm Password</label>
                    <input id="new-occupant-confirm-password" name="password_confirmation" type="password" class="form-control is-invalid" placeholder="Confirm Password"  required autocomplete="new-password">
                    @error('password-confirm')
                        <span class="invalid-feedback is-invalid" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="role_id" class="form-control" id="role_id">Register As:
                        <select name="role_id" id="caretaker-role">
                            <option value="occupant">occupant</option>
                        </select>
                    </label>
                </div>
                <input name="register" id="register" class="btn btn-block login-btn mb-4" type="submit" value="Register">
                <div class="redirection">
                    <a href="#!" class="forgot-password-link">Forgot password?</a>
                    <small><p class="login-card-footer-text">Alredy have an account? <a href="{{ route('login') }}" class="text-reset"id="register-login">Login here</a></p></small>
                </div>
            
            </form>

            <!-- reading payment data from the occupants -->
            <div class="modal fade" id="serviceChargePaymentData" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Service Charge Payment </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" width="50%" height="50%">
                            
                                <div id="totalPaid">
                                    <small>Total paid : </small>
                                    <small id="paidValue"></small>
                                    <form action="{{route('Dashboard.payments')}}" method="GET" id="getPayments"></form>
                                </div>
                                <div id="totalUnpaid">
                                    <small>Total unpaid : </small>
                                    <small id="unpaidValue"></small>
                                </div>

                                <canvas id="mychart" ></canvas>
                        </div>
                        
                    </div>
                </div>
            </div>

            <!-- payment date setter -->
            <div class="modal fade" id="dead" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Deadline Setter </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            
                                
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
                                    toastr.success("user created successfully");
                                    $('#addOccupant').modal('hide');
                                },
                                error: function (result) {
                                    console.log(result);   
                                }
                            }
                        )
                    });
                    
                    
                });
            $('#service-charge').on('click',function(e){
                      e.preventDefault();
            
                    $.ajax({
                        url:  "Dashboard/payments",
                        method: 'get',
                        headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        success: function (data) {
                            console.log("data:\n");
                            console.log(data);
                         let paid =   $('#paidValue').html(data);                                    
                        },
                        error: function (result) {
                            console.log(result);   
                        }
                    });
                    $.ajax({
                        url:  "Dashboard/pending",
                        method: 'get',
                        headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        success: function (data) {
                            console.log("data:\n");
                            console.log(data);
                          let unpaid =  $('#unpaidValue').html(data);                                       
                        },
                        error: function (result) {
                            console.log(result);   
                        }
                    });

                    //creating a chart to represent the data 
                    $.ajax({
                        url:"Dashboard/accounts",
                        method:'get',
                        headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        success: function(data){
                            console.log(data);
                            //chart.js
                            let mychart = document.getElementById('mychart').getContext('2d');
                            let popChart = new Chart(mychart,{
                                type:'pie',
                                data:{
                                    labels:['paid','unpaid'],
                                    datasets:[{
                                        label:'Accounts',
                                        data:[data.paid,data.unpaid],
                                        backgroundColor:['green','red']
                                    }],
                                   
                                },
                                options:{
                                    title:{
                                        display:true,
                                        text:'Service Charge  accounts'
                                    }
                                }
                            });
                        },
                        error:function(result){
                            console.log(result);
                        }
                    });
            });
      
                   
        </script>
                
    @endsection