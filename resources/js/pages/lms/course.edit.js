const course_id = window.location.pathname.split("/")[3];

function searchFor(type) {
  $("._select2").select2({
    ajax: {
      url: "/api/lms/course/activity?type=" + type,
      dataType: "json",
      placeholder: "Select a activity",
      allowClear: true,
    },
  });

  $("._select2").val("");
}

$(".activity-tabs").on("click", function () {
  if (!$(this).hasClass("active")) {
    $(".activity-tabs").removeClass("active");
    $(this).addClass("active");

    const type = $(this).data("type");
    searchFor(type);
    $('input[name="model_type"]').val(type);
  }
});

searchFor("quizzes");
