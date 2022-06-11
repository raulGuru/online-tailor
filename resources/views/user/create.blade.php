@extends('layouts.master')
@section('content')
<div class="card">
    <div class="card-body">
        <div class="float-end">
            <a href="{{ route('user.index') }}" class="btn btn-primary" role="button">
               Users
            </a>
         </div>
        <h4 class="mb-3 font-weight-600">New User</h4>
        <form method="post" action="{{ route('user.store') }}">
            @csrf
            <div class="row mb-3">
                <div class="col-sm-6 mb-3">
                    <label class="mb-1">Email Address<span class="text-danger">*</span></label>
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
                    <label class="mb-1">Gender<span class="text-danger">*</span></label>
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
                    <label class="mb-1">Password<span class="text-danger">*</span></label>
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
                    <label class="mb-1">Confirm Password<span class="text-danger">*</span></label>
                    <input class="form-control form-control-lg" type="password" name="password_confirmation" placeholder="Enter password again" />
                    @error('password_confirmation')
                        <span class="alert alert-danger alert-dismissible mt-1">
                            <div class="alert-message p-0">
                                {{ $message }}
                            </div>
                        </span>
                    @enderror
                </div>
                <div class="col-sm-4 mb-3">
                    <label class="mb-1">Mobile Number<span class="text-danger">*</span></label>
                    <input class="form-control form-control-lg" type="phone" name="phone" value="{{ old('phone') }}" placeholder="Enter your phone number" />
                    @error('phone')
                        <span class="alert alert-danger alert-dismissible mt-1">
                            <div class="alert-message p-0">
                                {{ $message }}
                            </div>
                        </span>
                    @enderror
                </div>
                <div class="col-sm-4 mb-3">
                    <label class="mb-1">Pin Code<span class="text-danger">*</span></label>
                    <input class="form-control form-control-lg" type="number" min="0" name="pin_code" value="{{ old('pin_code') }}" placeholder="Enter your pin code" />
                    @error('pin_code')
                        <span class="alert alert-danger alert-dismissible mt-1">
                            <div class="alert-message p-0">
                                {{ $message }}
                            </div>
                        </span>
                    @enderror
                </div>
                <div class="col-sm-4 mb-3">
                    <label class="mb-1">Role<span class="text-danger">*</span></label>
                    <select class="form-control form-control-lg @error('role') border-danger @enderror" name="role">
                        <option value="">Select role</option>
                        @if(!empty($roles))
                            @foreach($roles as $role)
                                <option value="{{ $role }}" {{ (old('role') == $role ? 'selected' : '') }}>{{ $role }}</option>
                            @endforeach
                        @endif
                    </select>
                    @error('role')
                        <span class="alert alert-danger alert-dismissible mt-1">
                            <div class="alert-message p-0">
                                {{ $message }}
                            </div>
                        </span>
                    @enderror
                </div>
                <div class="col-sm-12 mb-3">
                    <p class="mb-3">Status<span class="text-danger">*</span></p>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="status" type="radio" value="active" {{ (old('status') == 'active' ? 'checked' : '') }} id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                          Active
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="status" type="radio" value="inactive" {{ (old('status') == 'inactive' ? 'checked' : '') }} id="flexCheckChecked">
                        <label class="form-check-label" for="flexCheckChecked">
                          Inactive
                        </label>
                    </div>
                    @error('status')
                    <span class="alert alert-danger alert-dismissible mt-1">
                        <div class="alert-message p-0">
                            {{ $message }}
                        </div>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="text-end mt-3">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>
@endsection