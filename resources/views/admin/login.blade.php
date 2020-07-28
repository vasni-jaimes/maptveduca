
<!DOCTYPE html>
<html>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Administrador | MAPtv</title>

        <link href="/admin/css/bootstrap.min.css" rel="stylesheet">
        <link href="/admin/css/animate.css" rel="stylesheet">
        <link href="/admin/css/style.css" rel="stylesheet">

    </head>

    <body class="gray-bg">

        <div class="middle-box text-center loginscreen animated fadeInDown">
            <div>
                <div>
                    <h1 class="logo-name"> 
                        <img src="/site/img/logo-amarillo.png" style="margin-left: -40%;"> 
                    </h1>
                </div>
                <h3>Administrator</h3>
                <form method="POST" class="m-t" role="form" action="{{ route("send.admin.login") }}">
                    @csrf
                    <div class="form-group">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Username" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        
                        @error('email')
                            <span class="invalid-feedback error" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" required autocomplete="current-password">

                        @error('password')
                            <span class="invalid-feedback error" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary block full-width m-b">Login</button>
                    {{-- <a href="#"><small>Forgot password?</small></a> --}}
                </form>
            </div>
        </div>

    </body>

</html>
