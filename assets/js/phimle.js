// get pagination
function pagination(totalpages, currentpage) {
  var pagelist = "";
  if (totalpages > 1) {
    currentpage = parseInt(currentpage);
    pagelist += `<ul class="pagination justify-content-center">`;
    const prevClass = currentpage == 1 ? " disabled" : "";
    pagelist += `<li class="page-item${prevClass}"><a class="page-link" href="#" data-page="${
      currentpage - 1
    }">Previous</a></li>`;
    for (let p = 1; p <= totalpages; p++) {
      const activeClass = currentpage == p ? " active" : "";
      pagelist += `<li class="page-item${activeClass}"><a class="page-link" href="#" data-page="${p}">${p}</a></li>`;
    }
    const nextClass = currentpage == totalpages ? " disabled" : "";
    pagelist += `<li class="page-item${nextClass}"><a class="page-link" href="#" data-page="${
      currentpage + 1
    }">Next</a></li>`;
    pagelist += `</ul>`;
  }

  $("#pagination").html(pagelist);
}
/////////////////////////////////////////////////////////////////////////
//////////    Phim lẻ    - Bởi Hậu Nguyễn                   ////////////
///////////////////////////////////////////////////////////////////////
// Danh Sách Phim Lẻ
function getplayerrow(player) {
  var playerRow = "";
  if (player) {
    playerRow = `<tr>
          <td class="align-middle"><img src="${player.anh}" class="img-thumbnail rounded float-left"></td>
          <td class="align-middle">${player.tenphim}</td>
          <td class="align-middle">${player.imdb}</td>
          <td class="align-middle">${player.tmdb}</td>
          <td class="align-middle"><a class="btn btn-primary btn-sm" href="../movie.php?id=${player.tmdb}" target="_blank">Direct Links</a></td>
          <td class="align-middle"><a class="btn btn-success btn-sm manhung" href="#" data-bs-toggle="modal" data-bs-target="#userViewModal"
              title="Prfile" data-id="${player.id}">Embed Code</a></td>
          <td class="align-middle"><a class="btn btn-warning btn-sm edituser" href="#" data-bs-toggle="modal" data-bs-target="#userModal"
              title="Edit" data-id="${player.id}"><i class="fa-solid fa-pencil"></i></a>
            <a class="btn btn-danger btn-sm xoaphimle" href="#" data-userid="14" title="Delete" data-id="${player.id}"><i class="fa-solid fa-trash"></i></a>
          </td>
        </tr>`;
  }
  return playerRow;
}

function phimle() {
  var pageno = $("#currentpage").val();
  $.ajax({
    url: "/admin/ajax.php",
    type: "GET",
    dataType: "json",
    data: { page: pageno, action: "phimle" },
    beforeSend: function () {
      $("#overlay").fadeIn();
    },
    success: function (rows) {
      console.log(rows);
      if (rows.movie) {
        var playerslist = "";
        $.each(rows.movie, function (index, player) {
          playerslist += getplayerrow(player);
        });
        $("#userstable tbody").html(playerslist);
        let totalPlayers = rows.count;
        let totalpages = Math.ceil(parseInt(totalPlayers) / 4);
        const currentpage = $("#currentpage").val();
        pagination(totalpages, currentpage);
        $("#overlay").fadeOut();
      }
    },
    error: function () {
      console.log("Error ! Please Try Again");
    },
  });
}

$(document).ready(function () {
  // add/edit user
  $(document).on("submit", "#addform", function (event) {
    event.preventDefault();
    var alertmsg =
      $("#id").val().length > 0
        ? "Movie Edited Successfully !"
        : "Added Success Movie !";
    $.ajax({
      url: "/admin/ajax.php",
      type: "POST",
      dataType: "json",
      data: new FormData(this),
      processData: false,
      contentType: false,
      beforeSend: function () {
        $("#overlay").fadeIn();
      },
      success: function (response) {
        console.log(response);
        if (response) {
          $("#userModal").modal("hide");
          $("#addform")[0].reset();
          $(".message").html(alertmsg).fadeIn().delay(3000).fadeOut();
          phimle();
          $("#overlay").fadeOut();
        }
      },
      error: function () {
        console.log("OH ! Something went wrong");
      },
    });
  });
  // pagination
  $(document).on("click", "ul.pagination li a", function (e) {
    e.preventDefault();
    var $this = $(this);
    const pagenum = $this.data("page");
    $("#currentpage").val(pagenum);
    phimle();
    $this.parent().siblings().removeClass("active");
    $this.parent().addClass("active");
  });
  // form reset on new button
  $("#addnewbtn").on("click", function () {
    $("#addform")[0].reset();
    $("#id").val("");
  });
  //  get user

  $(document).on("click", "a.edituser", function () {
    var pid = $(this).data("id");

    $.ajax({
      url: "/admin/ajax.php",
      type: "GET",
      dataType: "json",
      data: { id: pid, action: "getphimle" },
      beforeSend: function () {
        $("#overlay").fadeIn();
      },
      success: function (player) {
        if (player) {
          $("#tenphim").val(player.tenphim);
          $("#tmdb").val(player.tmdb);
          $("#imdb").val(player.imdb);
          $("#anh").val(player.anh);
          $("#theloai").val(player.theloai);
          $("#anhnen").val(player.anhnen);
          $("#link").val(player.hlink);
          $("#link1").val(player.link1);
          $("#link2").val(player.link2);
          $("#link3").val(player.link3);
          $("#link4").val(player.link4);
          $("#id").val(player.id);
        }
        $("#overlay").fadeOut();
      },
      error: function () {
        console.log("something went wrong");
      },
    });
  });

  // delete user
  $(document).on("click", "a.xoaphimle", function (e) {
    e.preventDefault();
    var pid = $(this).data("id");
    if (confirm("Are you sure you want to delete this Movie ?")) {
      $.ajax({
        url: "/admin/ajax.php",
        type: "GET",
        dataType: "json",
        data: { id: pid, action: "xoaphimle" },
        beforeSend: function () {
          $("#overlay").fadeIn();
        },
        success: function (res) {
          if (res.deleted == 1) {
            $(".message")
              .html("Delete Movie Successfully !")
              .fadeIn()
              .delay(3000)
              .fadeOut();
            phimle();
            $("#overlay").fadeOut();
          }
        },
        error: function () {
          console.log("Lỗi");
        },
      });
    }
  });
  // get Mã Nhúng

  $(document).on("click", "a.manhung", function () {
    var pid = $(this).data("id");
	var url      = window.location.href;
    $.ajax({
      url: "/admin/ajax.php",
      type: "GET",
      dataType: "json",
      data: { id: pid, action: "getphimle" },
      success: function (player) {
        if (player) {
          const manhung = `<textarea class="form-control" rows="5" autofocus="autofocus" onclick="this.select()">&lt;iframe src="${url}/movie.php?id=${player.tmdb}" frameborder="0" width="100%" height="100%" allowfullscreen="allowfullscreen"&gt; &lt;/iframe&gt;</textarea>`;
          $("#manhung").html(manhung);
        }
      },
      error: function () {
        console.log("Lỗi");
      },
    });
  });

  // searching
  $("#searchinput").on("keyup", function () {
    const searchText = $(this).val();
    if (searchText.length > 1) {
      $.ajax({
        url: "/admin/ajax.php",
        type: "GET",
        dataType: "json",
        data: { searchQuery: searchText, action: "search" },
        success: function (movie) {
          if (movie) {
            var playerslist = "";
            $.each(movie, function (index, player) {
              playerslist += getplayerrow(player);
            });
            $("#userstable tbody").html(playerslist);
            $("#pagination").hide();
          }
        },
        error: function () {
          console.log("Lỗi");
        },
      });
    } else {
      phimle();
      $("#pagination").show();
    }
  });
  // load players
  phimle();
});
