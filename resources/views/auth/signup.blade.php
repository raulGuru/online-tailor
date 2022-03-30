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
    <link class="js-stylesheet" href="{{ asset('assets/css/light.css') }}" rel="stylesheet">
    <link class="js-stylesheet" href="{{ asset('assets/css/styles.css') }}" rel="stylesheet">
</head>

<body>
    <main class="d-flex w-100 h-100 bg-container">
        <div class="container d-flex flex-column">
            <div class="row vh-100">
                <div class="col-sm-12 col-md-5 col-lg-7 mx-auto d-table h-100">
                    <div class="d-table-cell align-middle">
                        <div class="card">
                            <div class="card-body">
                                <div class="text-center logo">
                                    <img src="{{ asset('assets/img/logo.jpg') }}" alt="logo">
                                </div>
                                <h4 class="mb-3 font-weight-600"> Sign Up </h4>
                                <form method="post" action="{{ route('signup.store') }}">
                                    @csrf
                                    <div class="row mb-3">
                                        <div class="col-sm-6 mb-3">
                                            <label class="mb-1">First Name</label>
                                            <input class="form-control form-control-lg @error('first_name') border-danger @enderror" type="text" name="first_name" value="{{ old('first_name') }}" placeholder="Enter your First Name" />
                                            @error('first_name')
                                                <span class="alert alert-danger alert-dismissible mt-1">
                                                    <div class="alert-message p-0">
                                                        {{ $message }}
                                                    </div>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-sm-6 mb-3">
                                            <label class="mb-1">Last Name</label>
                                            <input class="form-control form-control-lg @error('last_name') border-danger @enderror" type="text" name="last_name" value="{{ old('last_name') }}" placeholder="Enter your Last Name" />
                                            @error('first_name')
                                                <span class="alert alert-danger alert-dismissible mt-1">
                                                    <div class="alert-message p-0">
                                                        {{ $message }}
                                                    </div>
                                                </span>
                                            @enderror
                                        </div>
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
                                        <div class="col-sm-12 mb-3">
                                            <label class="mb-1">Address line</label>
                                            <textarea class="form-control form-control-lg" name="address" placeholder="Enter your Address line">{{ old('address') }}</textarea>
                                            @error('address')
                                                <span class="alert alert-danger alert-dismissible mt-1">
                                                    <div class="alert-message p-0">
                                                        {{ $message }}
                                                    </div>
                                                </span>
                                            @enderror
                                        </div>
                                        
                                    </div>
                                    <div class="text-center mt-3">
                                        <button type="submit" class="btn sign-btn text-white btn-blue">Sign up</button>
                                    </div>
                                    <div class="text-center mt-3">
                                        <p class="m-0">Already have an account? <a class="text-black" href="{{ route('login.index') }}">Login</a></p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="{{ asset('assets/js/app.js') }}"></script>
</body>

</html>