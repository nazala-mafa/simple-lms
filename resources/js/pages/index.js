if (window.location.pathname === "/product") {
  import("./product");
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
if (window.location.pathname.match(/^\/lms\/course\/([^/]+)\/edit$/)) {
  import("./lms/course.edit");
}
if (window.location.pathname === "/lms/quiz") {
  import("./lms/quiz");
}
if (window.location.pathname.match(/^\/lms\/quiz\/([^/]+)\/edit$/)) {
  import("./lms/quiz-edit");
}
if (window.location.pathname === "/lms/question") {
  import("./lms/question");
}
if (window.location.pathname.match(/^\/lms\/question\/([^/]+)\/edit$/)) {
  import("./lms/question-edit");
}
// === My
if (window.location.pathname.match(/^\/lms\/my\/course$/)) {
  import("./lms/my.course");
}
if (window.location.pathname.match(/^\/lms\/my\/course\/([^/]+)$/)) {
  import("./lms/my.course.show");
}
