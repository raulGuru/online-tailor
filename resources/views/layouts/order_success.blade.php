@extends('layouts.master2')
@section('content')
<x-order-summary :summary="$data" />
@endsection