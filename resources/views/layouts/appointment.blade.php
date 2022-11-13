
@extends('layouts.master2')
@section('content')
<div class="container d-flex flex-column">
	<div class="row {{ !request()->pincode ? 'vh-100': ''}}">
		<div class="col-sm-10 col-md-8 col-lg-8 mx-auto d-table">
			<div class="d-table-cell align-middle">
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col-sm-12">
								<h1>Search Tailor</h1>
								<p class="mb-2">Are you looking the best tailor near about your location ?</p>
								<form method="get" action="{{ route('appointment.index') }}">
									<div class="input-group find-location-search">
										<input type="number" class="form-control" required name="pincode" value="{{ request()->pincode }}" pattern="/^-?\d+\.?\d*$/" placeholder="Enter a PIN code">
										<button class="btn btn-blue text-white" type="submit">FIND LOCATION</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-12">
			<h1 class="mb-3 border-bottom border-3 pb-2">Best tailor(s) near your area</h1>
			@if($tailors->count())
				<ul class="list-unstyled">
					@foreach($tailors as $tailor)
						<li class="media border-bottom border-1 pb-2 mb-2">
							<div class="row">
								<div class="col-3">
									<img class="me-2 img-thumbnail" src="http://localhost/online-tailor/public/assets/img/shop-photo01.jpg" alt="Generic placeholder image">
								</div>
								<div class="col-9">
									<div class="media-body pr-3">
										<h3 class="mt-0 mb-1">{{ $tailor->shop_name }}</h3>
										<h4 class="mt-0 mb-1 text-muted"><strong>Location: </strong><i class="fas fa-map-marker text-success"></i> {{ $tailor->location }} - {{ $tailor->pin_code }}</h4>
										<p class="m-0"><strong>Address: </strong>{{ $tailor->address }}</p>
										<p class="m-0"><strong>Phone: </strong>{{ $tailor->phone }}</p>
										<p class="m-0">
											<strong>Open Days: </strong>
											@if($tailor->appointments)
												<?php
													$appointments_days = collect(json_decode($tailor->appointments, true));
													$days_names = $appointments_days->map(function($name, $key) {
														return ucwords($name);
													});
													echo implode(', ', $days_names->toArray());
												?>
											@else
												N/A
											@endif
										</p>
										<p class="m-0"><strong>Timing: </strong>09:10 AM - 09:30 PM</p>
										<p class="m-0">
											<strong>Services: </strong>
											@if($tailor->services)
												<?php
													$services = collect(json_decode($tailor->services, true));
													$service_names = $services->map(function($name, $key) {
														return ucwords($name);
													});
													echo implode(', ', $service_names->toArray());
												?>
											@else
												N/A
											@endif
										</p>
										@if($tailor->description)
											<p class="m-0"><strong>Description: </strong>{{ $tailor->description }}</p>
										@endif
										<p><button class="btn btn-success appointment_button" type="button" data-id="{{ $tailor->id }}">Book appointment</button></p>
									</div>
								</div>
							</div>
						</li>
					@endforeach
				</ul>
				<div class="d-flex flex-row-reverse">
					<div class="p-0">
						{{ $tailors->links() }}	
					</div>
				</div>
			@else
				<div class="row">
					<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
						<div class="d-table-cell align-middle">
							<div class="text-center">
								<h1 class="display-1 font-weight-bold">402</h1>
								<p class="h1">No data available.</p>
								<p class="h2 font-weight-normal mt-3 mb-4">There is no resource behind the URI.</p>
							</div>
						</div>
					</div>
				</div>
			@endif
		</div>
	</div>
	<div class="modal fade" id="appointmentModal" tabindex="-1" aria-labelledby="appointmentModal" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Book Appointment</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form>
					<div class="mb-3">
						<label for="fullname" class="form-label">Full Name <span class="text-danger">*</span></label>
						<input type="text" class="form-control" id="fullname" placeholder="Enter full name">
					</div>
					<div class="mb-3">
						<label for="email" class="form-label">Email address</label>
						<input type="email" class="form-control" id="email" placeholder="Enter email address">
					</div>
					<div class="mb-3">
						<label for="mobile" class="form-label">Mobile <span class="text-danger">*</span></label>
						<input type="number" class="form-control" id="mobile" placeholder="Enter mobile">
					</div>
					<div class="mb-3">
						<label for="address" class="form-label">Address <span class="text-danger">*</span></label>
						<textarea class="form-control" id="address" rows="3"></textarea>
					</div>
					<div class="mb-3">
						<label for="appointment_datetime" class="form-label">Appointment Date <span class="text-danger">*</span></label>
						<input type="number" class="form-control" id="appointment_datetime" placeholder="Select appointment date">
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				<input type="hidden" name="tailor_id" class="form-control" id="tailor_id">
				<button type="button" class="btn btn-primary">Save</button>
			</div>
			</div>
		</div>
	</div>
@endsection