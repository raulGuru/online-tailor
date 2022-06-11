
@extends('layouts.master2')
@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-2 border-end">
                <div class="d-grid gap-2">
                    <a href="{{ route('account.index') }}" role="button" class="btn btn-light mb-3">Account Settings</a>
                    <a href="{{ route('account.orders') }}" role="button" class="btn btn-primary mb-3">My Orders</a>
                    <a href="{{ route('account.address') }}" role="button" class="btn btn-light mb-3">Address</a>
                </div>
            </div>
            <div class="col">
                <form method="post" action="{{ route('user.update', $user->id) }}">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="update_for" value="order" />
                    <div class="row mb-3">
                        <h1>Order page is pending</h1>
                    </div>
                    <div class="text-end mt-3">
                        {{-- <button type="submit" class="btn btn-primary">Update</button> --}}
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection