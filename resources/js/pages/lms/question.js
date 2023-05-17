import { axios } from "../../util";

const modal = new bootstrap.Modal(document.getElementById("modal"));
const modalLabel = $("#modalLabel");
const modalSubmit = $("#modalSubmit");
const modalInputQuestion = $('input[name="question"]');

function showAddModal() {
  modalLabel.text("Add Question");
  modalSubmit.text("Add");
  modalInputQuestion.val("");
  modal.show();
}

$(function () {
  const table = $("#question").DataTable({
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
              <a href="/lms/question/${row.id}/edit" class="btn btn-sm btn-primary">edit</a>
              <button data-row='${rowData}' class="btn btn-sm btn-danger btn-delete">delete</button>
            </div>
          `;
        },
      },
    ],
    drawCallback() {
      $(".btn-delete").click(deleteQuestion);
    },
  });

  modalSubmit.click(function () {
    axios
      .post("lms/question", {
        question: modalInputQuestion.val(),
      })
      .then(({ data }) => {
        window.swal.fire("Congratulation!", data.message, "success");
        table.ajax.reload();
        modal.hide();
      });
  });

  function deleteQuestion() {
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
          axios.delete(`lms/question/${rowData.id}`).then(({ data }) => {
            window.swal.fire("Deleted!", data.message, "success");
          });
          table.ajax.reload();
        }
      });
  }
});
