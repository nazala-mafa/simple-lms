@extends('master::layouts.master')

@section('content')
  <div class="container">
    <h1>Users List</h1>
    <div class="row">
      <div class="card">
        <div class="card-body">
          <table class="display" style="width: 100%;" id="user">
            <thead>
              <tr>
                <th>#</th>
                <th>Username</th>
                <th>Email</th>
                <th>Verify at</th>
                <th>Action</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection
