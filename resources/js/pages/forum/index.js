import Swal from "sweetalert2";
import { axios } from "../../util";

let page = 0;
let feeds = [];
let commentsModal = new bootstrap.Modal(
  document.getElementById("commentsModal"),
  {
    keyboard: false,
  }
);

// Comment
$("#comment-submit").on("click", function () {
  let feed_id = $("#comment").data("feed-id");

  axios
    .post(`/forum/feed/${feed_id}/comment`, { comment: $("#comment").val() })
    .then(({ data }) => {
      console.log(data);

      $("#comment").data("feed-id", null);
      $("#comment").val(null);

      commentsModal.hide();
    });
});

// Render Feeds
// Handlers
function addHandlers() {
  $("#feeds button.btn").off();
  $(".btn-like").on("click", function () {
    let feed_id = $(this).closest(".card").data("id");
    // let feed = feeds.find((feed) => feed.id == card_id);

    axios.post(`/forum/feed/${feed_id}/like`).then(({ data }) => {
      console.log(data);
    });
  });

  $(".btn-dislike").on("click", function () {
    let feed_id = $(this).closest(".card").data("id");
    axios.post(`/forum/feed/${feed_id}/dislike`).then(({ data }) => {
      console.log(data);
    });
  });

  $(".btn-comment").on("click", function () {
    let feed_id = $(this).closest(".card").data("id");
    $("#comment").data("feed-id", feed_id);

    axios.get(`/forum/feed/${feed_id}`).then(({ data }) => {
      console.log(data.data);
      $("#modal-body").html(printFeedModal(data.data));

      data.data.comments.map((comment) =>
        $("#feed-comments").append(printFeedComment(comment))
      );

      commentsModal.show();
    });
  });
}
// Renderrer
function printFeedModal(feed) {
  return `
    <div class="mb-3" data-id="${feed.id}">
        <div class="lead fw-bold">${feed.author.name}</div>
        <div class="text-secondary" style="font-size: .6em;">${Date(
          feed.created_at
        ).toLocaleString()}</div>
        <div class="lead mb-3">
          ${feed.caption}
        </div>
        <div class="images my-3">
          ${feed.images.map(
            (image) => `<img src="${image.uri}" width="100%" alt="Gambar">`
          )}
        </div>
    </div>
    `;
}
function printFeed(feed) {
  return `
    <div class="card shadow mb-3" data-id="${feed.id}">
      <div class="card-header">
        <div class="lead fw-bold">${feed.author.name}</div>
        <div class="text-secondary">${Date(
          feed.created_at
        ).toLocaleString()}</div>
      </div>
      <div class="card-body">
        <div class="lead mb-3">
          ${feed.caption}
        </div>
        <div class="images my-3">
          ${feed.images.map(
            (image) => `<img src="${image.uri}" width="100%" alt="Gambar">`
          )}
        </div>
        <div class="row">
          <div class="col text-center">
            <button class="btn btn-sm btn-like ${
              feed.liked && "btn-primary"
            }">${feed.likes_count} like</button>
          </div>
          <div class="col text-center">
            <button class="btn btn-sm btn-dislike ${
              feed.disliked && "btn-primary"
            }">${feed.dislikes_count} dislike</button>
          </div>
          <div class="col text-center">
            <button class="btn btn-sm btn-comment ${
              feed.comments_count && "btn-primary"
            }">${feed.comments_count} comment</button>
          </div>
          <div class="col text-center">
            <button class="btn btn-sm btn-reload">reload</button>
          </div>
        </div>
      </div>
    </div>
    `;
}
function printFeedComment(comment) {
  return `
    <li class="list-group-item" data-id="${comment.id}">
      <strong>${comment.author_name}</strong>
      <div class="text-secondary" style="font-size: .6em">${comment.created_at}</div>
      <p class="lead mb-0">
        ${comment.comment}
      </p>
    </li>
    `;
}
function appendFeed() {
  // console.log("append feeds");

  axios
    .get("/forum/feed", {
      params: {
        page,
        limit: 5,
      },
    })
    .then(({ data }) => {
      console.log(data.data);
      let cur_feed_ids = feeds.map((feed) => feed.id);
      data.data.map((feed) => {
        if (cur_feed_ids.includes(feed.id)) return;

        feeds.push(feed);
        $("#feeds").append(printFeed(feed));
      });
      addHandlers();
    });
}
appendFeed();
$(window).scroll(function () {
  if (
    Math.ceil($(window).scrollTop() + $(window).height()) >=
    $(document).height()
  ) {
    page++;
    appendFeed();
  }
});

// Add New Feed
function submitFeed() {
  let data = new FormData();
  data.append("image", $("#image").prop("files")[0]);
  data.append("caption", $("#caption").val());

  axios
    .post("/forum/feed", data, {
      headers: { "Content-Type": "multipart/form-data" },
    })
    .then((res) => {
      Swal.fire("Congratulation!", res.message, "success");

      $("#image").val(null);
      $("#caption").val(null);
    })
    .catch((err) => {
      console.error("error :", err);
    });
}
$("#submit-btn").on("click", function () {
  submitFeed();
});
