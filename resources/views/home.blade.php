@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-body">
            @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif

            <h2 class="mb-0 text-center">{{ __('Welcome, Have a nice day.') }}</h2>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
