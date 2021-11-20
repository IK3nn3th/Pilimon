<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">

  <title>Pilimon</title>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

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
                    <h3 class="title is-size-3-mobile is-size-1-desktop">PILIMON</h3>
                    <hr class="login-hr">
                    <p class="subtitle has-text-centered has-text-white">Create an account.</p>
                    <div class="box">
                        <figure class="avatar">
                            <img src="/images/P.png">
                        </figure>
                            <form action="{{ route('register') }}" method="POST">
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
                                  <p>First Name</p>          
                                  <input id="fname" type="text" class="input @error('name') is-invalid @enderror" name="fname" value="{{ old('fname') }}" required autocomplete="fname" placeholder="First name" autofocus>

                                      @error('fname')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                      @enderror
                                </div>
                              </div>
                              <div class="field">
                                <div class="control">
                                  <p>Last Name</p>          
                                  <input id="lname" type="text" class="input @error('name') is-invalid @enderror" name="lname" value="{{ old('lname') }}" required autocomplete="lname" placeholder="Last name"  autofocus>
                                      @error('lname')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                      @enderror
                                </div>
                              </div>
                              <div class="field">
                                <div class="control">
                                  <p>Email Address</p>          
                                  <input id="email" name="email" type="email" class="input  @error('email') is-invalid @enderror" value= "{{ old('email') }}" required placeholder="Email Address" autocomplete="email">
                                   @error('email')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                      @enderror
                                </div>
                              </div>
                              <div class="field">
                                <div class="control">
                                  <p>Password</p>          
                                  <input id="password" name="password" type="password" class="input @error('password') is-invalid @enderror" data-type="password" placeholder="Password" required autocomplete="new-password">
                                  @error('password')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                      @enderror
                                </div>
                              </div>
                              <div class="field">
                                <div class="control">
                                  <p>Confirm Password</p>          
                                  <input id="password_confirmation" name="password_confirmation" type="password" class="input @error('password') is-invalid @enderror" data-type="password" placeholder="Confirm Password" required autocomplete="new-password">
                                 
                                </div>
                              </div>
                              <button type="submit" class="button is-block is-large is-fullwidth has-text-white"><span class="icon-text">
                              <span class="icon">
                                        <strong>Sign up </strong>&nbsp;
                              <i class="material-icons">border_color</i>
                                            </span> 
                                            </span>
                              </button>
                            </form>
                    </div>
                  <p class="has-text-white has-text-centered">
                    <a class = "subtitle has-text-white" href="{{route('login')}}">Already Member? Sign in here!</a>
                  </p>
                </div>
            </div>
        </div>
</section>
      
  
</body>
</html>