if (window.location.pathname === "/product") {
  import("./product");
}

if (window.location.pathname === "/quiz") {
  import("./quiz");
}

if (
  window.location.pathname.split("/")[1] === "quiz" &&
  window.location.pathname.split("/")[3] === "question"
) {
  import("./question");
}

// == Master
if (window.location.pathname === "/master/user") {
  import("./master/user");
}
if (window.location.pathname === "/master/school") {
  import("./master/school");
}

// == LMS
if (window.location.pathname === "/lms/course") {
  import("./lms/course");
}
if (
  window.location.pathname.split("/")[1] === "lms" &&
  window.location.pathname.split("/")[2] === "course" &&
  window.location.pathname.split("/")[4] === "edit"
) {
  import("./lms/course.edit");
}
if (window.location.pathname === "/lms/quiz") {
  import("./lms/quiz");
}
if (
  window.location.pathname.split("/")[1] === "lms" &&
  window.location.pathname.split("/")[2] === "quiz" &&
  window.location.pathname.split("/")[4] === "edit"
) {
  import("./lms/quiz-edit");
}
if (window.location.pathname === "/lms/question") {
  import("./lms/question");
}
