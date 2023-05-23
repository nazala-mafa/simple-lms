@extends('layouts.app-public')

@section('content')
  <div class="container">
    <div class="row">
      @foreach ($schools as $item)
        <div class="col-xl-4">
          <div class="card">
            <a href="{{ url("/$item->slug") }}">
              <div class="card-body">
                <h2 class="mb-0 text-center">{{ $item->name }}</h2>
              </div>
            </a>
          </div>
        </div>
      @endforeach
    </div>
  </div>
@endsection
