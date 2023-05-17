import { confirmDelete, deleteData } from "../../util";

$(".btn-del").click(function () {
  confirmDelete(() => deleteData($(this).attr("action")));
});
