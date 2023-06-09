$(function () {
  const course_id = window.location.pathname.split("/")[4];

  const table = $("#my-course-activity").DataTable({
    language: {
      paginate: {
        previous: "&larr;",
        next: "&rarr;",
      },
    },
    processing: true,
    serverSide: true,
    ajax: `/api/lms/my/course/${course_id}/activity/datatable`,
    buttons: [],
    columns: [
      {
        data: "activity.id",
        render: function (_, __, ___, meta) {
          return meta.row + meta.settings._iDisplayStart + 1;
        },
      },
      {
        data: "data.title",
      },
      {
        data: "activity.id",
        render: function (_, __, row) {
          return `
            <div class="d-flex justify-content-center gap-2">
              <a href="/lms/my/course/${course_id}/activity/${row.activity.id}" class="btn btn-sm btn-info">do course</a>
            </div>
          `;
        },
        orderable: false,
      },
    ],
  });
});
