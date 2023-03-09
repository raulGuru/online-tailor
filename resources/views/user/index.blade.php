@extends('layouts.master')
@section('content')
<div class="card">
   <div class="card-header">
      <div class="float-end">
         @if(Auth::user()->role === 'admin')
            <form class="d-none d-sm-inline-block">
               <div class="input-group input-group-navbar">
                  <input type="text" class="form-control" name="q" value="{{ request()->q }}" placeholder="Search product…" aria-label="Search">
                  <button class="btn" type="button">
                  <i class="align-middle" data-feather="search"></i>
                  </button>
               </div>
            </form>
            <a href="{{ route('user.create') }}" class="btn btn-primary" role="button">
               <i class="align-middle me-2" data-feather="edit-2"></i> Create user
            </a>
         @endif
      </div>
      <h5 class="card-title mb-0">User List</h5>
   </div>
   <div class="card-body">
      @if($users->count() > 0)
         <table class="table table-striped">
            <thead>
               <tr>
                  <th>#</th>
                  <th>Email</th>
                  <th>Gender</th>
                  <th>Role</th>
                  <th>Phone</th>
                  <th>Pincode</th>
                  <th>Status</th>
                  <th>Updated On</th>
                  <th class="text-end">Actions</th>
               </tr>
            </thead>
            <tbody>
               
               @foreach($users as $key => $user)
               <tr>
                  <td>{{ ($users->currentpage()-1) * $users->perpage() + $key + 1 }}</td>
                  <td>{{ $user->email }}</td>
                  <td>{{ ucfirst($user->gender) }}</td>
                  <td>{{ ucfirst($user->role) }}</td>
                  <td>{{ $user->phone }}</td>
                  <td>{{ $user->pin_code }}</td>
                  <td>{{ $user->status }}</td>
                  
                  <td>{{ $user->updated_at }}</td>
                  <td class="table-action">
                     <div class="d-flex justify-content-end">
                        <div>
                           <a href="{{ route('user.show', $user->id)}}"><i class="align-middle me-2" data-feather="eye"></i></a>
                        </div>
                        <div>
                           <a href="{{ route('user.edit', $user->id) }}"><i class="align-middle me-2" data-feather="edit-2"></i></a>
                        </div>
                        @if($user->id !== Auth::id())
                           <div>
                              <form method="post" action="{{ route('user.destroy', $user->id)}}" class="form-inline">
                              @csrf
                              @method('DELETE')
                                 <button type="submit" class="btn p-0">
                                    <i class="align-middle me-2" data-feather="trash"></i>
                                 </button>
                              </form>
                           </div>
                        @else
                        <button type="button" class="btn p-0 disabled" disabled>
                            <i class="align-middle me-2" data-feather="trash"></i>
                         </button>
                        @endif
                     </div>
                  </td>
               </tr>
               @endforeach
            </tbody>
         </table>
         <div class="d-flex flex-row-reverse">
            <div class="p-0">{{ $users->links() }}</div>
          </div>
      @else: 
         <div class="row">
            <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
               <div class="d-table-cell align-middle">
                  <div class="text-center">
                     <h1 class="display-1 font-weight-bold">402</h1>
                     <p class="h1">No data available.</p>
                     <p class="h2 font-weight-normal mt-3 mb-4">There is no resource behind the URI.</p>
                     <a href="{{ route('user.create') }}" class="btn btn-primary btn-lg">Create new user</a>
                  </div>
               </div>
            </div>
         </div>
      @endif
   </div>
</div>
@endsection