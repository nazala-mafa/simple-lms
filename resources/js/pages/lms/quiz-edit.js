import { axios } from "../../util";

const quiz_id = window.location.pathname.split("/")[3];

$(function () {
  const schoolQuestions = $("#school-questions").DataTable({
    processing: true,
    serverSide: true,
    ajax: "/api/lms/question/datatable",
    buttons: [
      {
        text: "<u>N</u>ew",
        key: {
          key: "N",
          altKey: true,
        },
        action: () => {
          // showAddModal();
        },
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
        data: "question",
      },
      {
        data: "id",
        render: function (_, __, row) {
          const rowData = JSON.stringify(row);

          return `
            <div class="d-flex justify-content-center gap-2">
              <button data-row='${rowData}' class="btn btn-sm btn-primary btn-add">add question</button>
            </div>
          `;
        },
      },
    ],
    drawCallback() {
      $(".btn-add").click(addQuestion);
    },
  });

  const quizQuestions = $("#quiz-questions").DataTable({
    processing: true,
    serverSide: true,
    ajax: `/api/lms/quiz/${quiz_id}/question/datatable`,
    columns: [
      {
        data: "id",
        render: function (_, __, ___, meta) {
          return meta.row + meta.settings._iDisplayStart + 1;
        },
      },
      {
        data: "question",
      },
      {
        data: "id",
        render: function (_, __, row) {
          const rowData = JSON.stringify(row);

          return `
            <div class="d-flex justify-content-center gap-2">
              <button data-row='${rowData}' class="btn btn-sm btn-primary btn-remove">remove question</button>
            </div>
          `;
        },
      },
    ],
    drawCallback() {
      $(".btn-remove").click(removeQuestion);
    },
  });

  function addQuestion() {
    const question_id = $(this).data("row").id;
    axios
      .post("/lms/quiz/question/add", { quiz_id, question_id })
      .then(({ data }) => {
        window.swal.fire("Congratulation!", data.message, "success");
        quizQuestions.ajax.reload();
      });
  }

  function removeQuestion() {
    const question_id = $(this).data("row").id;
    axios
      .delete("/lms/quiz/question/remove", {
        data: { quiz_id, question_id },
      })
      .then(({ data }) => {
        window.swal.fire("Congratulation!", data.message, "success");
        quizQuestions.ajax.reload();
      });
  }
});
