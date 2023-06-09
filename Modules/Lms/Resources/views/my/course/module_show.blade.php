@extends('lms::layouts.master')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col">

        <div class="card mt-5 ">
          <div class="card-body">
            <h1 class="text-center">{{ $module->title }}</h1>
            <p class="lead text-center">{{ $module->description }}</p>
            <div class="lead">{{ $module->body }}</div>
          </div>
        </div>

      </div>
    </div>
  </div>
@endsection
