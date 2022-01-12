<?php
if(empty($_SESSION)) session_start();
require_once('includes/Database.php');
require_once('includes/functions.php');
require_once('includes/packer.php');
$dbClass = new Database();
$conn = $dbClass->getDb(); 
$id = (isset($_GET['id'])) ? $_GET['id'] : '';
// Lấy Thông Tin Player
	$sql = $conn->prepare("SELECT * FROM `movies` WHERE `tmdb`='$id'");
		$sql->execute();
		$fetch = $sql->fetch();	
		$moviestitle = (!empty($fetch['tenphim'])) ? $fetch['tenphim'] : '';
		$url = (!empty($fetch['hlink'])) ? $fetch['hlink'] : '';
		$url1 = (!empty($fetch['link1'])) ? $fetch['link1'] : '';
		$url2 = (!empty($fetch['link2'])) ? $fetch['link2'] : '';
		$url3 = (!empty($fetch['link3'])) ? $fetch['link3'] : '';
		$url4 = (!empty($fetch['link4'])) ? $fetch['link4'] : '';
		$subtitle = (!empty($fetch['subtitle'])) ? $fetch['subtitle'] : '';
		$poster = (!empty($fetch['anhnen'])) ? $fetch['anhnen'] : '';	
// Phụ Đề
	$sub = $conn->prepare("SELECT * FROM `sub` WHERE `tmdb`='$id'");
		$sub->execute();
        $tracks = '';		
		$index = 0; 
		while($row = $sub->fetch()){
				$index++;
				$default = ($index == 1) ? 'true' : 'false';
			    $tracks.= '{ 
						        "file": "'.$row['sublink'].'", 
						        "label": "'.$row['caption'].'",
						        "kind": "captions",
						        "default": '.$default.'
							   },';
		}

// Link Player
$main_sourcex = '{"type": "video/mp4", "label": "Original", "file":"'.$url.'"}';
if(isset($url) && strpos($url,"//www.fembed.com/") || strpos($url,"//diasfem.com/") || strpos($url,"//drive.google.com/") || strpos($url,"//photos.google.com/") || strpos($url,"//www.youtube.com/")|| strpos($url,"//vimeo.com/")|| strpos($url,"//www.facebook.com/") || strpos($url,"//www.mp4upload.com/") || strpos($url,"//yadi.sk/") || strpos($url,"//www.mediafire.com/")|| strpos($url,"//od.lk/")|| strpos($url,"//photos.app.goo.gl/")!== FALSE){
$curl = new cURL();
$main_sourcex = $curl->get(''.$domain.'/embed.php?link='.$url);
}
$url_source = 'videoplayback.php?'.split_link(encrypte($url,'streamnont')).'';
$url1_source = 'videoplayback.php?'.split_link(encrypte($url1,'streamnont')).'';
$url2_source = 'videoplayback.php?'.split_link(encrypte($url2,'streamnont')).'';
$url3_source = 'videoplayback.php?'.split_link(encrypte($url3,'streamnont')).'';
$url4_source = 'videoplayback.php?'.split_link(encrypte($url4,'streamnont')).'';
// Get Loading & Adblock
$setting = $conn->prepare("SELECT * FROM `settings`");
$setting->execute();
$st = $setting->fetch();
$adblock = (!empty($st['adblock'])) ? $st['adblock'] : '';
$loading = (!empty($st['loading'])) ? $st['loading'] : '';
$jw_license = (!empty($st['jw_license'])) ? $st['jw_license'] : '';
// Get ADS
$getads = $conn->prepare("SELECT * FROM `ads`");
$getads->execute();
$ads = $getads->fetch();
$adpopup = (!empty($st['adpopup'])) ? $st['adpopup'] : '';
$advast = (!empty($st['advast'])) ? $st['advast'] : '';
?>
<!DOCTYPE html>
<html>
<head>
<meta name="robots" content="noindex">
<title><?php echo $moviestitle;?></title>
<meta name="referrer" content="never" />
<meta name="referrer" content="no-referrer" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" href="https://cdn.staticaly.com/gh/domkiddie/drive/master/assets/img/favicon.png">
<title><?php echo $title;?></title>
<link href="<?=$domain;?>assets/css/player.css" rel="stylesheet" type="text/css" />
<!--<script type="text/javascript" src="https://content.jwplatform.com/libraries/SPrnWq3s.js"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<?php 
if(isset($jw_license)){
	echo '<script type="text/javascript" src="'.$jw_license.'"></script>';
}else{
	echo'<script type="text/javascript" src="https://ssl.p.jwpcdn.com/player/v/8.8.6/jwplayer.js"></script>
	<script type="text/javascript">jwplayer.key="64HPbvSQorQcd52B8XFuhMtEoitbvY/EXJmMBfKcXZQU2Rnn";</script>';
} 
?>
</head>
<body>
<div class="videocontent">
<script type="text/javascript">
$(document)['ready'](function() {
    closeServer();
    $('#show-server')['click'](function(_0xf5bfx1) {
        _0xf5bfx1['preventDefault']();
        $('.list-server-items')['toggle']()
    });
    $('.list-server-items li')['click'](function(_0xf5bfx1) {
        _0xf5bfx1['preventDefault']();
        var _0xf5bfx2 = $(this)['attr']('data-video');
        var _0xf5bfx3 = $(this)['attr']('data-status');
        if ($(this)['hasClass']('active')) {
            return false
        } else {
            $('iframe')['hide']();
            $('.videocontent img')['hide']();
            $('iframe')['attr']('src', '');
            if (document['getElementById']('video_player')) {
                if (_0xf5bfx3 == 0) {
                    playerInstance['play']();
                    $('#video_player')['show']()
                } else {
                    playerInstance['stop']();
                    $('#video_player')['hide']()
                }
            };
            if (_0xf5bfx3 == 1) {
                $('#load-iframe')['show']();
                $('#load-iframe iframe')['show']();
                $('#load-iframe iframe')['attr']('src', _0xf5bfx2)
            } else {
                $('#load-iframe')['hide']()
            };
            closeServer()
        };
        $('.list-server-items li')['removeClass']('active');
        $(this)['addClass']('active')
    });
    $('#embedvideo')['width']($(document)['width']());
    $('#embedvideo')['height']($(document)['height']())
});

