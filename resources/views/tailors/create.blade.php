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
                    <label class="mb-1"><strong>Name</strong> <span class="text-danger">*</span></label>
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
                    <label class="mb-1"><strong>Shop name</strong> <span class="text-danger">*</span></label>
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
                    <label class="mb-1"><strong>Location</strong> <span class="text-danger">*</span></label>
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
                    <label class="mb-1"><strong>Pin Code</strong> <span class="text-danger">*</span></label>
                    <input class="form-control form-control-lg" type="number" min="0" name="pin_code" value="{{ old('pin_code') }}" placeholder="Enter tailor's pin code" />
                    @error('pin_code')
                        <span class="alert alert-danger alert-dismissible mt-1">
                            <div class="alert-message p-0">
                                {{ $message }}
                            </div>
                        </span>
                    @enderror
                </div>
                <div class="col-sm-3 mb-3">
                    <label class="mb-1"><strong>Email Address</strong></label>
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
                    <label class="mb-1"><strong>Mobile</strong> <span class="text-danger">*</span></label>
                    <input class="form-control form-control-lg" type="number" min="0" maxlength="10" name="mobile" value="{{ old('mobile') }}" placeholder="Enter  tailor's mobile" />
                    @error('mobile')
                        <span class="alert alert-danger alert-dismissible mt-1">
                            <div class="alert-message p-0">
                                {{ $message }}
                            </div>
                        </span>
                    @enderror
                </div>
                <div class="col-sm-3 mb-3">
                    <label class="mb-1"><strong>Phone</strong></label>
                    <input class="form-control form-control-lg" type="text" name="phone" value="{{ old('phone') }}" placeholder="Enter tailor's phone" />
                    @error('phone')
                        <span class="alert alert-danger alert-dismissible mt-1">
                            <div class="alert-message p-0">
                                {{ $message }}
                            </div>
                        </span>
                    @enderror
                </div>
                <div class="col-sm-12 mb-3">
                    <label class="mb-3"><strong>Address</strong> <span class="text-danger">*</span></label>
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
                    <p class="mb-3"><strong>Services</strong> <span class="text-danger">*</span></p>
                    @foreach($services as $key => $service)
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="services[]" type="checkbox" {{ (!empty(old('services') && in_array($service, old('services')))) ? 'checked': '' }} id="service_checkbox_{{ $key }}" value="{{ $service }}">
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
                    <p class="mb-3"><strong>Appointment</strong></p>
                    <div class="row">
                        @foreach($appointments as $key => $appointment)
                            <div class="col-sm-2">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" name="appointments[]" type="checkbox" {{ (!empty(old('appointments') && in_array($appointment, old('appointments')))) ? 'checked': '' }} id="appointment_checkbox_{{ $key }}" value="{{ $appointment }}">
                                    <label class="form-check-label" for="appointment_checkbox_{{ $key }}">{{ Str::ucfirst($appointment) }}</label>
                                </div>
                            </div>
                            <div class="col-sm-10">
                                <label class="m-3 mt-0">
                                    Opens:
                                    <select name="{{ $appointment }}_opens">
                                        <option value="">Select opens time</option>
                                        <option value="closed">Closed</option>
                                        @foreach($working_hours as $hour):
                                            <option value="{{ $hour }}">{{ $hour }}</option>
                                        @endforeach
                                    </select>
                                </label>
                                <label class="m-3 mt-0">
                                    Closes:
                                    <select name="{{ $appointment }}_closes">
                                        <option value="">Select closes time</option>
                                        <option value="closed">Closed</option>
                                        @foreach($working_hours as $hour):
                                            <option value="{{ $hour }}">{{ $hour }}</option>
                                        @endforeach
                                    </select>
                                </label>
                            </div>
                        @endforeach
                    </div>
                    @error('appointments')
                        <span class="alert alert-danger alert-dismissible mt-1">
                            <div class="alert-message p-0">
                                {{ $message }}
                            </div>
                        </span>
                    @enderror
                </div>
                <div class="col-sm-12 mb-3">
                    <p class="mb-3"><strong>Stitching Cost</strong></p>
                    @if($stitchings->count())
                        <div class="row">
                            @foreach($stitchings as $key => $stitching)
                                <div class="col-sm-3 mb-2">
                                    <div class="form-check form-check-inline p-0">
                                        <label class="form-check-label" for="stitching_{{ $key }}">{{ $stitching->stitch_name }}</label>
                                        <input class="form-control form-control-lg" id="stitching_{{ $key }}" type="number" min="0" name="stitchings[{{ $stitching->slug_name }}]" value="{{ $stitching->cost }}" placeholder="Enter stitching cost" />
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @error('stitchings')
                            <span class="alert alert-danger alert-dismissible mt-1">
                                <div class="alert-message p-0">
                                    {{ $message }}
                                </div>
                            </span>
                        @enderror
                        @else
                        <p class="mb-3 text-danger">
                            <strong>Stitching Cost missing</strong>
                        </p>
                        <p class="mb-3">Add Stitching Cost first then only you can create a tailor <a href="{{ route('stitching.create') }}" class="text-success">Click here</a></p>
                    @endif
                </div>
                <div class="col-sm-12 mb-3">
                    <label class="mb-3"><strong>Expertise</strong></label>
                    <textarea name="expertise" class="form-control" rows="3" id="expertise">{{ old('expertise') }}</textarea>
                    @error('expertise')
                        <span class="alert alert-danger alert-dismissible mt-1">
                            <div class="alert-message p-0">
                            {{ $message }}
                            </div>
                        </span>
                    @enderror
                </div>
                <div class="col-sm-4 mt-3 mb-3">
                    <label class="mb-1"><strong>Material Commission (%)</strong> <span class="text-danger">*</span></label>
                    <input class="form-control form-control-lg" type="number" min="0" name="commission" value="{{ old('commission') }}" placeholder="Enter tailor's commission" />
                    @error('commission')
                        <span class="alert alert-danger alert-dismissible mt-1">
                            <div class="alert-message p-0">
                                {{ $message }}
                            </div>
                        </span>
                    @enderror
                </div>
                <div class="col-sm-4 mt-3 mb-3">
                    <label class="mb-1"><strong>Visit charge on successful order placed</strong> <span class="text-danger">*</span></label>
                    <input class="form-control form-control-lg" type="number" min="0" name="visit_charges" value="{{ old('visit_charges') }}" placeholder="Enter tailor's visit charge" />
                    @error('visit_charges')
                        <span class="alert alert-danger alert-dismissible mt-1">
                            <div class="alert-message p-0">
                                {{ $message }}
                            </div>
                        </span>
                    @enderror
                </div>
                <div class="col-sm-12 mt-3 mb-3">
                    <p class="mb-3"><strong>Status</strong> <span class="text-danger">*</span></p>
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
                    <label><strong>Tailor's photos</strong></label>
                    <div class="mt-2">
                        <input type="file" name="photos[]" multiple accept="image/*">
                        @error('photos')
                            <span class="alert alert-danger alert-dismissible mt-2">
                                <div class="alert-message p-0">
                                    {{ $message }}
                                </div>
                            </span>
                        @enderror
                    </div>
                </div>
                @if (\Session::has('error'))
                    <div class="col-sm-12 mb-3">
                        <span class="alert alert-danger alert-dismissible mt-2">
                            <div class="alert-message p-0">
                                {{ \Session::get('error') }}
                            </div>
                        </span>
                    </div>
                @enderror
            </div>
            <div class="text-end mt-3">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>
@endsection