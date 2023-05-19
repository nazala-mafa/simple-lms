import { deleteData } from "../../util";

$(function () {
  $("#course").DataTable({
    language: {
      paginate: {
        previous: "&larr;",
        next: "&rarr;",
      },
    },
    processing: true,
    serverSide: true,
    ajax: "/api/lms/course/datatable",
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
        data: "is_published",
        render: function (data) {
          return data == "1" ? "Published" : "Draft";
        },
      },
      {
        data: "id",
        render: function (_, __, row) {
          const rowData = JSON.stringify(row);

          return `
            <div class="d-flex justify-content-center gap-2">
              <a class="btn btn-sm btn-primary" href="/lms/course/${row.id}/edit">edit</a>
              <button data-row='${rowData}' class="btn btn-sm btn-danger btn-delete">delete</button>
            </div>
          `;
        },
        orderable: false,
      },
    ],
    drawCallback() {
      $(".btn-delete").on("click", deleteCourse);
    },
  });

  function deleteCourse() {
    const rowData = $(this).data("row");

    window.swal
      .fire({
        title: `Are you sure to delete course "${rowData.name}" ?`,
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      })
      .then((result) => {
        if (result.isConfirmed) {
          deleteData("/lms/course/" + rowData.id);
        }
      });
  }
});
