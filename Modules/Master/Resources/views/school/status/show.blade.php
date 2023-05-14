@extends('master::layouts.master')

@section('content')
  <div class="container">
    <div class="card p-3">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h2>Schools with "{{ $status->name }}" Status</h2>
      </div>
      <tbody>
        <table class="table">
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Address</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($status->schools()->get() as $school)
              <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $school->name }}</td>
                <td>{{ $school->address }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </tbody>
    </div>
  </div>
@endsection
