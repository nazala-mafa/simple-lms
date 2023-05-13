@extends('layouts.app')

@section('content')
  <div class="text-center">

    @if (auth()->user()->hasRole('Super Admin'))
      <h1>Welcome Super Admin</h1>
    @endif

    @if (auth()->user()->can('write posts'))
      <h2>You Can Write Posts</h2>
    @endif
  </div>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">{{ __('Dashboard') }}</div>

          <div class="card-body">
            @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif

            {{ __('You are logged in!') }}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
