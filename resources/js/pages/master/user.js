import { deleteData } from "../../util";

$(function () {
  const table = $("#user").DataTable({
    processing: true,
    serverSide: true,
    ajax: "/api/master/user/datatable",
    buttons: ["add"],
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
        data: "email_verified_at",
        render: function (data) {
          if (!data) return "unverified";
          const date = new Date(data);
          return date.toLocaleString();
        },
      },
      {
        data: "school",
        render: function (data) {
          if (!data) return " - ";
          return data.name;
        },
      },
      {
        data: "roles",
        render: function (data) {
          if (!data) return " - ";
          return data.map((d) => d.name).join(", ");
        },
      },
      {
        data: "id",
        render: function (_, __, row) {
          const rowData = JSON.stringify(row);

          return `
            <div class="d-flex justify-content-center gap-2">
              <a class="btn btn-sm btn-primary" href="/master/user/${row.id}/edit">edit</a>
              <button data-row='${rowData}' class="btn btn-sm btn-danger btn-delete">delete</button>
            </div>
          `;
        },
      },
    ],
    drawCallback() {
      $(".btn-delete").on("click", deleteUser);
    },
  });

  function deleteUser() {
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
          deleteData("/master/user/" + rowData.id);
        }
      });
  }
});
