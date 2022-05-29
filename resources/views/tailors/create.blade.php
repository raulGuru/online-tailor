@extends('layouts.master')
@section('content')
<div class="card">
    <div class="card-body">
        <div class="float-end">
            <a href="{{ route('tailors.index') }}" class="btn btn-primary" role="button">
               Tailors
            </a>
         </div>
        <h4 class="mb-3 font-weight-600">New tailor</h4>
        <form method="post" action="{{ route('tailors.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="row mb-3">
                <div class="col-sm-3 mb-3">
                    <label class="mb-1">Name <span class="text-danger">*</span></label>
                    <input class="form-control form-control-lg" type="name" name="name" value="{{ old('name') }}" placeholder="Enter tailor name" />
                    @error('name')
                        <span class="alert alert-danger alert-dismissible mt-1">
                            <div class="alert-message p-0">
                                {{ $message }}
                            </div>
                        </span>
                    @enderror
                </div>
                <div class="col-sm-3 mb-3">
                    <label class="mb-1">Shop name <span class="text-danger">*</span></label>
                    <input class="form-control form-control-lg" type="shop_name" name="shop_name" value="{{ old('shop_name') }}" placeholder="Enter tailor's shop name" />
                    @error('shop_name')
                        <span class="alert alert-danger alert-dismissible mt-1">
                            <div class="alert-message p-0">
                                {{ $message }}
                            </div>
                        </span>
                    @enderror
                </div>
                <div class="col-sm-3 mb-3">
                    <label class="mb-1">Location <span class="text-danger">*</span></label>
                    <input class="form-control form-control-lg" type="location" name="location" value="{{ old('location') }}" placeholder="Enter tailor's location" />
                    @error('location')
                        <span class="alert alert-danger alert-dismissible mt-1">
                            <div class="alert-message p-0">
                                {{ $message }}
                            </div>
                        </span>
                    @enderror
                </div>
                <div class="col-sm-3 mb-3">
                    <label class="mb-1">Pin Code <span class="text-danger">*</span></label>
                    <input class="form-control form-control-lg" type="text" name="pin_code" value="{{ old('pin_code') }}" placeholder="Enter tailor's pin code" />
                    @error('pin_code')
                        <span class="alert alert-danger alert-dismissible mt-1">
                            <div class="alert-message p-0">
                                {{ $message }}
                            </div>
                        </span>
                    @enderror
                </div>
                <div class="col-sm-3 mb-3">
                    <label class="mb-1">Email Address</label>
                    <input class="form-control form-control-lg" type="email" name="email" value="{{ old('email') }}" placeholder="Enter  tailor's email Address" />
                    @error('email')
                        <span class="alert alert-danger alert-dismissible mt-1">
                            <div class="alert-message p-0">
                                {{ $message }}
                            </div>
                        </span>
                    @enderror
                </div>
                <div class="col-sm-3 mb-3">
                    <label class="mb-1">Mobile <span class="text-danger">*</span></label>
                    <input class="form-control form-control-lg" type="text" name="mobile" value="{{ old('mobile') }}" placeholder="Enter  tailor's mobile" />
                    @error('mobile')
                        <span class="alert alert-danger alert-dismissible mt-1">
                            <div class="alert-message p-0">
                                {{ $message }}
                            </div>
                        </span>
                    @enderror
                </div>
                <div class="col-sm-3 mb-3">
                    <label class="mb-1">Phone</label>
                    <input class="form-control form-control-lg" type="text" name="phone" value="{{ old('phone') }}" placeholder="Enter tailor's phone" />
                    @error('phone')
                        <span class="alert alert-danger alert-dismissible mt-1">
                            <div class="alert-message p-0">
                                {{ $message }}
                            </div>
                        </span>
                    @enderror
                </div>
                <div class="col-sm-3 mb-3">
                    <label class="mb-1">Commission <span class="text-danger">*</span></label>
                    <input class="form-control form-control-lg" type="number" name="commission" value="{{ old('commission') }}" placeholder="Enter  tailor's commission" />
                    @error('commission')
                        <span class="alert alert-danger alert-dismissible mt-1">
                            <div class="alert-message p-0">
                                {{ $message }}
                            </div>
                        </span>
                    @enderror
                </div>
                <div class="col-sm-12 mb-3">
                    <label class="mb-3">Address <span class="text-danger">*</span></label>
                    <textarea name="address" class="form-control" rows="3" id="address">{{ old('address') }}</textarea>
                    @error('address')
                        <span class="alert alert-danger alert-dismissible mt-1">
                            <div class="alert-message p-0">
                            {{ $message }}
                            </div>
                        </span>
                    @enderror
                </div>
                
                <div class="col-sm-12 mb-3">
                    <p class="mb-3">Services <span class="text-danger">*</span></p>
                    @foreach($services as $key => $service)
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="services[]" type="checkbox" id="service_checkbox_{{ $key }}" value="{{ $service }}">
                            <label class="form-check-label" for="service_checkbox_{{ $key }}">{{ Str::ucfirst($service) }}</label>
                        </div>
                    @endforeach
                    @error('services')
                        <span class="alert alert-danger alert-dismissible mt-1">
                            <div class="alert-message p-0">
                                {{ $message }}
                            </div>
                        </span>
                    @enderror
                </div>
                <div class="col-sm-12 mb-3">
                    <p class="mb-3">Appointment</p>
                    @foreach($appointments as $key => $appointment)
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="appointments[]" type="checkbox" id="appointment_checkbox_{{ $key }}" value="{{ $appointment }}">
                            <label class="form-check-label" for="appointment_checkbox_{{ $key }}">{{ Str::ucfirst($appointment) }}</label>
                        </div>
                    @endforeach
                    @error('appointments')
                        <span class="alert alert-danger alert-dismissible mt-1">
                            <div class="alert-message p-0">
                                {{ $message }}
                            </div>
                        </span>
                    @enderror
                </div>
                <div class="col-sm-6 mb-3">
                    <label class="mb-3">Expertise</label>
                    <textarea name="expertise" class="form-control" rows="3" id="expertise">{{ old('expertise') }}</textarea>
                    @error('expertise')
                        <span class="alert alert-danger alert-dismissible mt-1">
                            <div class="alert-message p-0">
                            {{ $message }}
                            </div>
                        </span>
                    @enderror
                </div>
                <div class="col-sm-6 mb-3">
                    <label class="mb-3">Description</label>
                    <textarea name="description" class="form-control" rows="3" id="description">{{ old('description') }}</textarea>
                    @error('description')
                        <span class="alert alert-danger alert-dismissible mt-1">
                            <div class="alert-message p-0">
                            {{ $message }}
                            </div>
                        </span>
                    @enderror
                </div>
                <div class="col-sm-12 mb-3">
                    <p class="mb-3">Status <span class="text-danger">*</span></p>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="status" type="radio" value="active" checked {{ (old('status') == 'active' ? 'checked' : '') }} id="flexCheckDefault">
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
                <div class="col-sm-12 mb-3">
                    <label>Tailor's photos <span class="text-danger">*</span></label>
                    <div class="mt-2">
                        <input type="file" name="photos[]" multiple accept="image/*">
                        @error('photos')
                            <span class="alert alert-danger alert-dismissible mt-2">
                                <div class="alert-message p-0">
                                    {{ $message }}
                                </div>
                            </span>
                        @enderror
                        @if (\Session::has('error'))
                            <span class="alert alert-danger alert-dismissible mt-2">
                                <div class="alert-message p-0">
                                    {{ \Session::get('error') }}
                                </div>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="text-end mt-3">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>
@endsection