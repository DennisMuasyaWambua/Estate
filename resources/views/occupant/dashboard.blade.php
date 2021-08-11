@extends('caretaker.caretakerTemplate')
@section('content')
        @include('partials.navbar')
        <div class="container">
            <div class="cards">
                <div class="service-charge-payment-history">
                    <div id="charge-history">
                        <a class="service-charge"data-bs-toggle="modal"data-bs-target="#rentserviceModal">
                            <div class="service-charge-accounts-overlay"></div>
                            <div class="service-charge-accounts-circle">
                            <img src="{{asset('images/payment-history.png')}}" alt="" />
                            <p>Service charge payment history</p>
                       
                        </a>
                    </div>
                </div>
                <div class="pay-service-charge">
                    <div id="pay">

                    </div>
                </div>
            </div>
        </div>
@endsection