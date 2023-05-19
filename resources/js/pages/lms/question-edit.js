import { confirmDelete, deleteData } from "../../util";

$(".btn-del").on("click", function () {
  confirmDelete(() => deleteData($(this).attr("action")));
});
