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
    
    <label for="tab-2" class="tab">Sign Up</label>
    <div class="login-form">
      <form class="sign-up-htm" action="{{ route('register') }}" method="POST">
        @csrf
        <div class="group">
        <label for="fname" class="label">{{ __('First Name') }}</label>

           
                           <input id="fname" type="text" class="input @error('name') is-invalid @enderror" name="fname" value="{{ old('fname') }}" required autocomplete="fname" autofocus>

                @error('fname')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
           
        </div>

        <div class="group">
        <label for="lname" class="label">{{ __('Last Name') }}</label>

           
                           <input id="lname" type="text" class="input @error('name') is-invalid @enderror" name="lname" value="{{ old('lname') }}" required autocomplete="lname" autofocus>

                @error('lname')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            
        </div>

        <div class="group">
          <label for="user" class="label">Email address</label>
          <input id="email" name="email" type="email" class="input  @error('email') is-invalid @enderror" value= "{{ old('email') }}" required autocomplete="email">
          @error('email')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
          @enderror

        </div>
        <div class="group">
          <label for="password" class="label">Password</label>
          <input id="password" name="password" type="password" class="input @error('password') is-invalid @enderror" data-type="password"  required autocomplete="new-password">
          @error('password')
            <span class="invalid-feedback" role="alert">
                 <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
        <div class="group">
          <label for="password-confirm" class="label">Confirm Password</label>
          <input id="password-confirm" type="password" name="password_confirmation" class="input" data-type="password" required autocomplete="new-password">
        </div>
        <div class="group">
          <input type="submit" class="button" value="Sign Up">
        <div class="hr"></div>
        <div class="foot-lnk">
       
        <a href="{{route('login')}}">Already Member?Sign in here!</a>
        </div>
      </form>
    </div>
  </div>
</div>
  
  
</body>
</html>