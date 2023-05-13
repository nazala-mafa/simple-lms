import "./bootstrap";
import "laravel-datatables-vite";

import "./pages";

import Swal from "sweetalert2";
if (swalPushData) {
  Swal.fire(swalPushData.title, swalPushData.body, swalPushData.type);
}
