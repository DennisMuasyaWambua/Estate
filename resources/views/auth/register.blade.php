@extends('auth.template')
    @section('content')
        <form id="registration-form-main" class="form-floating" method="POST" action="{{route('register')}}">
            @csrf
</br>
            <img id="smart-image-logo" src="{{asset('images/smart1.jpeg')}}" style="border-radius: 150px; width:100px;height:100px; margin-left:43%" >
            <div id="login-title"class="login-title">
                <p>SMART ESTATE</p>
                <p>Create your account</p>
            </div>
                    
            <div class="form-group ">
                <label class="form-control" for="name"  id="name" >Name</label>
                <input id = "name-input"name="name" type="text" class="form-control is-invalid" placeholder="Name"  autofocus> 
                @error('name')
                    <span class="invalid-feedback is-invalid" role="alert">
                        <strong>{{ $message }}</strong>
                     </span>
                @enderror

            </div>

            <div class="form-group">
                <label class="form-control" for="email"  id="email" >Email</label>
                <input id="email-input" name="email" type="email" class="form-control is-invalid" placeholder="Email"> 
                @error('email')
                    <span class="invalid-feedback is-invalid" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-control" for="password"  id="password" >Password</label>
                <input id=password-input name="password" type="password" class="form-control is-invalid" placeholder="Password" >
                @error('password')
                    <span class="invalid-feedback is-invalid" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
 
            </div>

            <div class="form-group">
                <label class="form-control" for="password"  id="password-confirm" >Confirm Password</label>
                <input id="confirmation-input" name="password_confirmation" type="password" class="form-control is-invalid" placeholder="Confirm Password"  required autocomplete="new-password">
                @error('password-confirm')
                    <span class="invalid-feedback is-invalid" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="role_id" class="form-control" id="role_id">Register As:
                    <select name="role_id" id="caretaker-role">
                        <option value="landlord">landlord</option>
                        <option value="caretaker">caretaker</option>
                    </select>
                </label>
            </div>
                </br>
            <input name="register" id="register" class="btn-primary" type="submit" value="Register">
            <div class="redirection">
                </br>
                <small>
                    <p id="login-card-footer-text" class="login-card-footer-text">
                         <a href="{{ route('login') }}" class="text-reset"id="register-login">Login here</a></br>
                         <a href="#!"id ="forgot-password-link" class="forgot-password-link">Forgot password?</a>
                    </p>
                </small>
            </div>
            
        </form>
    @endsection