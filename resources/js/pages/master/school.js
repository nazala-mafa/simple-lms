import { deleteData } from "../../util";

$(function () {
  const table = $("#school").DataTable({
    processing: true,
    serverSide: true,
    ajax: "/api/master/school/datatable",
    buttons: [
      "add",
      {
        extend: "reload",
      },
    ],
    columns: [
      {
        data: "id",
        render: function (_, __, ___, meta) {
          return meta.row + meta.settings._iDisplayStart + 1;
        },
      },
      {
        data: "name",
      },
      {
        data: "email",
      },
      {
        data: "address",
      },
      {
        data: "status",
        render: function (data) {
          if (!data) return " - ";
          return data.name;
        },
      },
      {
        data: "id",
        render: function (_, __, row) {
          const rowData = JSON.stringify(row);

          return `
            <div class="d-flex justify-content-center gap-2">
              <a class="btn btn-sm btn-primary" href="/master/school/${row.id}/edit">edit</a>
              <button data-row='${rowData}' class="btn btn-sm btn-danger btn-delete">delete</button>
            </div>
          `;
        },
      },
    ],
    drawCallback() {
      $(".btn-delete").on("click", deleteSchool);
    },
  });

  function deleteSchool() {
    const rowData = $(this).data("row");

    window.swal
      .fire({
        title: `Are you sure to delete user "${rowData.name}" ?`,
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      })
      .then((result) => {
        if (result.isConfirmed) {
          deleteData("/master/school/" + rowData.id);
        }
      });
  }
});
