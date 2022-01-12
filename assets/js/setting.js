/////////////////////////////////////////////////////////////////////////
//////////   Setting     - Bởi Hậu Nguyễn                   ////////////
///////////////////////////////////////////////////////////////////////
function settingss(setting) {
  var caidat = "";
  var loadz = "";
  var adblock = "";
  var autoplay = "";
  if (setting.loading == 1) {loadz = `checked="checked"`;};
  if (setting.adblock == 1) {adblock = `checked="checked"`;};
  if (setting.autoPlay == 1) {autoplay = `checked="checked"`;};
  if (setting) {
    caidat = `<div class="form-group mb-3 row">
        <label class="form-label col-3 col-form-label"><b>JW player license</b></label>
            <div class="col">
                <input type="text" class="form-control" placeholder="https://content.jwplatform.com/libraries/Jq6HIbgz...." name="jw_license" value="${setting.jw_license}">
                     <small class="form-hint">Add your jw player license</small>
            </div>
         </div>
		 <div class="form-group mb-3 row">
                  <label class="form-label col-3 col-form-label"><b>Loading Play
                  </b></label>
                  <div class="col">
                     <label class="form-check form-switch">
                     <input class="form-check-input" name="loading" type="checkbox" ${loadz} >
                     <span class="form-check-label"></span>
                     </label><small class="form-hint">Enable/Disable video preloader animation</small>
                  </div>
               </div>
		<div class="form-group mb-3 row">
                  <label class="form-label col-3 col-form-label"><b>Detect Ads
                  </b></label>
                  <div class="col">
                     <label class="form-check form-switch">
  <input class="form-check-input" name="adblock" type="checkbox" ${adblock}>
                     <span class="form-check-label"></span>
                     </label>          <small class="form-hint">Enable/Disable Ad Detection</small>
                  </div>
               </div>
		<div class="form-group mb-3 row">
                  <label class="form-label col-3 col-form-label"><b>Auto Play
                  </b></label>
                  <div class="col">
                     <label class="form-check form-switch">
  <input class="form-check-input" name="autoplay" type="checkbox" ${autoplay}>
                     <span class="form-check-label"></span>
                     </label>          <small class="form-hint">Enable/disable video autoplay option (video will be muted)</small>
                  </div>
               </div>
			  <div class="form-group mb-3 row">
                  <label class="form-label col-3 col-form-label"><b>Default video
                  </b></label>
                  <div class="col">
                     <input type="url" class="form-control" placeholder="https://hadpro.me/files/videos/no-content.mp4" name="default_video" value="${setting.default_video}">
                     <small class="form-hint">If some links are broken, this video will play automatically</small>
                  </div>
               </div>
		<div class="form-group mb-3 row">
                  <label class="form-label col-3 col-form-label"><b>Default Image</b>
                  </label>
                  <div class="col">
                     <input type="url" class="form-control" placeholder="https://mydomain.com/uploads/default-banner.png" name="default_banner" value="${setting.default_banner}">
                     <small class="form-hint">Default Poster image in the player</small>
                  </div>
               </div>`;
  }
  return caidat;
}
function showst() {
  $.ajax({
    url: "/admin/ajax.php",
    type: "GET",
    dataType: "json",
    data: {action: "showsettings" },
    beforeSend: function () {
      $("#overlay").fadeIn();
    },
    success: function (rowsp) {
      console.log(rowsp);
      if (rowsp.settings) {
        var playerslist = "";
        $.each(rowsp.settings, function (index, setting) {
          playerslist += settingss(setting);
        });
        $("#listseting #seting").html(playerslist);
        $("#overlay").fadeOut();
      }
    },
    error: function () {
      console.log("Lỗi ! Xin Thử lại");
    },
  });
}
$(document).ready(function () {
  // Show Seting
  showst();
})