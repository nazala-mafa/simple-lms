@extends('lms::layouts.master')
@include('layouts.utils.ckeditor')

@section('content')
  <div class="container">
    <div class="card">
      <div class="card-body">
        <div class="text-center mb-4">
          <h2>{{ $module->title }}</h2>
          <p>{{ $module->description }}</p>
        </div>

        <div>
          {!! $module->body !!}
        </div>
      </div>
    </div>
  </div>
@endsection
