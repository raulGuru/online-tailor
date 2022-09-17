@extends('layouts.master')
@section('content')
<div class="card">
   <div class="card-header">
      <div class="float-end">
         <form class="d-none d-sm-inline-block">
            <div class="input-group input-group-navbar">
               <input type="text" class="form-control" name="q" value="{{ request()->q }}" placeholder="Search product…" aria-label="Search">
               <button class="btn" type="button">
               <i class="align-middle" data-feather="search"></i>
               </button>
            </div>
         </form>
         <a href="{{ route('stitching.create') }}" class="btn btn-primary" role="button">
            <i class="align-middle me-2" data-feather="edit-2"></i> Add Stitching Cost
         </a>
      </div>
      <h5 class="card-title mb-0">Stitching List</h5>
   </div>
   <div class="card-body">
      @if($stitchings->count() > 0)
         <table class="table table-striped">
            <thead>
               <tr>
                  <th>#</th>
                  <th>Creater</th>
                  <th>Name</th>
                  <th>Cost</th>
                  <th>Updated On</th>
                  <th class="text-end">Actions</th>
               </tr>
            </thead>
            <tbody>
               
               @foreach($stitchings as $key => $stitching)
               <tr>
                  <td>{{ ($stitchings->currentpage()-1) * $stitchings->perpage() + $key + 1 }}</td>
                  <td>{{ $stitching->user->email }}</td>
                  <td>{{ $stitching->stitch_name }}</td>
                  <td>{{ $stitching->cost }}</td>
                  <td>{{ $stitching->updated_at }}</td>
                  <td class="table-action">
                     <div class="d-flex justify-content-end">
                        <div>
                           <a href="{{ route('stitching.show', $stitching->id)}}"><i class="align-middle me-2" data-feather="eye"></i></a>
                        </div>
                        <div>
                           <a href="{{ route('stitching.edit', $stitching->id) }}"><i class="align-middle me-2" data-feather="edit-2"></i></a>
                        </div>
                     </div>
                  </td>
               </tr>
               @endforeach
            </tbody>
         </table>
         <div class="d-flex flex-row-reverse">
            <div class="p-0">{{ $stitchings->links() }}</div>
          </div>
      @else: 
         <div class="row">
            <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
               <div class="d-table-cell align-middle">
                  <div class="text-center">
                     <h1 class="display-1 font-weight-bold">402</h1>
                     <p class="h1">No data available.</p>
                     <p class="h2 font-weight-normal mt-3 mb-4">There is no resource behind the URI.</p>
                     <a href="{{ route('stitching.create') }}" class="btn btn-primary btn-lg">Add Stitching Cost</a>
                  </div>
               </div>
            </div>
         </div>
      @endif
   </div>
</div>
@endsection