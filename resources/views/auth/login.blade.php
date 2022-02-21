@extends('auth.template')
    @section('content')
        <div class="container">
            
                <form id="loginForm" method="POST" action="{{route('login')}}">
                    @csrf
                <img class="text-center" src="{{asset('images/smart1.jpeg')}}" style="border-radius: 150%;margin-left:30%;width:40%; height:35% " >
                <div class="login-title"><p>SMART ESTATE</p></div>
                    
                    <div class="form-group">
                                <label for="email" class="sr-only">Email</label>
                                <input type="email" name="email" id="email" class="form-control @error('name') is-invalid @enderror" placeholder="Email address">
                                {{session(['userEmail'=>'email'])}}
                                @error('email')
                                    <span class="invalid-feedback is-invalid" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-4">
                                <label for="password" class="sr-only">Password</label>
                                <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="***********">
                                @error('password')
                                    <span class="invalid-feedback is-invalid" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <input name="login" id="login" class="btn btn-block login-btn mb-4" type="submit" value="Login">
                            <a id="register-link" href="/register"><small>Joining us today?</small></a>

                </form>
           
        </div>
        <script>
           
             document.getElementById("login").addEventListener('click', (event)=>{
                 event.preventDefault();
                 const Data = {
                     email:document.getElementById('email').value,
                     password: document.getElementById('password').value
                 };
                // console.log(Data.email);
                
                 axios.post('/token',Data).then((response)=>{console.log(response.data);}).catch((error)=>{console.log(error);}); 
                

                 document.getElementById('loginForm').submit();
             });
                
                // let see = sessionStorage.getItem('access_token');
                //     console.log(see);
            
            
        </script>
    @endsection