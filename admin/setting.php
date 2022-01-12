<?php 
// Get Loading & Adblock
$setting = $conn->prepare("SELECT * FROM `settings`");
$setting->execute();
$st = $setting->fetch();
$adblock = (!empty($st['adblock'])) ? $st['adblock'] : '';
$loading = (!empty($st['loading'])) ? $st['loading'] : ''; 
$jw_license = (!empty($st['jw_license'])) ? $st['jw_license'] : ''; 
$autoplay = (!empty($st['autoPlay'])) ? $st['autoPlay'] : ''; 
$default_video = (!empty($st['default_video'])) ? $st['default_video'] : ''; 
$default_banner = (!empty($st['default_banner'])) ? $st['default_banner'] : ''; 
if (isset($_POST['update'])) {		
		$loadinga = isset($_POST['loading']) == 'on' ? 1 : 0;
		$adblocka = isset($_POST['adblock']) == 'on' ? 1 : 0;
		$autoplaya = isset($_POST['autoplay']) == 'on' ? 1 : 0;
		$default_videoa = (!empty($_POST['default_video'])) ? $_POST['default_video'] : '';
		$default_bannera = (!empty($_POST['default_banner'])) ? $_POST['default_banner'] : '';
		$jw_licensea = (!empty($_POST['jw_license'])) ? $_POST['jw_license'] : '';
	try {
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE settings SET adblock='$adblocka',default_video='$default_videoa',jw_license='$jw_licensea',default_banner='$default_bannera',loading='$loadinga',autoPlay='$autoplaya'";
		$stmt = $conn->prepare($sql);
		$stmt->execute();
            // hiển thị thông báo Update thành công
        echo "<div class='alert alert-success text-center'>Update successful</div>";
} catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}
        $conn = null;
	}
?> 
      <!-- add/edit form modal -->
  <div class="card">
         <div class="card-header">
            <h3 class="card-title">General settings</h3>
         </div>
         <div class="card-body" id="listseting">
                    <form action="" method="post" enctype="multipart/form-data">
                <div id="seting"></div>
               <div class="form-footer text-right">
                  <button type="submit" name="update" class="btn btn-primary">Save</button>
               </div>
            </form>
         </div>
      </div>