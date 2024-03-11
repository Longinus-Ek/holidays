<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login - holiday</title>
    <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="/login_assets/css/login.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet"/>
</head>

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<body>
<main>
    <div class="imagem-login">
        <div class="login-holiday my-auto">
            <form method="POST" action="{{ route('login') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <div class="col-12">
                    <div class="form-group">
                        <label for="username">E-mail</label>
                        <input type="text" name="email" id="username" class="form-control"
                               placeholder="yours@emails.com">
                        @if ($errors)
                            <span class="text-danger row" style="padding-left: 20px">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group mb-4">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control"
                               placeholder="********">
                        @if ($errors)
                            <span class="text-danger row" style="padding-left: 20px">{{ $errors->first('password') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-12 d-flex justify-content-center">
                    <button class="btn btn-success w-100" type="submit">Fazer Login</button>
                </div>
                <div class="mt-2">
                    @if(Session::get('success'))
                        <div class="alert alert-success" role="alert">
                            <i class="fas fa-check"></i> {{session('success')}}
                        </div>
                    @endif

                    @if(Session::get('error'))
                        <div class="alert alert-danger" role="alert">
                            <i class="fas fa-exclamation"></i> {{session('error')}}
                        </div>
                    @endif
                </div>
            </form>
        </div>
    </div>
</main>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" defer></script>
<script src="{{ asset('js/jquery-3.6.0.min.js')}}"></script>
<script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('js/chart.js') }}"></script>
<script src="{{ asset('js/FoxAlert.js') }}"></script>

<style>
    .imagem-login {
        width: 100%;
        height: 100vh;
        background-image: url('{{ asset('/img/holiday.jpeg')}}');
        background-size: cover;
        background-position: center;
    }
    .login-holiday {
        width: 30%;
        min-width: 320px;
        max-width: 550px;
        height: auto;
        padding: 30px;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%); 
        background: linear-gradient(to bottom, rgba(228, 228, 228, 0.1) 30%, rgba(101, 192, 255, 1));
        border-radius: 40px;
        border: 20px;
    }
    .img-holiday {
        width: 200px;
    }
    @media (max-height: 550px){
        .img-holiday {
            width: 120px;
        }
    }
    @media (max-height: 500px){
        .img-holiday {
            width: 80px;
        }
    }
    @media (max-height: 499px){
        .img-holiday {
            width: 0px;
        }
    }
</style>

<script>
    $(document).ready(function () {

        $("#login").on("click", function() {
            $("form").submit()
            $(this).attr("disabled", "disabled");
            $(this).val("Logando...");
            doWork(); //this method contains your logic
        });

    });

    function doWork() {
        $(this).val("Fazer login");
        setTimeout('$("#login").removeAttr("disabled")', 5500);
    }

</script>

</body>

</html>
