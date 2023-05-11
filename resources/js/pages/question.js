const modal = new bootstrap.Modal(document.getElementById("modal"));
const modalLabel = $("#modalLabel");
const modalSubmit = $("#modalSubmit");
const modalInputTitle = $('input[name="question"]');

const answerModal = new bootstrap.Modal(document.getElementById("answerModal"));
const answerModalLabel = $("#answerModalLabel");
const answerModalSubmit = $("#answerModalSubmit");
const answerModalInputAnswer = $('input[name="answer"]');
const answerModalInputIsTrue = $('select[name="is_true"]');

const axios = window.axios.create({
  baseURL: "/api/",
  headers: {
    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
  },
});

const quiz_id = window.location.pathname.split("/")[2];
let question_id = null;

function showAddModal() {
  modalLabel.text("Add Question");
  modalSubmit.text("Add");
  modalInputTitle.val("");
  modal.show();
}

function showAnswer() {
  const rowData = $(this).data("row");
  question_id = rowData.id;
  answerModalLabel.text("Add Answer");
  answerModalSubmit.text("Add");
  answerModalInputAnswer.val("");
  answerModalInputIsTrue.val("0");
  answerModal.show();

  const answersHtml = `
    <ul class="list-group">
      ${rowData.answers
        .map(
          (a) =>
            `<li class="list-group-item">${a.answer} - ${
              a.is_true ? "true" : "false"
            }</li>`
        )
        .join("")}
    </ul>
  `;

  $("#answers").html(answersHtml);
}

function editQuiz() {}

$(document).ready(function () {
  const table = $("#question").DataTable({
    processing: true,
    serverSide: true,
    ajax: `/api/quiz/${quiz_id}/question/datatable`,
    buttons: [
      {
        text: "<u>N</u>ew",
        key: {
          key: "N",
          altKey: true,
        },
        action: () => {
          showAddModal();
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
              <button data-row='${rowData}' class="btn btn-sm btn-primary btn-edit">edit</button>
              <button data-row='${rowData}' class="btn btn-sm btn-danger btn-delete">delete</button>
              <button data-row='${rowData}' class="btn btn-sm btn-info btn-show-answer">show answers</a>
            </div>
          `;
        },
      },
    ],
    drawCallback() {
      $(".btn-delete").click(deleteQuiz);
      $(".btn-edit").click(editQuiz);
      $(".btn-show-answer").click(showAnswer);
    },
  });

  modalSubmit.click(function () {
    axios
      .post(`quiz/${quiz_id}/question`, {
        question: modalInputTitle.val(),
      })
      .then(({ data }) => {
        window.swal.fire("Congratulation!", data.message, "success");
        table.ajax.reload();
        modal.hide();
      });
  });

  function deleteQuiz() {
    window.swal
      .fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      })
      .then((result) => {
        if (result.isConfirmed) {
          const rowData = $(this).data("row");
          axios.delete("quiz/" + rowData.id).then(({ data }) => {
            window.swal.fire("Deleted!", data.message, "success");
          });
          table.ajax.reload();
        }
      });
  }

  answerModalSubmit.click(function () {
    if (!answerModalInputAnswer.val() || !answerModalInputIsTrue.val()) return;

    axios
      .post(`quiz/${quiz_id}/question/${question_id}/answer`, {
        answer: answerModalInputAnswer.val(),
        is_true: answerModalInputIsTrue.val(),
      })
      .then(({ data }) => {
        window.swal.fire("Congratulation!", data.message, "success");
        table.ajax.reload();
        modal.hide();
      });
  });
});
