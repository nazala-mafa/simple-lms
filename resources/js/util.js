export function deleteData(action) {
  $("#util-delete-form").attr("action", action);
  $("#util-delete-form-submit").trigger("click");
}

export const axios = window.axios.create({
  baseURL: "/api/",
  headers: {
    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
  },
});
