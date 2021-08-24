@extends('auth.template')
    @section('content')
    <div class="conatiners">
        @if(session('status'))
            <div class="alert alert-success" role="alert">
                {{session('status')}}
            </div>
        @endif
            
            <form method="POST" action="{{route('password.request')}}">
                @csrf
                <input type="hidden" name="token" value="{{$request->route('token')}}">
            <img src="{{asset('images/smart1.jpeg')}}" style="border-radius: 150px; width:200px;height:200px;" >
            <div class="login-title"><p>SMART ESTATE</p><p>reset Password</p></div>
                
                <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control @error('name') is-invalid @enderror" placeholder="Email address">
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
                        
                        <input name="login" id="login" class="btn btn-block login-btn mb-4" type="submit" value="Update">
                        <a id="register-link" href="/register"><small>Joining us today?</small></a>
               
            </form>
       
    </div>
    @endsection