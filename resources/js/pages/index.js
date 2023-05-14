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

if (window.location.pathname === "/master/user") {
  import("./master/user");
}

if (window.location.pathname === "/master/school") {
  import("./master/school");
}