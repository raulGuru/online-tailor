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
                <div class="col-sm-12 col-md-6 col-lg-6 mx-auto d-table h-100">
                    <div class="d-table-cell align-middle">
                        <div class="card">
                            <div class="card-body">
                                <div class="text-center logo">
                                    <a href="{{ route('index') }}"><img src="{{ asset('public/assets/img/logo.jpg') }}" alt="logo"></a>
                                </div>
                                <h4 class="mb-3 font-weight-600"> Signup </h4>
                                <form method="post" action="{{ route('signup.store') }}">
                                    @csrf
                                    <div class="row mb-3">
                                        <div class="col-sm-6 mb-3">
                                            <label class="mb-1">Email Address</label>
                                            <input class="form-control form-control-lg" type="email" name="email" value="{{ old('email') }}" placeholder="Enter your Email Address" />
                                            @error('email')
                                                <span class="alert alert-danger alert-dismissible mt-1">
                                                    <div class="alert-message p-0">
                                                        {{ $message }}
                                                    </div>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-sm-6 mb-3">
                                            <label class="mb-1">Gender</label>
                                            <select class="form-control form-control-lg @error('gender') border-danger @enderror" name="gender">
                                                <option value="">Select gender</option>
                                                <option value="male" {{ (old('gender') == 'male' ? 'selected' : '') }}>Male</option>
                                                <option value="female" {{ (old('gender') == 'female' ? 'selected' : '') }}>Female</option>
                                            </select>
                                            @error('gender')
                                                <span class="alert alert-danger alert-dismissible mt-1">
                                                    <div class="alert-message p-0">
                                                        {{ $message }}
                                                    </div>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-sm-6 mb-3">
                                            <label class="mb-1">Password</label>
                                            <input class="form-control form-control-lg" type="password" name="password" placeholder="Enter password" />
                                            @error('password')
                                                <span class="alert alert-danger alert-dismissible mt-1">
                                                    <div class="alert-message p-0">
                                                        {{ $message }}
                                                    </div>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-sm-6 mb-3">
                                            <label class="mb-1">Confirm Password</label>
                                            <input class="form-control form-control-lg" type="password" name="password_confirmation" placeholder="Enter password again" />
                                            @error('password_confirmation')
                                                <span class="alert alert-danger alert-dismissible mt-1">
                                                    <div class="alert-message p-0">
                                                        {{ $message }}
                                                    </div>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-sm-6 mb-3">
                                            <label class="mb-1">Mobile Number</label>
                                            <input class="form-control form-control-lg" type="phone" name="phone" value="{{ old('phone') }}" placeholder="Enter your phone number" />
                                            @error('phone')
                                                <span class="alert alert-danger alert-dismissible mt-1">
                                                    <div class="alert-message p-0">
                                                        {{ $message }}
                                                    </div>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-sm-6 mb-3">
                                            <label class="mb-1">Pin Code</label>
                                            <input class="form-control form-control-lg" type="text" name="pin_code" value="{{ old('pin_code') }}" placeholder="Enter your pin code" />
                                            @error('pin_code')
                                                <span class="alert alert-danger alert-dismissible mt-1">
                                                    <div class="alert-message p-0">
                                                        {{ $message }}
                                                    </div>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="text-center mt-3">
                                        <button type="submit" class="btn btn-primary text-white btn-blue mr-3">Sign Up</button>
                                        <a href="{{ route('login.index') }}" class="text-black f-12 text-end ml-3">Login ?</a>
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
