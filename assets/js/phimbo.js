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
// Phần Phim Bộ
//
/////////////////////////////////////
function getttpb(infopb) {
  var getttpbRow = "";
  if (infopb) {
    getttpbRow = `<tr>
          <td class="align-middle"><img src="${infopb.anh}" class="img-thumbnail rounded float-left"></td>
          <td class="align-middle">${infopb.tenphim}</td>
          <td class="align-middle">${infopb.sophan}</td>
          <td class="align-middle">${infopb.tmdb}</td>
          <td class="align-middle"><a class="btn btn-primary btn-sm" href="../admin/season.php?id=${infopb.tmdb}">Season Manager</a></td>
          <td class="align-middle"><a class="btn btn-warning btn-sm editpb" href="#" data-bs-toggle="modal" data-bs-target="#modalpb"
              title="Edit" data-id="${infopb.id}"><i class="fa-solid fa-pencil"></i></a>
            <a class="btn btn-danger btn-sm xoaphimbo" href="#" data-userid="14" title="Xóa" data-id="${infopb.id}"><i class="fa-solid fa-trash"></i></a>
          </td>
        </tr>`;
  }
  return getttpbRow;
}
function phimbo() {
  var pageno = $("#currentpage").val();
  $.ajax({
    url: "/admin/ajax.php",
    type: "GET",
    dataType: "json",
    data: { page: pageno, action: "phimbo" },
    beforeSend: function () {
      $("#overlay").fadeIn();
    },
    success: function (rows) {
      console.log(rows);
      if (rows.ttphimbo) {
        var playerslist = "";
        $.each(rows.ttphimbo, function (index, infopb) {
          playerslist += getttpb(infopb);
        });
        $("#dsphimbo tbody").html(playerslist);
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
  $(document).on("submit", "#addphimbo", function (event) {
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
          $("#modalpb").modal("hide");
          $("#addphimbo")[0].reset();
          $(".message").html(alertmsg).fadeIn().delay(3000).fadeOut();
          phimbo();
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
    phimbo();
    $this.parent().siblings().removeClass("active");
    $this.parent().addClass("active");
  });
  // form reset on new button
  $("#addphimbobtn").on("click", function () {
    $("#addphimbo")[0].reset();
    $("#id").val("");
  });
 //  Sửa phim
  $(document).on("click", "a.editpb", function () {
    var pid = $(this).data("id");

    $.ajax({
      url: "/admin/ajax.php",
      type: "GET",
      dataType: "json",
      data: { id: pid, action: "getphimbo" },
      beforeSend: function () {
        $("#overlay").fadeIn();
      },
      success: function (getpb) {
        if (getpb) {
          $("#tenphim").val(getpb.tenphim);
          $("#tmdb").val(getpb.tmdb);
          $("#anh").val(getpb.anh);
          $("#theloai").val(getpb.theloai);
          $("#anhnen").val(getpb.anhnen);
          $("#sophan").val(getpb.sophan);
          $("#id").val(getpb.id);
        }
        $("#overlay").fadeOut();
      },
      error: function () {
        console.log("something went wrong");
      },
    });
  });
  // delete user
  $(document).on("click", "a.xoaphimbo", function (e) {
    e.preventDefault();
    var pid = $(this).data("id");
    if (confirm("Are you sure you want to delete this Movie?")) {
      $.ajax({
        url: "/admin/ajax.php",
        type: "GET",
        dataType: "json",
        data: { id: pid, action: "xoaphimbo" },
        beforeSend: function () {
          $("#overlay").fadeIn();
        },
        success: function (res) {
          if (res.deleted == 1) {
            $(".message")
              .html("Delete Movie Successfully!")
              .fadeIn()
              .delay(3000)
              .fadeOut();
            phimbo();
            $("#overlay").fadeOut();
          }
        },
        error: function () {
          console.log("Lỗi");
        },
      });
    }
  });
  // searching
  $("#searchinput").on("keyup", function () {
    const searchText = $(this).val();
    if (searchText.length > 1) {
      $.ajax({
        url: "/admin/ajax.php",
        type: "GET",
        dataType: "json",
        data: { searchQuery: searchText, action: "searchpb" },
        success: function (ttphimbo) {
          if (ttphimbo) {
            var playerslist = "";
            $.each(ttphimbo, function (index, infopb) {
              playerslist += getttpb(infopb);
            });
            $("#dsphimbo tbody").html(playerslist);
            $("#pagination").hide();
          }
        },
        error: function () {
          console.log("Lỗi");
        },
      });
    } else {
      phimbo();
      $("#pagination").show();
    }
  });
  // load players
  phimbo();
});