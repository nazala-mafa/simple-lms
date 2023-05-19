import { axios } from "../../util";

const modal = new bootstrap.Modal(document.getElementById("modal"));
const modalLabel = $("#modalLabel");
const modalSubmit = $("#modalSubmit");
const modalInputTitle = $('input[name="title"]');

let update_quiz_id = null;

function showAddModal() {
  update_quiz_id = null;
  modalLabel.text("Add Quiz");
  modalSubmit.text("Add");
  modalInputTitle.val("");
  modal.show();
}

function editQuiz() {
  const data = $(this).data("row");
  update_quiz_id = data.id;
  modalLabel.text("Update Quiz");
  modalSubmit.text("Update");
  modalInputTitle.val(data.title);
  modal.show();
}

$(function () {
  const table = $("#quiz").DataTable({
    language: {
      paginate: {
        previous: "&larr;",
        next: "&rarr;",
      },
    },
    processing: true,
    serverSide: true,
    ajax: "/api/lms/quiz/datatable",
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
        data: "title",
      },
      {
        data: "id",
        render: function (_, __, row) {
          const rowData = JSON.stringify(row);

          return `
            <div class="d-flex justify-content-center gap-2">
              <button data-row='${rowData}' class="btn btn-sm btn-primary btn-edit">edit</button>
              <button data-row='${rowData}' class="btn btn-sm btn-danger btn-delete">delete</button>
              <a href="/lms/quiz/${row.id}/edit" class="btn btn-sm btn-info">setting questions</a>
            </div>
          `;
        },
        orderable: false,
      },
    ],
    drawCallback() {
      $(".btn-delete").click(deleteQuiz);
      $(".btn-edit").click(editQuiz);
    },
  });

  modalSubmit.click(function () {
    if (modalLabel.text() == "Add Quiz" && update_quiz_id) {
      axios
        .post("lms/quiz", {
          title: modalInputTitle.val(),
        })
        .then(({ data }) => {
          window.swal.fire("Congratulation!", data.message, "success");
          table.ajax.reload();
          modal.hide();
        });
    } else {
      axios
        .patch("lms/quiz/" + update_quiz_id, {
          title: modalInputTitle.val(),
        })
        .then(({ data }) => {
          window.swal.fire("Congratulation!", data.message, "success");
          table.ajax.reload();
          modal.hide();
        });
    }
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
          axios.delete("lms/quiz/" + rowData.id).then(({ data }) => {
            window.swal.fire("Deleted!", data.message, "success");
          });
          table.ajax.reload();
        }
      });
  }
});
