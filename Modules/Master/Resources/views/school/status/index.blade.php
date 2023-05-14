@extends('master::layouts.master')

@section('content')
  <div class="container">
    <div class="card p-3">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h2>School Statuses</h2>
        <a href="{{ route('master.school.status.create') }}" class="btn btn-primary">Add New</a>
      </div>
      <tbody>
        <table class="table">
          <thead>
            <tr>
              <th>#</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($statuses as $status)
              <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $status->name }}</td>
                <td class="d-flex justify-content-between align-items-center">
                  <a href="{{ route('master.school.status.show', $status->id) }}" class="btn btn-info btn-sm">Detail</a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </tbody>
    </div>
  </div>
@endsection
