
@extends('layouts.master2')
@section('content')
<div class="container d-flex flex-column">
	<div class="row">
		<div class="col-12">
			@if(isset($tailors) && $tailors->count())
				<h1 class="mb-3 border-bottom border-3 pb-2">
					Best @if($tailors->count() == 1) tailor @else tailors @endif near your pin code : 
					@if(session()->has('pincode'))
						{{ session()->get('pincode') }}
					@endif
				</h1>
				<ul class="list-unstyled">
					@foreach($tailors as $tailor)
						<li class="media border-bottom border-1 pb-2 mb-2">
							<div class="row">
								<div class="col-3">
									<?php $photos = json_decode($tailor->photos); ?>
									@if(!empty($photos) && count($photos) > 1)
										<div id="carouselExampleControls_{{ $tailor->id }}" class="carousel slide" data-bs-ride="carousel">
											<div class="carousel-inner">
												@foreach($photos as $key => $photo)
													<div class="carousel-item {{ $key === 0 ? 'active': '' }}">
														<img src="{{ asset('public/storage/tailors/' . $photo) }}" class="d-block w-100" alt="Thumbnail">
													</div>
												@endforeach
											</div>
											<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls_{{ $tailor->id }}" data-bs-slide="prev">
												<span class="carousel-control-prev-icon" aria-hidden="true"></span>
												<span class="visually-hidden">Previous</span>
											</button>
											<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls_{{ $tailor->id }}" data-bs-slide="next">
												<span class="carousel-control-next-icon" aria-hidden="true"></span>
												<span class="visually-hidden">Next</span>
											</button>
										</div>
									@elseif(!empty($photos) && count($photos) === 1)
										<img class="me-2 img-thumbnail" src="{{ asset('public/storage/tailors/' . $photos[0]) }}" alt="Thumbnail">
									@endif
								</div>
								<div class="col-9">
									<div class="media-body pr-3">
										<h3 class="mt-0 mb-1">{{ $tailor->shop_name }}</h3>
										<h4 class="mt-0 mb-1 text-muted"><strong>Location: </strong><i class="fas fa-map-marker text-success"></i> {{ $tailor->location }} - {{ $tailor->pin_code }}</h4>
										<p class="m-0"><strong>Address: </strong>{{ $tailor->address }}</p>
										<p class="m-0"><strong>Phone: </strong>{{ $tailor->phone }}</p>
										<p class="m-0">
											<strong>Shop Timings: </strong>
											@if($tailor->appointments)
												<?php
													$store_timings = $tailor->store_timings->toArray();
													$days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
												?>
												<div class="table-responsive">
													<table class="table table-sm">
														<tr>
															<th>Day</th>
															<th>Opens</th>
															<th>Closes</th>
														</tr>
														@foreach($days as $day)
														<tr>
															<td>{{ Str::title($day) }}</td>
															<td>{{ $store_timings[$day . '_opens'] ? $store_timings[$day . '_opens']: 'N/A' }}</td>
															<td>{{ $store_timings[$day . '_closes'] ? $store_timings[$day . '_closes']: 'N/A' }}</td>
														</tr>
														@endforeach
													</table>
												</div>
											@else
												N/A
											@endif
										</p>
										@if($tailor->description)
											<p class="m-0"><strong>Description: </strong>{{ $tailor->description }}</p>
										@endif
										<p>
											<button class="btn btn-success appointment_button {{ (isset($request_from) && $request_from == 'measurement') ? 'measurement_button': '' }}" type="button" data-id="{{ $tailor->id }}">{{(isset($request_from) && $request_from == 'measurement') ? 'Book Tailor': 'Book appointment'}}</button>
										</p>
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
					<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table">
						<div class="d-table-cell align-middle">
							<div class="text-center">
								<p class="h1 mb-3 mt-5">
									@if(isset($product_id))
										<span>Selected product is not at your location,<br>please choose a different product.</span>
									@else
										<span>Currently no tailors present at your location,<br>please choose a different location.</span>
									@endif
								</p>
							</div>
						</div>
					</div>
				</div>
			@endif
			@if(isset($related_tailors) && $related_tailors->count())
				<hr>
				<h1 class="mb-3 mt-5 border-bottom pb-2">Below is the related tailor for the selected product.</h1>
				<ul class="list-unstyled">
					@foreach($related_tailors as $tailor)
						<li class="media border-bottom border-1 pb-2 mb-2">
							<div class="row">
								<div class="col-3">
									<?php $photos = json_decode($tailor->photos); ?>
									@if(!empty($photos) && count($photos) > 1)
										<div id="carouselExampleControls_{{ $tailor->id }}" class="carousel slide" data-bs-ride="carousel">
											<div class="carousel-inner">
												@foreach($photos as $key => $photo)
													<div class="carousel-item {{ $key === 0 ? 'active': '' }}">
														<img src="{{ asset('public/storage/tailors/' . $photo) }}" class="d-block w-100" alt="Thumbnail">
													</div>
												@endforeach
											</div>
											<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls_{{ $tailor->id }}" data-bs-slide="prev">
												<span class="carousel-control-prev-icon" aria-hidden="true"></span>
												<span class="visually-hidden">Previous</span>
											</button>
											<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls_{{ $tailor->id }}" data-bs-slide="next">
												<span class="carousel-control-next-icon" aria-hidden="true"></span>
												<span class="visually-hidden">Next</span>
											</button>
										</div>
									@elseif(!empty($photos) && count($photos) === 1)
										<img class="me-2 img-thumbnail" src="{{ asset('public/storage/tailors/' . $photos[0]) }}" alt="Thumbnail">
									@endif
								</div>
								<div class="col-9">
									<div class="media-body pr-3">
										<h3 class="mt-0 mb-1">{{ $tailor->shop_name }}</h3>
										<h4 class="mt-0 mb-1 text-muted"><strong>Location: </strong><i class="fas fa-map-marker text-success"></i> {{ $tailor->location }} - {{ $tailor->pin_code }}</h4>
										<p class="m-0"><strong>Address: </strong>{{ $tailor->address }}</p>
										<p class="m-0"><strong>Phone: </strong>{{ $tailor->phone }}</p>
										<p class="m-0">
											<strong>Shop Timings: </strong>
											@if($tailor->appointments)
												<?php
													$store_timings = $tailor->store_timings->toArray();
													$days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
												?>
												<div class="table-responsive">
													<table class="table table-sm">
														<tr>
															<th>Day</th>
															<th>Opens</th>
															<th>Closes</th>
														</tr>
														@foreach($days as $day)
														<tr>
															<td>{{ Str::title($day) }}</td>
															<td>{{ $store_timings[$day . '_opens'] ? $store_timings[$day . '_opens']: 'N/A' }}</td>
															<td>{{ $store_timings[$day . '_closes'] ? $store_timings[$day . '_closes']: 'N/A' }}</td>
														</tr>
														@endforeach
													</table>
												</div>
											@else
												N/A
											@endif
										</p>
										@if($tailor->description)
											<p class="m-0"><strong>Description: </strong>{{ $tailor->description }}</p>
										@endif
										<p>
											<button class="btn btn-success appointment_button {{ (isset($request_from) && $request_from == 'measurement') ? 'measurement_button': '' }}" type="button" data-id="{{ $tailor->id }}">{{(isset($request_from) && $request_from == 'measurement') ? 'Book Tailor': 'Book appointment'}}</button>
										</p>
									</div>
								</div>
							</div>
						</li>
					@endforeach
				</ul>
				<div class="d-flex flex-row-reverse">
					<div class="p-0">
						{{ $related_tailors->links() }}	
					</div>
				</div>
			@endif
		</div>
	</div>
	<div class="modal fade" id="appointmentModal" tabindex="-1" aria-labelledby="appointmentModal" aria-hidden="true">
		<div class="modal-dialog">
			<form method="post" class="appointment" id="appointment-form" action="{{ route('location.send_notification') }}">
				@csrf
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Book Appointment</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="mb-3">
							<label for="fullname" class="form-label">Full Name <span class="text-danger">*</span></label>
							<input type="text" name="fullname" class="form-control" placeholder="Enter full name" required>
						</div>
						<div class="mb-3">
							<label for="email" class="form-label">Email address <span class="text-danger">*</span></label>
							<input type="email" name="email" class="form-control email" value="" placeholder="Enter email address" required>
						</div>
						<div class="mb-3">
							<label for="mobile" class="form-label">Mobile <span class="text-danger">*</span></label>
							<input type="number" name="mobile" class="form-control mobile" value="" maxlength="10" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="Enter mobile" required>
						</div>
						<div class="mb-3">
							<label for="address" class="form-label">Address <span class="text-danger">*</span></label>
							<textarea name="address" class="form-control" rows="3" required></textarea>
						</div>
						<div class="mb-3">
							<label for="appointment_datetime" class="form-label">Appointment Date <span class="text-danger">*</span></label>
							<input type="number" name="appointment_at" class="form-control appointment_datetime" placeholder="Select appointment date">
						</div>
						<div class="mb-3">
							<p class="mb-3"><strong>Services</strong> <span class="text-danger">*</span></p>
							<div id="ajax-services" class="text-capitalize"></div>
						</div>
						<div class="mb-3">
							<label for="service_description" class="form-label">Service Description <span class="text-danger">*</span></label>
							<textarea name="service_description" class="form-control" id="service_description" rows="3" placeholder="Suit, Sherwani, Shirt, Pant, Kurta, Pyjama, Indo Western, Safari, Nehru Jacket, Pathani, Uniform orders, Wedding Orders"></textarea>
						</div>
						<div class="d-none text-center" id="custom-message">
							<p>Errors</p>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						<input type="hidden" name="tailor_id" id="hidden-tailor-id" class="form-control" id="tailor_id">
						<button type="submit" id="book-now" class="btn btn-primary">Book Now</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="modal fade" id="appointmentModal1" tabindex="-1" aria-labelledby="appointmentModal1" aria-hidden="true">
		<div class="modal-dialog">
			<form method="post" class="appointment" id="appointment-form1" action="{{ route('measurement.book_tailor') }}">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Contact Details</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						@csrf
						<div class="mb-3">
							<label for="fullname" class="form-label">Full Name <span class="text-danger">*</span></label>
							<input type="text" name="fullname" class="form-control" placeholder="Enter full name">
						</div>
						<div class="mb-3">
							<label for="email" class="form-label">Email address</label>
							<input type="email" name="email" class="form-control email" value="" placeholder="Enter email address">
						</div>
						<div class="mb-3">
							<label for="mobile" class="form-label">Mobile <span class="text-danger">*</span></label>
							<input type="number" name="mobile" class="form-control mobile" value="" placeholder="Enter mobile">
						</div>
						<div class="mb-3">
							<label for="address" class="form-label">Address <span class="text-danger">*</span></label>
							<textarea name="address" class="form-control" id="address" rows="3"></textarea>
						</div>
					</div>
					<div class="modal-footer">
						<input type="hidden" name="tailor_id" id="hidden-tailor-id1" class="form-control">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						<button type="submit" id="book-now" class="btn btn-primary">Book Now</button>
					</div>
				</div>
			</form>
		</div>
	</div>	
@endsection