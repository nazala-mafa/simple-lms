{{-- Delete Button Handler --}}
<form method="POST" id="util-delete-form" class="d-none">
  {{ csrf_field() }}
  {{ method_field('DELETE') }}

  <button type="submit" id="util-delete-form-submit"></button>
</form>
