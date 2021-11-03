
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Pilimon</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

  <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Open+Sans:600'>
  
  <link rel="stylesheet" href="/css/style.css">
      
  
</head>
<body>
<div class="login-wrap">
  <div class="login-html">
    <label for="tab-1" class="tab">Sign In</label>
    <div class="login-form">
      <form class="sign-in-htm" action="{{ route('login') }}" method="POST">
      @csrf
      <div>
      @if(Session::get('error'))
                   <div class="alert alert-danger" role="alert">
                       <strong>{{Session::get('error')}}</strong>
                    </div>
      @endif
      </div>
      <div></br></div>
     
        <div class="group">
          <label for="user" class="label">Email address</label>
          <input id="email" name="email" type="email" class="input @error('email') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="email" autofocus>

          @error('email')
            <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
            </span>
          @enderror

        </div>

        <div class="group">
          <label for="pass" class="label">Password</label>
          <input id="password" name="password" type="password" class="input @error('password') is-invalid @enderror" data-type="password"  required autocomplete="current-password">
          @error('password')
            <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
            </span>
          @enderror

         
        </div>
        <div class="form-group form-check">
        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">
                    {{ __('Remember Me') }}
                </label>
        </div>
        <div class="group">
          <input type="submit" class="button" value="Sign In">
        </div>
        </br>
        <div class="foot-lnk">
          <a href="#forgot">Forgot Password?</a>
        </div>
        <div class="hr"></div>

        <div class="foot-lnk">
          <a href="{{route('register')}}">Not yet registered? Sign up!</a>
        </div>
      </form>
    </div>
  </div>
</div>
  
  
</body>
</html>