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
         <a href="{{ route('product_subcategory.create') }}" class="btn btn-primary" role="button">
            <i class="align-middle me-2" data-feather="edit-2"></i> Add Category
         </a>
      </div>
      <h5 class="card-title mb-0">Product Subcategory List</h5>
   </div>
   <div class="card-body">
      @if($categorys->count() > 0)
         <table class="table table-striped">
            <thead>
               <tr>
                  <th>#</th>
                  <th>Creater</th>
                  <th>Name</th>
                  <th>Category</th>
                  <th>Updated On</th>
                  <th class="text-end">Actions</th>
               </tr>
            </thead>
            <tbody>
               
               @foreach($categorys as $key => $subcategory)
               <tr>
                  <td>{{ ($categorys->currentpage()-1) * $categorys->perpage() + $key + 1 }}</td>
                  <td>{{ $subcategory->user->email }}</td>
                  <td>{{ $subcategory->name }}</td>
                  <td>{{ $subcategory->category->name }}</td>
                  <td>{{ $subcategory->created_at }}</td>
                  <td class="table-action">
                     <div class="d-flex justify-content-end">
                        <div>
                           <a href="{{ route('product_subcategory.show', $subcategory->id)}}"><i class="align-middle me-2" data-feather="eye"></i></a>
                        </div>
                        <div>
                           <a href="{{ route('product_subcategory.edit', $subcategory->id) }}"><i class="align-middle me-2" data-feather="edit-2"></i></a>
                        </div>
                        <div>
                           <form method="post" action="{{ route('product_subcategory.destroy', $subcategory->id)}}" class="form-inline">
                              <button type="button" class="btn p-0 show_confirm">
                                 <i class="align-middle me-2" data-feather="trash"></i>
                              </button>
                           </form>                           
                        </div>
                        <div>
                           <form method="post" action="{{ route('product_subcategory.update_status')}}" class="form-inline">
                              @csrf
                              <div class="form-check form-switch">
                                 <input type="hidden" name="status" value="{{$subcategory->action}}">
                                 <input type="hidden" name="id" value="{{$subcategory->id}}">
                                 <input class="form-check-input" name="action" type="checkbox" onchange="this.form.submit()" title="{{ $subcategory->action === 'active' ? 'Active' : 'Inactive'}}" {{$subcategory->action === 'active' ? 'checked': ''}}>
                              </div>  
                           </form>                         
                        </div>
                     </div>
                  </td>
               </tr>
               @endforeach
            </tbody>
         </table>
         <div class="d-flex flex-row-reverse">
            <div class="p-0">{{ $categorys->links() }}</div>
          </div>
      @else: 
         <div class="row">
            <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
               <div class="d-table-cell align-middle">
                  <div class="text-center">
                     <h1 class="display-1 font-weight-bold">402</h1>
                     <p class="h1">No data available.</p>
                     <p class="h2 font-weight-normal mt-3 mb-4">There is no resource behind the URI.</p>
                     <a href="{{ route('product_subcategory.create') }}" class="btn btn-primary btn-lg">Add Product Subcategory</a>
                  </div>
               </div>
            </div>
         </div>
      @endif
   </div>
</div>
<!-- Modal -->
<div class="modal fade" id="delete_modal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <form method="post" action="" class="form-inline">
         @csrf
         @method('DELETE')
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="deleteModalLabel">Delete Confirmation</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <h4 class="text-center">Are you sure you want to delete this record?</h4>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
               <button type="submit" class="btn btn-danger">Yes</button>
            </div>
         </div>
      </form>
   </div>
 </div>
@endsection