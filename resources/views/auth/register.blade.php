@extends('auth.template')
    @section('content')
        <div class="container d-flex justify-content-center" style="width:auto;">
            <form class="" method="POST" action="{{route('register')}}">
                @csrf
                <img src="{{asset('images/smart1.jpeg')}}" style="border-radius: 150px; width:100px;height:88px; text-align:center" >
                <div class="login-title">
                    <p>SMART ESTATE</p>
                    <p>Create your account</p>
                </div>
                        
                <div class="form-group d-flex justify-content-center">
                    <label class="sr-only" for="name"  id="name" >Name <br></label>
                    <input name="name" type="text" class="form-control is-invalid" placeholder="Name"  autofocus> 
                    @error('name')
                        <span class="invalid-feedback is-invalid" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>

                <div class="form-group d-flex justify-content-center">
                    <label class="sr-only" for="email"  id="email" >Email <br></label>
                    <input name="email" type="email" class="form-control is-invalid" placeholder="Email"> 
                    @error('email')
                        <span class="invalid-feedback is-invalid" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group d-flex justify-content-center">
                    <label class="sr-only" for="password"  id="password" >Password <br></label>
                    <input name="password" type="password" class="form-control is-invalid" placeholder="Password" >
                    @error('password')
                        <span class="invalid-feedback is-invalid" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
    
                </div>

                <div class="form-group d-flex justify-content-center">
                    <label class="sr-only" for="password"  id="password-confirm" >Confirm Password <br></label>
                    <input name="password_confirmation" type="password" class="form-control is-invalid" placeholder="Confirm Password"  required autocomplete="new-password">
                    @error('password-confirm')
                        <span class="invalid-feedback is-invalid" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group d-flex justify-content-center" >
                    <label for="role_id" class="form-control" id="role_id"style="width:auto;">Register As:
                        <select name="role_id" id="caretaker-role">
                            <option value="admin">admin</option>
                            <option value="user">user</option>
                            <option value="occupant">occupant</option>
                            <option value="caretaker">caretaker</option>
                            <option value="landlord">landlord</option>
                        </select>
                    </label>
                </div>
                <div class="mx-auto d-flex justify-content-center">
                <input name="register" id="register" class="btn btn-block login-btn mb-4 " type="submit" value="Register">
                </div>
                
                <div class="redirection">
                    <a href="#!" class="form-link">Forgot password? </a>
                    <small><p class="login-card-footer-text">Alredy have an account? <a href="{{ route('login') }}" class="text-reset"id="register-login">Login here</a></p></small>
                </div>
                
            </form>
        </div>
    @endsection