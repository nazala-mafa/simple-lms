import { deleteData } from "../../util";

$(function () {
  $("#module").DataTable({
    processing: true,
    serverSide: true,
    ajax: "/api/lms/module/datatable",
    buttons: ["add"],
    columns: [
      {
        data: "id",
        render: function (_, __, ___, meta) {
          return meta.row + meta.settings._iDisplayStart + 1;
        },
      },
      {
        data: "title",
      },
      {
        data: "id",
        render: function (_, __, row) {
          const rowData = JSON.stringify(row);

          return `
            <div class="d-flex justify-content-center gap-2">
              <a class="btn btn-sm btn-info" href="/lms/module/${row.id}">show</a>
              <a class="btn btn-sm btn-primary" href="/lms/module/${row.id}/edit">edit</a>
              <button data-row='${rowData}' class="btn btn-sm btn-danger btn-delete">delete</button>
            </div>
          `;
        },
      },
    ],
    drawCallback() {
      $(".btn-delete").on("click", deleteModule);
    },
  });

  function deleteModule() {
    const rowData = $(this).data("row");

    window.swal
      .fire({
        title: `Are you sure to delete module "${rowData.title}" ?`,
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      })
      .then((result) => {
        if (result.isConfirmed) {
          deleteData("/lms/module/" + rowData.id);
        }
      });
  }
});
