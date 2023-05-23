@extends('layouts.app-public')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-xl-4">
        <div class="card">
          <a href="{{ url("/$school->slug") }}">
            <div class="card-body">
              <h2 class="mb-0 text-center">{{ $school->name }}</h2>
            </div>
          </a>
        </div>
      </div>
    </div>
  </div>
@endsection
