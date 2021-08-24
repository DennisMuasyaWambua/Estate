@extends('auth.template')
    @section('content')
        <form class="form-floating" method="POST" action="{{route('register')}}">
            @csrf
            <img src="{{asset('images/smart1.jpeg')}}" style="border-radius: 150px; width:100px;height:100px;" >
            <div class="login-title">
                <p>SMART ESTATE</p>
                <p>Create your account</p>
            </div>
                    
            <div class="form-group">
                <label class="form-control" for="name"  id="name" >Name</label>
                <input name="name" type="text" class="form-control is-invalid" placeholder="Name"  autofocus> 
                @error('name')
                    <span class="invalid-feedback is-invalid" role="alert">
                        <strong>{{ $message }}</strong>
                     </span>
                @enderror

            </div>

            <div class="form-group">
                <label class="form-control" for="email"  id="email" >Email</label>
                <input name="email" type="email" class="form-control is-invalid" placeholder="Email"> 
                @error('email')
                    <span class="invalid-feedback is-invalid" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-control" for="password"  id="password" >Password</label>
                <input name="password" type="password" class="form-control is-invalid" placeholder="Password" >
                @error('password')
                    <span class="invalid-feedback is-invalid" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
 
            </div>

            <div class="form-group">
                <label class="form-control" for="password"  id="password-confirm" >Confirm Password</label>
                <input name="password_confirmation" type="password" class="form-control is-invalid" placeholder="Confirm Password"  required autocomplete="new-password">
                @error('password-confirm')
                    <span class="invalid-feedback is-invalid" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="role_id" class="form-control" id="role_id">Register As:
                    <select name="role_id" id="caretaker-role">
                        <option value="user">user</option>
                        <option value="occupant">occupant</option>
                        <option value="caretaker">caretaker</option>
                    </select>
                </label>
            </div>
            <input name="register" id="register" class="btn btn-block login-btn mb-4" type="submit" value="Register">
            <div class="redirection">
                <a href="#!" class="forgot-password-link">Forgot password?</a>
                <small><p class="login-card-footer-text">Alredy have an account? <a href="{{ route('login') }}" class="text-reset"id="register-login">Login here</a></p></small>
            </div>
            
        </form>
    @endsection