function closeServer() {
    setTimeout(function() {
        $('.list-server-items')['fadeOut']()
    }, 3000)
}
</script>
<div id="list-server-more">
<a href="javascript:void(0)" id="show-server" title="Alternative Servers"></a>
<ul class="list-server-items">
<li class="active"  data-status="0" data-video=""><b>Main Server</b></li>
<li data-status="1" data-video="<?php echo $url1_source;?>"><b>Server #1</b></li>
<li data-status="1" data-video="<?php echo $url2_source;?>"><b>Server #2</b></li>
<li data-status="1" data-video="<?php echo $url3_source;?>"><b>Server #3</b></li>
<li data-status="1" data-video="<?php echo $url4_source;?>"><b>Server #4</b></li>
</ul>
</div>
<?php if($adblock = '1'): ?>
<div class="__000ab d-none" id="__000ab">
         <div class="__000ab-content">
            <div class="top">
               <h2 class="my-3">Phát Hiện Chặn Quảng Cáo</h2>
               <p class="mb-3 "><b>Bạn Cần Tắt Trình Chặn Quảng Cáo<br> Để Có Thể Xem Phim Này.</b> </p>
            </div>
            <div class="bottom">
               <p class="mb-3">
                 Chúng Tôi Rất Xin Lỗi Vì Bất Tiện Này <br>
                   Nhưng Nguồn Kinh Phí Của Chúng Tôi Đến Từ Quảng Cáo Để Có Thể Duy Trì Và Phát Triển<br>
                   Xin Hãy Tắt Trình Chặn Quảng Cáo 
               </p>
               <a href="<?=$_SERVER['REQUEST_URI']?>" class="btn btn-block btn-danger">Tôi Đã Tắt</a>
            </div>
         </div>
      </div>
<?php endif; 
if($loading = '1'){ ?>
      <div id="loader-wrapper">
         <div id="loader"></div>
      </div>
<?php } ?>
<div id="load-iframe"><iframe id="embedvideo" src="" allowfullscreen="true" marginwidth="0" marginheight="0" scrolling="no" frameborder="0" style="width:100%;height:100%"></iframe></div><div id="video_player"></div>
<?php
        $result = '';
        $data = 'var playerInstance = jwplayer("video_player");
            var countplayer = 1;
            var countcheck = 0;
            playerInstance.setup({
				sources:'.$main_sourcex.',
				image:"'.$poster.'",
				stretching:"uniform",
				width:"100%",
				height:"100%",
				autostart:"false",
				tracks: ['.$tracks.'],
        playbackRateControls:[0.25,0.5,0.75,1,2,3],
		advertising: { client: "vast", schedule: { adbreak1: { offset : "pre", tag:"'.$advast.'", skipoffset: 6 },adbreak2: {offset: "50%", tag: "'.$advast.'",skipoffset:6}} },
        captions: {color: "#FFFF00",fontSize: 14, edgeStyle:"raised",backgroundOpacity: 0,},
                        });                
                   
         playerInstance.on("error",function(){$("#video_player").html("<div class=\"ancok-iframe\"> <iframe src=\"'.$url1_source.'\" width=\"100%\" height=\"100%\" frameborder=\"0\" allowfullscreen=\"allowfullscreen\" class=\"ancok-box\"></iframe><div class=\"ancok-logo-top-right\"></div></div>")});                  
               
         ';
		$preloader = 'setTimeout(function(){
                     $("#loader").delay(1000).fadeOut("slow");
                     $("#loader-wrapper").delay(1500).fadeOut("slow");
                   }, 2000);';
                  
        $adblockDetecter = 'var adBlockEnabled = false;
                   console.log(1);
                   var testAd = document.createElement("div");
                   testAd.innerHTML = "&nbsp;";
                   testAd.className = "adCode";
                   document.body.appendChild(testAd);
                   if (testAd.offsetHeight === 0) {
                      adBlockEnabled = true;
                      testAd.remove();
                      var __000ab = document.getElementById("__000ab");
                      var jwplayer1 = document.getElementById("video_player");
                      __000ab.classList.remove("d-none");
                      jwplayer1.remove();
                    console.log("AdBlock Enabled?", adBlockEnabled)
                    }';
           if($loading = '1'){$data .= $preloader;}
            if($adblock = '1'){$data .= $adblockDetecter;}
        // Apply
        $packer = new Packer($data, 'Normal', true, false, true);
        
        $packed = $packer->pack();

        $result .= '<script type="text/javascript">' . $packed . '</script>';
        
        		
        echo '<script language="javascript">document.write(unescape("'.encode($result).'"));
</script>';
?>
<script type="text/javascript" src="<?php echo $adpopup;?>"></script>

</div>
</body></html>