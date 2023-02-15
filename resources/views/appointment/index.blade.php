@extends('layouts.master')
@section('content')
<div class="card">
   <div class="card-header">
      <h5 class="card-title mb-0">Appointment List</h5>
   </div>
   <div class="card-body">      
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
                  <th>Service Description</th>
                  <th>Appointment</th>
                  <th>Status</th>
                  <th class="text-end">Actions</th>
               </tr>
            </thead>
            <tbody>
                @if($appointments->count() > 0)
                    @foreach($appointments as $key => $appointment)
                        <tr>
                            <td>{{ $appointments->firstItem() + $key }}</td>
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
                                <div class="d-flex gap-1 justify-content-end">
                                    <form method="post" action="{{ route('appointment.update', $appointment->id) }}" class="form-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" {{ $appointment->status === 'accepted' ? 'disabled': '' }} class="btn btn-sm btn-success mt-2 text-white">
                                            Approve
                                        </button>
                                    </form>
                                    <form method="post" action="{{ route('appointment.destroy', $appointment->id) }}" class="form-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger mt-2 text-white">
                                            Decline
                                        </button>
                                    </form>
                                </div>
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
@endsection