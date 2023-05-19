@extends('lms::layouts.master')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col">
        <div class="card">
          <div class="card-header">
            <div class="h2">Modules List</div>
          </div>
          <div class="card-body">
            <table id="module" class="display" style="width: 100%;">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Title</th>
                  <th>Action</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
