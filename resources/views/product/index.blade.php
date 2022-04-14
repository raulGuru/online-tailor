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
      </div>
      <h5 class="card-title mb-0">Product List</h5>
   </div>
   <div class="card-body">
      {{-- <pre>{{ dd($products) }}</pre> --}}
      @if($products->count() > 0)
         <table class="table table-striped">
            <thead>
               <tr>
                  <th>#</th>
                  <th>Title</th>
                  <th>SKU</th>
                  <th>Size</th>
                  <th>Price <span class="small">(per meter)</span></th>
                  <th>Main Category</th>
                  <th>Sub Category</th>
                  <th>Color</th>
                  <th>Updated at</th>
                  <th>Actions</th>
               </tr>
            </thead>
            <tbody>
               
               @foreach($products as $key => $product)
               <tr>
                  <td>{{ ($products->currentpage()-1) * $products->perpage() + $key + 1 }}</td>
                  <td>{{ $product->title }}</td>
                  <td>{{ $product->sku }}</td>
                  <td>{{ $product->size }}</td>
                  <td>&#8377 {{ $product->price }}</td>
                  <td>{{ $product->MasterCategory->title }}</td>
                  <td>{{ ucfirst($product->productType->name) }}</td>
                  <td>{{ ucfirst($product->productColor->name) }}</td>
                  <td>{{ $product->updated_at }}</td>
                  <td class="table-action">
                     <div class="d-flex justify-content-center">
                        <div>
                           <a href="{{ route('product.show', $product->id) }}">
                              <i class="align-middle me-2" data-feather="eye"></i>
                           </a>
                        </div>
                        <div>
                           <a href="{{ route('product.edit', $product->id) }}">
                              <i class="align-middle me-2" data-feather="edit-2"></i>
                           </a>
                        </div>
                        <div>
                           <form method="post" action="{{ route('product.destroy', $product->id)}}" class="form-inline">
                              <button type="button" class="btn p-0 show_confirm">
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
            <div class="p-0">{{ $products->links() }}</div>
          </div>
      @else: 
         <div class="row">
            <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
               <div class="d-table-cell align-middle">
                  <div class="text-center">
                     <p class="h1">No data available.</p>
                     <a href="{{ route('product.create') }}" class="btn btn-primary btn-lg">Create new product</a>
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