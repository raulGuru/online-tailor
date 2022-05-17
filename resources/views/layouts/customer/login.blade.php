<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="">
    <title>Customize Tailor</title>
    <link class="js-stylesheet" href="{{ asset('public/assets/css/light.css') }}" rel="stylesheet">
    <link class="js-stylesheet" href="{{ asset('public/assets/css/style.css') }}" rel="stylesheet">
</head>

<body>
    <main class="d-flex w-100 h-100 bg-container">
        <div class="container d-flex flex-column">
            <div class="row vh-100">
                <div class="col-sm-10 col-md-5 col-lg-5 mx-auto d-table h-100">
                    <div class="d-table-cell align-middle">
                        <div class="card">
                            <div class="card-body">
                                <div class="text-center logo">
                                    <a href="{{ route('index') }}"><img src="{{ asset('public/assets/img/logo.jpg') }}" alt="logo"></a>
                                </div>
                                <h4 class="mb-3 font-weight-600"> Login </h4>
                                <form method="post" action="{{ route('login.store') }}">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="mb-1">Email</label>
                                        <input class="form-control form-control-lg" type="email" name="email" placeholder="Enter your email" />
                                        @error('email')
                                            <div class="small text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-2">
                                        <label class="mb-1">Password</label>
                                        <input class="form-control form-control-lg" type="password" name="password" placeholder="Enter your password" />
                                        @error('password')
                                            <div class="small text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 text-end">
                                            <a href="#" class="text-black f-12">Forgot password?</a>
                                        </div>
                                        @if(session()->has('error'))
                                            <div class="col-sm-12 mt-2">
                                                <div class="text-danger">
                                                    {{ session()->get('error') }}
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                    </div>
                                    <div class="text-center mt-3">
                                        <button type="submit" class="btn btn-primary text-white btn-blue">Sign in</button>
                                        <a href="{{ route('signup.index') }}" class="text-black f-12 text-end ml-3">Sign Up ?</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="{{ asset('public/assets/js/app.js') }}"></script>
</body>

</html>
