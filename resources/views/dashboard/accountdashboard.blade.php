@extends('dashboard.dashboardTemplate')
    @section('content')
        <section class="hero-section">
            <div class="card-grid">
                <a class="card-caretaker" href="/caretaker">
                    <div class="card__background" style="background-image:url({{url('images/lap.jpg')}});positon:absolute;right:0;top:0;background-size:cover;background-position:center;background-repeat:no-repeat;" >
                        <div class="card__content">
                           <h3 class="card__heading">Care taker</h3>
                        </div>
                    </div>
                </a>
                <a class="card-user" href="/user">
                    <div class="card__background" style="background-image:url({{url('images/smile.jpg')}});">
                        <div class="card__content">
                           <h3 class="card__heading">User</h3>
                        </div>
                    </div>
                </a>
            </div>
        </section>
    @endsection