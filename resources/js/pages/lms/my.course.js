$(function () {
  const table = $("#my-course").DataTable({
    language: {
      paginate: {
        previous: "&larr;",
        next: "&rarr;",
      },
    },
    processing: true,
    serverSide: true,
    ajax: "/api/lms/my/course/datatable",
    buttons: [],
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
          return `
            <div class="d-flex justify-content-center gap-2">
              <a href="/lms/my/course/${row.id}" class="btn btn-sm btn-info">do course</a>
            </div>
          `;
        },
        orderable: false,
      },
    ],
  });
});
