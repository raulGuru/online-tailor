@extends('layouts.master')
@section('content')
<div class="card">
   <div class="card-header">
    <div class="float-end">
        <a href="{{ route('appointment.list') }}" class="btn btn-primary" role="button">Appointment List</a>
     </div>
      <h5 class="card-title mb-0">Appointment Details</h5>
   </div>
   <div class="card-body">
      @if(!empty($appointment))
         <h1>Hello {{ $tailor->name }},</h1>
         <p>Below are the booking information of customer:</p>
         <table class="table">
            <tr>
               <td>Customer name</td>
               <td>{{ $appointment->fullname }}</td>
            </tr>
            <tr>
               <td>Mobile</td>
               <td>{{ $appointment->mobile }}</td>
            </tr>
            <tr>
               <td>Email</td>
               <td>{{ $appointment->email }}</td>
            </tr>
            <tr>
               <td>Address</td>
               <td>{{ $appointment->address }}</td>
            </tr>
            <tr>
               <td>Appointment datetime</td>
               <td>{{ $appointment->appointment_at }}</td>
            </tr>
            <tr>
               <td>Services</td>
               <td class="text-capitalize">
                  <?php
                     $apt = collect(json_decode($appointment->services, true));
                     $days_names = $apt->map(function($name, $key) {
                        return ucwords($name);
                     });
                     echo implode(', ', $days_names->toArray());
                  ?>
               </td>
            </tr>
            <tr>
               <td>Service Description</td>
               <td>
                  {{ $appointment->service_description }}
               </td>
            </tr>
            <tr>
               <td>
                  <form method="post" action="{{ route('appointment.update', $appointment->id) }}" class="form-inline">
                     @csrf
                     @method('PATCH')
                     <button type="submit" {{ ($appointment->status === 'accepted' || $appointment->status === 'rejected') ? 'disabled': '' }} class="btn btn-sm btn-success mt-2 text-white">
                        Approve
                     </button>
               </form>
               </td>
               <td>
               <form method="post" action="{{ route('appointment.destroy', $appointment->id) }}" class="form-inline">
                     @csrf
                     @method('DELETE')
                     <button type="submit" {{ ($appointment->status === 'accepted' || $appointment->status === 'rejected') ? 'disabled': '' }} class="btn btn-sm btn-danger mt-2 text-white">
                        Decline
                     </button>
               </form>
               </td>
            </tr>
         </table>
      @else: 
         <div class="row">
            <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
               <div class="d-table-cell align-middle">
                  <div class="text-center">
                     <h1 class="display-1 font-weight-bold">402</h1>
                     <p class="h1">No appointment available.</p>
                     <p class="h2 font-weight-normal mt-3 mb-4">There is no resource behind the URI.</p>
                     <a href="{{ route('appointment.list') }}" class="btn btn-primary btn-lg">Appointment</a>
                  </div>
               </div>
            </div>
         </div>
      @endif
   </div>
</div>
@endsection