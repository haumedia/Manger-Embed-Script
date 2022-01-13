/* 
    Season By HauN
	facebook : https://www.facebook.com/haun.ytb/
	youtube  : https://www.youtube.com/c/HauNE
*/

function getseason(infoseason) {
  var getseasonRow = "";
  if (infoseason) {
    getseasonRow = `<tr>
          <td class="align-middle"><img src="${infoseason.anh}" class="img-thumbnail rounded float-left"></td>
          <td class="align-middle">${infoseason.tenphim}</td>
          <td class="align-middle">Season ${infoseason.idphan}</td>
          <td class="align-middle">${infoseason.tmdb}</td>
          <td class="align-middle"><a class="btn btn-primary btn-sm" href="../admin/episode.php?id=${infoseason.tmdb}&s=${infoseason.idphan}">Episode Manager</a></td>
          <td class="align-middle"><a class="btn btn-warning btn-sm editpb" href="#" data-bs-toggle="modal" data-bs-target="#modalseason"
              title="Edit" data-id="${infoseason.id}"><i class="fa-solid fa-pencil"></i></a>
            <a class="btn btn-danger btn-sm delseason" href="#" data-userid="14" title="Delete" data-id="${infoseason.id}"><i class="fa-solid fa-trash"></i></a>
          </td>
        </tr>`;
  }
  return getseasonRow;
}
function season() {
	let searchParams = new URLSearchParams(window.location.search);
    let pid = searchParams.get('id')
  $.ajax({
    url: "../admin/ajax.php",
    type: "GET",
    dataType: "json",
    data: {id: pid, action: "season" },
    beforeSend: function () {
      $("#overlay").fadeIn();
    },
    success: function (rows) {
      console.log(rows);
      if (rows.ttseason) {
        var playerslist = "";
        $.each(rows.ttseason, function (index, infoseason) {
          playerslist += getseason(infoseason);
        });
        $("#dsseason tbody").html(playerslist);
        let totalPlayers = rows.count;
        let totalpages = Math.ceil(parseInt(totalPlayers) / 4);
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
  $(document).on("submit", "#addseason", function (event) {
    event.preventDefault();
    var alertmsg =
      $("#id").val().length > 0
        ? "Movie Edited Successfully !"
        : "Added Success Movie !";
    $.ajax({
      url: "../admin/ajax.php",
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
          $("#modalseason").modal("hide");
          $("#addseason")[0].reset();
          $(".message").html(alertmsg).fadeIn().delay(3000).fadeOut();
          season();
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
    season();
    $this.parent().siblings().removeClass("active");
    $this.parent().addClass("active");
  });
  // form reset on new button
  $("#addseasonbtn").on("click", function () {
    $("#addseason")[0].reset();
    $("#id").val("");
  });
 //  Sửa phim
  $(document).on("click", "a.editpb", function () {
    var pid = $(this).data("id");

    $.ajax({
      url: "../admin/ajax.php",
      type: "GET",
      dataType: "json",
      data: { id: pid, action: "getseason" },
      beforeSend: function () {
        $("#overlay").fadeIn();
      },
      success: function (getseason) {
        if (getseason) {
          $("#tenphim").val(getseason.tenphim);
          $("#tmdb").val(getseason.tmdb);
          $("#anh").val(getseason.anh);
          $("#idphan").val(getseason.idphan);
          $("#id").val(getseason.id);
        }
        $("#overlay").fadeOut();
      },
      error: function () {
        console.log("something went wrong");
      },
    });
  });
  // delete user
  $(document).on("click", "a.delseason", function (e) {
    e.preventDefault();
    var pid = $(this).data("id");
    if (confirm("Are you sure you want to delete this Movie?")) {
      $.ajax({
        url: "../admin/ajax.php",
        type: "GET",
        dataType: "json",
        data: { id: pid, action: "delseason" },
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
            season();
            $("#overlay").fadeOut();
          }
        },
        error: function () {
          console.log("Lỗi");
        },
      });
    }
  });
  // load season
  season();
});