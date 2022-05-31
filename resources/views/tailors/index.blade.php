@extends('layouts.master')
@section('content')
<div class="card">
   <div class="card-header">
      <div class="float-end">
         <form class="d-none d-sm-inline-block">
            <div class="input-group input-group-navbar">
               <input type="text" class="form-control" name="q" value="{{ request()->q }}" placeholder="Search tailor(s)..." aria-label="Search">
               <button class="btn" type="button">
               <i class="align-middle" data-feather="search"></i>
               </button>
            </div>
         </form>
         <a href="{{ route('tailors.create') }}" class="btn btn-primary" role="button">
            <i class="align-middle me-2" data-feather="edit-2"></i> Create new tailor
         </a>
      </div>
      <h5 class="card-title mb-0">Tailor List:</h5>
   </div>
   <div class="card-body">
      @if(isset($tailors) && $tailors->count() > 0)
         <table class="table table-striped">
            <thead>
               <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Shop name</th>
                  <th>Location</th>
                  <th>Pin code</th>
                  <th>Mobile</th>
                  <th>Services</th>
                  <th>Status</th>
                  <th>Created at</th>
                  <th class="text-end">Actions</th>
               </tr>
            </thead>
            <tbody>
               
               @foreach($tailors as $key => $tailor)
               <tr>
                  <td>{{ ($tailors->currentpage()-1) * $tailors->perpage() + $key + 1 }}</td>
                  <td>{{ $tailor->name }}</td>
                  <td>{{ $tailor->shop_name }}</td>
                  <td>{{ $tailor->location }}</td>
                  <td>{{ $tailor->pin_code }}</td>
                  <td>{{ $tailor->mobile }}</td>
                  <td>{{ implode(', ', json_decode($tailor->services, true)) }}</td>
                  <td>{{ $tailor->status }}</td>
                  <td>{{ $tailor->updated_at }}</td>
                  <td class="table-action">
                     <div class="d-flex justify-content-end">
                        <div>
                           <a href="{{ route('tailors.show', $tailor->id)}}"><i class="align-middle me-2" data-feather="eye"></i></a>
                        </div>
                        <div>
                           <a href="{{ route('tailors.edit', $tailor->id) }}"><i class="align-middle me-2" data-feather="edit-2"></i></a>
                        </div>
                        <div>
                           <form method="post" action="{{ route('tailors.destroy', $tailor->id)}}" class="form-inline">
                            @csrf
                            @method('DELETE')
                              <button type="submit" class="btn p-0">
                                 <i class="align-middle me-2" data-feather="trash"></i>
                              </button>
                           </form>
                        </div>
                     </div>
                  </td>
               </tr>
               @endforeach
            </tbody>
         </table>
         <div class="d-flex flex-row-reverse">
            <div class="p-0">{{ $tailors->links() }}</div>
          </div>
      @else: 
         <div class="row">
            <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
               <div class="d-table-cell align-middle">
                  <div class="text-center">
                     <h1 class="display-1 font-weight-bold">402</h1>
                     <p class="h1">No data available.</p>
                     <p class="h2 font-weight-normal mt-3 mb-4">There is no resource behind the URI.</p>
                     <a href="{{ route('tailors.create') }}" class="btn btn-primary btn-lg">Create new tailor</a>
                  </div>
               </div>
            </div>
         </div>
      @endif
   </div>
</div>
@endsection