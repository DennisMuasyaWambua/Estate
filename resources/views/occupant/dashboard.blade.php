@extends('occupant.occupantTemplate')
    @section('content')
    
    <link rel="stylesheet" href="{{ asset('datatable/css/dataTables.bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('datatable/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{asset('sweetalert2/sweetalert2.min.css')}}">
    <link rel="stylesheet" href="{{asset('toastr/toastr.min.css')}}">   
       <div class="cards">
           <a id="service-charge" class="service-charge" data-bs-toggle="modal"data-bs-target="#serviceChargeModal">
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
                        <button id="clear" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </button>
                    </div>
                    <div class="modal-body">
                        <section id="payment-history">
                                <table class="table" id="history">
                                    <thead class="table-dark">
                                     
                                        <th id="receive">Recepient id</th>
                        
                                        <th id="amount">Amount</th>
                        
                                        <th id="status">Paid at</th>
                                    </thead>
                                    <tbody id="records">
                                      
                                    </tbody>
                                </table>
                        </section>
                        
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
       <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
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
            document.getElementById('service-charge').addEventListener('click',(event)=>{
                event.preventDefault();
                axios.get('Dashboard/paymentHistory').then((response)=>{
                    //display the data on the table 
                    //column variables
                    //document.getElementById('history').remove();
                   
                        
                  
                    
                    console.log(response.data);
                    var myData = response.data;
                    buildTable(myData);
                    function buildTable(data){
                        document.getElementById('clear').addEventListener('click',(event)=>{
                        event.preventDefault();
                            var table = document.getElementById('history');
                             table.innerHTML="";
                             var table = document.getElementById('history');
                                var head = `
                                        <thead class="table-dark">
                                            
                                            <th id="receive">Recepient id</th>
                            
                                            <th id="amount">Amount</th>
                            
                                            <th id="status">Paid at</th>
                                        </thead>
                                    `
                                    table.innerHTML += head;
                           
                        })
                        
                        for(var i=0;i<data.length;i++){
                            
                            var table = document.getElementById('history');
                            
                            var row=`<tr id="records" class="table-dark">
                                    <td>${data[i].receipt_id}</td>
                                    <td>${data[i].amount}</td>
                                    <td>${data[i].created_at}</td>
                                 </tr>
                                `
                               
                                table.innerHTML += row;
                               
                            
                        }
                        
                    }
                   
                  
                    }).catch((error)=>{console.log(error)});

             
            });
       </script>

    @endsection