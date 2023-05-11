const modal = new bootstrap.Modal(document.getElementById("modal"));
const modalLabel = $("#modalLabel");
const modalSubmit = $("#modalSubmit");
const modalInputTitle = $('input[name="title"]');

const axios = window.axios.create({
  baseURL: "/api/",
  headers: {
    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
  },
});

function showAddModal() {
  modalLabel.text("Add Quiz");
  modalSubmit.text("Add");
  modalInputTitle.val("");
  modal.show();
}

function editQuiz() {}

$(document).ready(function () {
  const table = $("#quiz").DataTable({
    processing: true,
    serverSide: true,
    ajax: "/api/quiz/datatable",
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
              <a href="/quiz/${row.id}/question" class="btn btn-sm btn-info">add questions</a>
            </div>
          `;
        },
      },
    ],
    drawCallback() {
      $(".btn-delete").click(deleteQuiz);
      $(".btn-edit").click(editQuiz);
    },
  });

  modalSubmit.click(function () {
    axios
      .post("quiz", {
        title: modalInputTitle.val(),
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
});
