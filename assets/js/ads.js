/////////////////////////////////////////////////////////////////////////
//////////   Quảng Cáo     - Bởi Hậu Nguyễn                 ////////////
///////////////////////////////////////////////////////////////////////
function listadss(ads) {
  var listadsz = "";
  if (ads) {
    listadsz = `<tr>
          <td class="align-middle">${ads.id}</td>
          <td class="align-middle">${ads.advast}</td>
          <td class="align-middle">${ads.adpopup}</td>
          <td class="align-middle"><a class="btn btn-warning btn-sm addadss" href="#" data-bs-toggle="modal" data-bs-target="#addadsw"
              title="Edit" data-id="${ads.id}"><i class="fa-solid fa-pencil"></i></a>
            <a class="btn btn-danger btn-sm xoaads" href="#" data-userid="14" title="Xóa" data-id="${ads.id}"><i class="fa-solid fa-trash"></i></a>
          </td>
        </tr>`;
  }
  return listadsz;
}
function listadsa() {
  $.ajax({
    url: "/admin/ajax.php",
    type: "GET",
    dataType: "json",
    data: {action: "listadds" },
    beforeSend: function () {
      $("#overlay").fadeIn();
    },
    success: function (rowsp) {
      console.log(rowsp);
      if (rowsp.listadsz) {
        var playerslist = "";
        $.each(rowsp.listadsz, function (index, ads) {
          playerslist += listadss(ads);
        });
        $("#listadsb tbody").html(playerslist);
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
  $(document).on("submit", "#addformads", function (event) {
    event.preventDefault();
    var alertmsg =
      $("#id").val().length > 0
        ? "Edited Ads Successfully !"
        : "Successfully Added Ads !";
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
          $("#addadsw").modal("hide");
          $("#addformads")[0].reset();
          $(".message").html(alertmsg).fadeIn().delay(3000).fadeOut();
          listadsa();
          $("#overlay").fadeOut();
        }
      },
      error: function () {
        console.log("OH ! Something went wrong!");
      },
    });
  });
	 // Sửa ADS

  $(document).on("click", "a.addadss", function () {
    var pid = $(this).data("id");

    $.ajax({
      url: "/admin/ajax.php",
      type: "GET",
      dataType: "json",
      data: { id: pid, action: "getad" },
      beforeSend: function () {
        $("#overlay").fadeIn();
      },
      success: function (ads) {
        if (ads) {
          $("#advast").val(ads.advast);
          $("#adpopup").val(ads.adpopup);
          $("#id").val(ads.id);
        }
        $("#overlay").fadeOut();
      },
      error: function () {
        console.log("something went wrong");
      },
    });
  });
  // Xóa ADS
  $(document).on("click", "a.xoaads", function (e) {
    e.preventDefault();
    var pid = $(this).data("id");
    if (confirm("Are you sure you want to delete this Ad? ?")) {
      $.ajax({
        url: "/admin/ajax.php",
        type: "GET",
        dataType: "json",
        data: { id: pid, action: "xoaad" },
        beforeSend: function () {
          $("#overlay").fadeIn();
        },
        success: function (res) {
          if (res.deleted == 1) {
            $(".message")
              .html("Remove Ads Successfully !")
              .fadeIn()
              .delay(3000)
              .fadeOut();
            listadsa();
            $("#overlay").fadeOut();
          }
        },
        error: function () {
          console.log("Lỗi");
        },
      });
    }
  });
    // reset ads
  $("#addnewads").on("click", function () {
    $("#addformads")[0].reset();
    $("#id").val("");
  });
  // load Ads
  listadsa();
})