import Swal from "sweetalert2";

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

export function confirmDelete(deleteAttempt) {
  Swal.fire({
    title: "Are you sure?",
    text: "You won't be able to revert this!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, delete it!",
  }).then((result) => {
    if (result.isConfirmed) {
      deleteAttempt();
    }
  });
}
