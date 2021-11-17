
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">

  <title>Pilimon</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet"> -->
    <link href="https://fonts.googleapis.com/css?family=Questrial&display=swap" rel="stylesheet">
    <!-- Bulma CSS -->	
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <!-- Bulma Version 0.9.0-->
    <link rel="stylesheet" href="https://unpkg.com/bulma@0.9.0/css/bulma.min.css" />
    <link rel="stylesheet" type="text/css" href="/css/login.css">
</head>
<body>
    <section class="hero is-fullheight">
        <div class="hero-body">
            <div class="container has-text-centered">
                <div class="column is-4 is-offset-4">
                    <h3 class="title">PILIMON</h3>
                    <hr class="login-hr">
                    <p class="subtitle">Please login to proceed.</p>
                    <div class="box">
                        <figure class="avatar">
                            <img src="images/P.png">
                        </figure>
                        <form action= "{{ route('login') }}"  method= "POST" >
                           @csrf
                           <div>
                              @if(Session::get('error'))
                                          <div class="alert alert-danger" role="alert">
                                              <strong class= has-text-danger>{{Session::get('error')}}</strong>
                                              
                                            </div><br><br>
                              @endif
                          </div>
                            <div class="field">
                                <div class="control">
                                    <input  name="email"  id="email" class="input is-medium is-success" value="{{ old('email') }}" type="email"   required  autocomplete="email" placeholder="Your Email" autofocus>
                                </div>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="field">
                                <div class="control">
                                    <input name="password" id="password" type ="password" class="input is-medium is-success"   required  placeholder="Your Password"  autocomplete="current-password">
                                </div>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                            <button type="submit" class="button is-block is-large is-fullwidth has-text-white" >Login <i class="fa fa-sign-in" aria-hidden="true"></i></button>
                        
                    </div>
                    </form>
                    <p class=" ">
                        <a class =" title is-4 has-text-white " href="{{route('register')}}">Sign Up</a>
                    </p>
                </div>
            </div>
        </div>
    </section>
   
</body>

</html>