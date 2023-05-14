import "./bootstrap";
import "laravel-datatables-vite";
import "https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js";
import "./pages";

import Swal from "sweetalert2/dist/sweetalert2.all.min.js";

if (swalPushData) {
  Swal.fire(swalPushData.title, swalPushData.body, swalPushData.type);
}
$(function () {
  $(".select2").select2({
    theme: "classic",
  });
});
