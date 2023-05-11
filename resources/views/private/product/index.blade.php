@extends('layouts.app')

@section('content')
  <div class="container">
    <h1>Products List</h1>
    <div class="row">
      <div class="card">
        <div class="card-body">
          <table class="display" style="width: 100%;" id="products">
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Action</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">

      @livewire('product-form')

    </div>
  </div>
@endsection
