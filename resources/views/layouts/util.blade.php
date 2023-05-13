<form method="POST" id="util-delete-form" class="d-none">
  {{ csrf_field() }}
  {{ method_field('DELETE') }}

  <input type="submit" id="util-delete-form-submit">
</form>
