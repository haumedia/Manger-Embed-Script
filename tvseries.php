<?php
if(empty($_SESSION)) session_start();
require_once('includes/Database.php');
require_once('includes/functions.php');
require_once('includes/packer.php');
$dbClass = new Database();
$conn = $dbClass->getDb(); 
$idtmdb = (isset($_GET['id'])) ? $_GET['id'] : '';
$seasons  = (isset($_GET['s'])) ? $_GET['s'] : '';
$episodes  = (isset($_GET['e'])) ? $_GET['e'] : '';
// Phim Bộ
$sql1 = $conn->prepare("SELECT * FROM `tvseries` WHERE `tmdb`='$idtmdb'");
$sql1->execute();
$fetcha = $sql1->fetch();
	
//Lấy Tập
$sql = $conn->prepare("SELECT * FROM `episode` WHERE `tenphan`='$seasons' AND `tmdb`='$idtmdb' AND `tentap`='$episodes'");
$sql->execute();
$fetch = $sql->fetch();	
if(isset($fetch['tentap'])){	
		$moviestitle = (!empty($fetcha['tenphim'])) ? $fetcha['tenphim'] : '';
		$tentap = (!empty($fetch['tentap'])) ? $fetch['tentap'] : '';
		$tenphan = (!empty($fetch['tenphan'])) ? $fetch['tenphan'] : '';
		$url = (!empty($fetch['hlink'])) ? $fetch['hlink'] : '';
		$url1 = (!empty($fetch['link1'])) ? $fetch['link1'] : '';
		$url2 = (!empty($fetch['link2'])) ? $fetch['link2'] : '';
		$url3 = (!empty($fetch['link3'])) ? $fetch['link3'] : '';
		$url4 = (!empty($fetch['link4'])) ? $fetch['link4'] : '';
		$subtitle = (!empty($fetcha['subtitle'])) ? $fetcha['subtitle'] : '';
		$poster = (!empty($fetcha['anhnen'])) ? $fetcha['anhnen'] : '';	
		$sub = $conn->prepare("SELECT * FROM `subtitle` WHERE `tmdb`='$idtmdb' AND `phan`='$seasons' AND `tap`='$episodes'");
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

if(empty($poster)) {
$poster = ''.$domain.'/assets/images/default-poster.jpg';
}
$main_sourcex = '{"type": "video/mp4", "label": "Original", "file":"'.$url.'"}';
if(!isset($url)){
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
$autoplay = (!empty($st['autoplay'])) ? $st['autoplay'] : '';
$jw_license = (!empty($st['jw_license'])) ? $st['jw_license'] : '';
// Get ADS
$getads = $conn->prepare("SELECT * FROM `ads`");
$getads->execute();
$ads = $getads->fetch();
$adpopup = (!empty($st['adpopup'])) ? $st['adpopup'] : '';
$advast = (!empty($st['advast'])) ? $st['advast'] : '';
?>
<!DOCTYPE html><html>
<head>
<meta name="robots" content="noindex">
<meta name="referrer" content="never" />
<meta name="referrer" content="no-referrer" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" href="https://cdn.staticaly.com/gh/domkiddie/drive/master/assets/img/favicon.png">
<title><?php echo $moviestitle;?></title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="<?=$domain;?>assets/css/player.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.3.1/css/all.min.css" integrity="sha512-KulI0psuJQK8UMpOeiMLDXJtGOZEBm8RZNTyBBHIWqoXoPMFcw+L5AEo0YMpsW8BfiuWrdD1rH6GWGgQBF59Lg==" crossorigin="anonymous" referrerpolicy="no-referrer">
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<!--<script type="text/javascript" src="https://content.jwplatform.com/libraries/SPrnWq3s.js"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
	<script type="text/javascript" src="https://ssl.p.jwpcdn.com/player/v/8.8.6/jwplayer.js"></script>
	<script type="text/javascript">jwplayer.key="64HPbvSQorQcd52B8XFuhMtEoitbvY/EXJmMBfKcXZQU2Rnn";</script>
</head>
<body>
<div class="wrapper">
<div class="videocontent">
<script type="text/javascript">
$(document)['ready'](function() {
    closeServer();
    $('#show-server')['click'](function(_0xf5bfx1) {
        _0xf5bfx1['preventDefault']();
        $('.servers')['toggle']()
    });
    $('.servers li')['click'](function(_0xf5bfx1) {
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
        $('.servers li')['removeClass']('active');
        $(this)['addClass']('active')
    });
    $('#embedvideo')['width']($(document)['width']());
    $('#embedvideo')['height']($(document)['height']())
});

function closeServer() {
    setTimeout(function() {
        $('.servers')['fadeOut']()
    }, 3000)
}
</script>
<div id="list-server-more">
<button class="btn btn-radius btn-primary" id="show-server" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-list mr-3"></i>Servers<i class="fas fa-angle-down ml-2"></i></button>
<ul class="dropdown-menu dropdown-menu-model servers">
<li data-status="0" data-video="" class="dropdown-item item-server active"><b>Main Server</b></li>
<?php if(!empty($url1)){ ?>
<li data-status="1" data-video="<?php echo $url1_source;?>" class="dropdown-item item-server "><b>Server #1</b></li>
<?php } if(!empty($url2)){ ?>
<li data-status="1" data-video="<?php echo $url2_source;?>" class="dropdown-item item-server "><b>Server #2</b></li>
<?php } if(!empty($url3)){ ?>
<li data-status="1" data-video="<?php echo $url3_source;?>" class="dropdown-item item-server "><b>Server #3</b></li>
<?php } if(!empty($url4)){ ?>
<li data-status="1" data-video="<?php echo $url4_source;?>" class="dropdown-item item-server "><b>Server #4</b></li>
<?php } ?>
</ul>
</div>
<div class="media-title"><div class="show-name"><?php echo $moviestitle;?> <br /><small> Season <?php echo $tenphan;?> - Episode <?php echo $tentap;?></small></div></div>
<?php if($adblock == '1'){ ?>
<div class="__000ab d-none" id="__000ab">
         <div class="__000ab-content">
            <div class="top">
			<img src="assets/images/adblock.png" width="80px" height="80px" />
               <h2 class="my-3">Ad Block Detection</h2>
               <p class="mb-3 "><b>You Need to Turn Off Ad Blocker To Watch This Movie.</b> </p>
            </div>
            <div class="bottom">
               <p class="mb-3">
                 We Are Sorry For This Inconvenience But Our Funds Come From Ads To Maintain And Grow Please Turn Off Ad Blocker 
               </p>
               <a href="<?=$_SERVER['REQUEST_URI']?>" class="btn btn-block btn-danger">I Turned Off</a>
            </div>
         </div>
      </div>
<?php } 
if($loading == 1){ ?>
      <div id="loader-wrapper">
         <div id="loader"></div>
      </div>
<?php } ?>
<?php 
if($autoplay == 1){
	$auto = 'true';
}else{
	$auto = 'false';
}?>
<div id="load-iframe"><iframe id="embedvideo" src="" allowfullscreen="true" marginwidth="0" marginheight="0" scrolling="no" frameborder="0" style="width:100%;height:100%"></iframe></div><div id="video_player"></div>
<?php
        $result = '';
$data = '   var playerInstance = jwplayer("video_player");
            var countplayer = 1;
            var countcheck = 0;
            playerInstance.setup({
				sources:'.$main_sourcex.',
				image:"'.$poster.'",
				stretching:"uniform",
				width:"100%",
				height:"100%",
				autostart:"'.$auto.'",
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
		// HauN
        $packer = new Packer($data, 'Normal', true, false, true);
        
        $packed = $packer->pack();

        $result .= '<script type="text/javascript">' . $packed . '</script>';
        
        		
        echo '<script language="javascript">document.write(unescape("'.encode($result).'"));
</script>';
?>
<script type="text/javascript" src="<?php echo $adpopup;?>"></script>
</div></div>
</body></html>
<?php 
} else {
	header("Location: /index.php");
   exit;
}