
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
								<form method="post" action="{{ route('location.store') }}">
                                    @csrf
									<div class="input-group find-location-search">
										<input type="number" required maxlength="6" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="form-control" name="pincode" value="{{ old('pincode') }}" placeholder="Enter a PIN code">
                                        <input type="hidden" required  class="form-control" name="redirect_uri" value="{{ old('redirect_uri') ? old('redirect_uri') : $redirect_uri }}" placeholder="Enter a PIN code">
										<button class="btn btn-blue text-white" type="submit">Search</button>
									</div>
                                    @error('pincode')
                                        <div class="small text-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    @error('redirect_uri')
                                        <div class="small text-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection