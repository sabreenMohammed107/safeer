{{-- @extends('layouts.app') --}}
@extends('layout.main')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                   You Are Admin
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
