@extends('layouts.master')
@section('content')
<div class="card">
    <div class="card-header">
        <div class="float-end">
           <form class="d-none d-sm-inline-block">
              <div class="input-group input-group-navbar">
                 <input type="text" class="form-control" name="q" value="{{ request()->q }}" placeholder="Search appointment(s)..." aria-label="Search">
                 <button class="btn" type="submit">
                 <i class="align-middle" data-feather="search"></i>
                 </button>
              </div>
           </form>
           @if(request()->q)
              <a href="{{ route('appointment.list') }}" class="btn btn-secondary ms-2" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Clear search data">
                 <i class="align-middle" data-feather="refresh-cw"></i>
              </a>
           @endif
        </div>
        <h5 class="card-title mb-0">Appointment List</h5>
    </div>
   <div class="card-body pt-0">
         <table class="table table-striped">
            <thead>
               <tr>
                  <th>#</th>
                  <th>Tailor</th>
                  <th>Fullname</th>
                  <th>Mobile</th>
                  <th>Email</th>
                  <th>Address</th>
                  <th>Services</th>
                  <th>Service Desc</th>
                  <th>Appointment</th>
                  <th>Status</th>
                  <th class="text-end">Actions</th>
               </tr>
            </thead>
            <tbody>
                @if($appointments->count() > 0)
                    @foreach($appointments as $key => $appointment)
                        <tr>
                            <td>{{ ($appointments->currentpage()-1) * $appointments->perpage() + $key + 1 }}</td>
                            <td>{{ $appointment->tailor->name }}</td>
                            <td>{{ $appointment->fullname }}</td>
                            <td>{{ $appointment->mobile }}</td>
                            <td>{{ $appointment->email }}</td>
                            <td>{{ $appointment->address }}</td>
                            <td class="text-capitalize">{{ $appointment->services ? implode(", ", json_decode($appointment->services)): 'N/A'; }}</td>
                            <td>{{ $appointment->address }}</td>
                            <td>{{ $appointment->appointment_at }}</td>
                            <td>
                                <span class="{{
                                    $appointment->status === 'pending' ? 'text-warning': '' }}
                                    {{ $appointment->status === 'accepted' ? 'text-success': '' }}
                                    {{ $appointment->status === 'rejected' ? 'text-danger': '' }}">
                                    {{ Str::ucfirst($appointment->status) }}
                                </span>
                            </td>
                            <td class="text-end">
                                <a class="btn btn-sm btn-info mt-2 text-white" href="{{ route('appointment.show', $appointment->id) }}">View</a>
                                <form method="post" action="{{ route('appointment.update', $appointment->id) }}" class="form-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" {{ ($appointment->status === 'accepted' || $appointment->status === 'rejected') ? 'disabled': '' }} class="btn btn-sm btn-success mt-2 text-white">
                                        Approve
                                    </button>
                                </form>
                                <form method="post" action="{{ route('appointment.destroy', $appointment->id) }}" class="form-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" {{ ($appointment->status === 'accepted' || $appointment->status === 'rejected') ? 'disabled': '' }} class="btn btn-sm btn-danger mt-2 text-white">
                                        Decline
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
               @else:
                    <tr>
                        <td colspan="11">
                            No appointment found!
                        </td>
                    </tr>
               @endif
            </tbody>
         </table>
        <div class="d-flex flex-row-reverse">
            <div class="p-0">{{ $appointments->links() }}</div>
        </div>
   </div>
</div>
@if(Session::has('modal_data'))
    @php
        $modal_data = Session::get('modal_data');
    @endphp
    <div class="modal fade" id="approve-reject" tabindex="-1" aria-labelledby="approve-reject-modal" aria-hidden="true" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Customer's Contact Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @csrf
                    <p>
                        Customer Name: {{ $modal_data['customer_name'] }}
                    </p>
                    <p>
                        Tailor Name: {{ $modal_data['tailor_name'] }}
                    </p>
                    <p>
                        Shop Name: {{ $modal_data['shop_name'] }}
                    </p>
                    <p>
                        Mobile Number: {{ $modal_data['mobile'] }}
                    </p>
                    <p>
                        Address: {{ $modal_data['address'] }}
                    </p>
                    <p>
                        Appointment on: {{ $modal_data['appointment_at'] }}
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        let showModal = true;
    </script>
@endif
@endsection
