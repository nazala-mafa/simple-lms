let modal = new bootstrap.Modal(document.getElementById("modal"));

$(document).ready(function () {
  const table = $("#products").DataTable({
    processing: true,
    serverSide: true,
    ajax: "/api/product/datatable",
    buttons: [
      {
        text: "<u>N</u>ew",
        key: {
          key: "N",
          altKey: true,
        },
        action: () => {
          modal.show();

          Livewire.emit("input", "modelTitle", "new value");
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
        data: "name",
      },
      {
        data: "id",
        render: function (_, __, row) {
          const rowData = JSON.stringify(row);

          return `
            <div class="d-flex justify-content-center gap-2">
              <button data-row='${rowData}' class="btn btn-sm btn-primary btn-edit">edit</button>
              <button data-row='${rowData}' class="btn btn-sm btn-danger btn-delete">delete</button>
            </div>
          `;
        },
      },
    ],
  });
});
