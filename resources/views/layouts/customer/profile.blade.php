@extends('layouts.master2')
@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-2 border-end">
                <div class="d-grid gap-2">
                    <a href="{{ route('account.index') }}" role="button" class="btn btn-primary mb-3">Account Settings</a>
                    <a href="{{ route('account.orders') }}" role="button" class="btn btn-light mb-3">My Orders</a>
                    <a href="{{ route('account.address') }}" role="button" class="btn btn-light mb-3">Address</a>
                </div>
            </div>
            <div class="col">
                <form method="post" action="{{ route('account.update', $user->id) }}">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="update_for" value="profile" />
                    <div class="row mb-3">
                        <div class="col-sm-6 mb-3">
                            <label class="mb-1">Email Address<span class="text-danger">*</span></label>
                            <input class="form-control form-control-lg" type="email" name="email" value="{{ old('email') ? old('email') : $user->email }}" readonly placeholder="Enter your Email Address" />
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
                                <option value="male" {{ ((old('gender') && old('gender') == $user->gender) || $user->gender == 'male') ? 'selected': '' }}>Male</option>
                                <option value="female" {{ ((old('gender') && old('gender') == $user->gender) || $user->gender == 'female') ? 'selected': '' }}>Female</option>
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
                    </div>
                    <div class="text-end mt-3">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection