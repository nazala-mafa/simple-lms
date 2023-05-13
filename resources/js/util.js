export function deleteData(action) {
  $("#util-delete-form").attr("action", action);
  $("#util-delete-form-submit").trigger("click");
}
