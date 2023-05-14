@extends('lms::layouts.master')

@section('content')
  <div class="container">
    <h1>Courses List</h1>
    <div class="row">
      <div class="card">
        <div class="card-body">
          <table class="display" style="width: 100%;" id="course">
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
@endsection
