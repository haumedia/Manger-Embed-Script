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
function getepisoderow(episode) {
  var episodeRow = "";
  if (episode) {
    episodeRow = `<tr>
          <td class="align-middle">Episode ${episode.tentap}</td>
          <td class="align-middle">Season ${episode.tenphan}</td>
          <td class="align-middle">${episode.tmdb}</td>
          <td class="align-middle"><a class="btn btn-primary btn-sm" href="../tvseries.php?id=${episode.tmdb}&s=${episode.tenphan}&e=${episode.tentap}" target="_blank">Direct Links</a></td>
          <td class="align-middle"><a class="btn btn-success btn-sm embedcodee" href="#" data-bs-toggle="modal" data-bs-target="#userViewModal"
              title="Prfile" data-id="${episode.id}">Embed Code</a></td>
          <td class="align-middle"><a class="btn btn-warning btn-sm edituser" href="#" data-bs-toggle="modal" data-bs-target="#userModal"
              title="Edit" data-id="${episode.id}"><i class="fa-solid fa-pencil"></i></a>
            <a class="btn btn-danger btn-sm delepisode" href="#" data-userid="14" title="Delete" data-id="${episode.id}"><i class="fa-solid fa-trash"></i></a>
          </td>
        </tr>`;
  }
  return episodeRow;
}

function episode() {
	let searchParams = new URLSearchParams(window.location.search);
    let pid = searchParams.get('id');
    let sss = searchParams.get('s');
	console.log(pid);
	console.log(sss);
    var pageno = $("#currentpage").val();
  $.ajax({
    url: "../admin/ajax.php",
    type: "GET",
    dataType: "json",
    data: {id: pid, s: sss, page: pageno, action: "episode" },
    beforeSend: function () {
      $("#overlay").fadeIn();
    },
    success: function (rows) {
      console.log(rows);
      if (rows.episodess) {
        var episodeslist = "";
        $.each(rows.episodess, function (index, episode) {
          episodeslist += getepisoderow(episode);
        });
        $("#listepisode tbody").html(episodeslist);
        let totalepisodes = rows.count;
        let totalpages = Math.ceil(parseInt(totalepisodes) / 4);
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
  $(document).on("submit", "#addformepisode", function (event) {
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
          $("#addformepisode")[0].reset();
          $(".message").html(alertmsg).fadeIn().delay(3000).fadeOut();
          episode();
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
    episode();
    $this.parent().siblings().removeClass("active");
    $this.parent().addClass("active");
  });
  // form reset on new button
  $("#addnewbtn").on("click", function () {
    $("#addformepisode")[0].reset();
    $("#id").val("");
  });
  //  get user

  $(document).on("click", "a.edituser", function () {
    var pid = $(this).data("id");

    $.ajax({
      url: "../admin/ajax.php",
      type: "GET",
      dataType: "json",
      data: { id: pid, action: "getepisode" },
      beforeSend: function () {
        $("#overlay").fadeIn();
      },
      success: function (episode) {
        if (episode) {
          $("#tentap").val(episode.tentap);
          $("#tenphan").val(episode.tenphan);
          $("#tmdb").val(episode.tmdb);
          $("#link").val(episode.hlink);
          $("#link1").val(episode.link1);
          $("#link2").val(episode.link2);
          $("#link3").val(episode.link3);
          $("#link4").val(episode.link4);
          $("#id").val(episode.id);
        }
        $("#overlay").fadeOut();
      },
      error: function () {
        console.log("something went wrong");
      },
    });
  });

  // delete user
  $(document).on("click", "a.delepisode", function (e) {
    e.preventDefault();
    var pid = $(this).data("id");
    if (confirm("Are you sure you want to delete this Movie ?")) {
      $.ajax({
        url: "/admin/ajax.php",
        type: "GET",
        dataType: "json",
        data: { id: pid, action: "delepisode" },
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
            episode();
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

  $(document).on("click", "a.embedcodee", function () {
    var pid = $(this).data("id");
	var url   = window.location.origin; 
    $.ajax({
      url: "../admin/ajax.php",
      type: "GET",
      dataType: "json",
      data: { id: pid, action: "getepisode" },
      success: function (episode) {
        if (episode) {
          const manhung = `<textarea class="form-control" rows="5" autofocus="autofocus" onclick="this.select()">&lt;iframe src="${url}/tvseries.php?id=${episode.tmdb}&s=${episode.tenphan}&e=${episode.tentap}" frameborder="0" width="100%" height="100%" allowfullscreen="allowfullscreen"&gt; &lt;/iframe&gt;</textarea>`;
          $("#embedcodee").html(manhung);
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
        url: "../admin/ajax.php",
        type: "GET",
        dataType: "json",
        data: { searchQuery: searchText, action: "searchepisode" },
        success: function (episodes) {
          if (episodes) {
            var episodeslist = "";
            $.each(episodes, function (index, episode) {
              episodeslist += getepisoderow(episode);
            });
            $("#userstable tbody").html(episodeslist);
            $("#pagination").hide();
          }
        },
        error: function () {
          console.log("Lỗi");
        },
      });
    } else {
      episode();
      $("#pagination").show();
    }
  });
  // load episodes
  episode();
});
