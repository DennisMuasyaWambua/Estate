@extends('occupant.occupantTemplate')
    @section('content')
    
    <link rel="stylesheet" href="{{ asset('datatable/css/dataTables.bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('datatable/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{asset('sweetalert2/sweetalert2.min.css')}}">
    <link rel="stylesheet" href="{{asset('toastr/toastr.min.css')}}">   
       <div class="cards">
           <a class="service-charge" data-bs-toggle="modal"data-bs-target="#serviceChargeModal">
               <div class="service-overlay"></div>
                <div class="service-circle">
                    <img src="{{asset('images/payment-history.png')}}" alt=""/>
                    <p>Payment History</p>
                </div>
           </a>
           <a
            id="pay"
            class="pay"
            data-bs-toggle="modal"
            data-bs-target="#serviceChargePaymentModal"
           >
            <div class="pays-overlay"></div>
            <div class="pay-circle">
            <img src="{{asset('images/payment.png')}}" alt="" />
            <p>Service Charge</p>
            </div>  
        </a>
       
       
            <!-- payment history modal -->
            <div class="modal fade" id="serviceChargeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Payments made</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </button>
                    </div>
                    <div class="modal-body">
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                    </div>
                </div>
            </div>

            <!-- service charge payment modal -->
            <div class="modal fade" id="serviceChargePaymentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Pay Service Charge</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                       
                        </button>
                    </div>
                    <div class="modal-body">
                            <form action="">
                                <div class="form-group">
                                   <form action="">
                                            @csrf
                                            <div class="form-group">
                                                <label for="phone">Phone</label>
                                                <input type="number" name="phone" class="form-control" id="phone">
                                            </div>
                                            <div class="form-group">
                                                <label for="amount">Amount</label>
                                                <input type="number" name="amount" class="form-control" id="amount">
                                            </div>
                                            <div class="form-group">
                                                <label for="account">Account</label>
                                                <input type="text" name="account" class="form-control" id="account">
                                            </div>
                                            
                                            <button id="prompt" style="float:right;" class="btn btn-primary">Pay Service Charge</button>
                                   </form>
                                  
                                </div>
                            </form>
                    </div>
                    
                    </div>
                </div>
            </div>
            
       </div>
            <script src="{{asset('datatable/js/jquery.dataTables.min.js')}}"></script>
            <script src="{{asset('datatable/js/dataTables.bootstrap4.min.js')}}"></script>
            <script src="{{asset('sweetalert2/sweetalert2.min.js')}}"></script>
            <script src="{{ asset('toastr/toastr.min.js') }}"></script>
            <script src="{{asset('js/jquery-3.6.0.min.js')}}"></script>
       <script>
            
           
           //to get access token
           document.getElementById('pay').addEventListener('click',(event)=>{event.preventDefault()
                axios.get('/getAcccessToken',{}).then((response)=>{console.log(response.data);}).catch((error)=>{console.log(error);})
                 

           })

     

            //make stk push
            document.getElementById('prompt').addEventListener('click',(event)=>{
                event.preventDefault()
                
                const requestBody = {
                    phone: document.getElementById('phone').value,
                    amount: document.getElementById('amount').value,
                    account: document.getElementById('account').value
                    
                };
                
               


                axios.post('/stkpush',requestBody)
                .then(
                    (response)=>{
                        console.log(response);
                        console.log(response.data.CheckoutRequestID);
                        const id = response.data.CheckoutRequestID;
                        // {{session()->put('checkoutID','id')}}
                        console.log(response.data);
                       
                        toastr.success("request made successfully check your phone");
                        
                    }
                    )
                .catch(
                        (error)=>{console.log(error);
                            toastr.error("please check your network");
                        })
            })
       </script>
    @endsection