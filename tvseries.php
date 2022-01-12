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
		$moviestitle = (!empty($fetch['tenphim'])) ? $fetch['tenphim'] : '';
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
if(isset($url) && strpos($url,"//www.fembed.com/") || strpos($url,"//diasfem.com/") || strpos($url,"//drive.google.com/") || strpos($url,"//photos.google.com/") || strpos($url,"//www.youtube.com/")|| strpos($url,"//vimeo.com/")|| strpos($url,"//www.facebook.com/") || strpos($url,"//www.mp4upload.com/") || strpos($url,"//yadi.sk/") || strpos($url,"//www.mediafire.com/")|| strpos($url,"//od.lk/")|| strpos($url,"//photos.app.goo.gl/")!== FALSE){
$curl = new cURL();
$main_sourcex = $curl->get(''.$domain.'/embed.php?link='.$url);
}
$url_source = 'videoplayback.php?'.split_link(encrypte($url,'streamnont')).'';
$url1_source = 'videoplayback.php?'.split_link(encrypte($url1,'streamnont')).'';
$url2_source = 'videoplayback.php?'.split_link(encrypte($url2,'streamnont')).'';
$url3_source = 'videoplayback.php?'.split_link(encrypte($url3,'streamnont')).'';
$url4_source = 'videoplayback.php?'.split_link(encrypte($url4,'streamnont')).'';

?>
<!DOCTYPE html><html>
<head>
<meta name="robots" content="noindex">
<title><?php echo $moviestitle;?></title>
<meta name="referrer" content="never" />
<meta name="referrer" content="no-referrer" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" href="https://cdn.staticaly.com/gh/domkiddie/drive/master/assets/img/favicon.png">
<title><?php echo $title;?></title>
<link href="<?php echo $domain;?>assets/css/player.css" rel="stylesheet" type="text/css" />
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
				autostart:"false",
				tracks: ['.$tracks.'],
        playbackRateControls:[0.25,0.5,0.75,1,2,3],
        captions: {color: "#FFFF00",fontSize: 14, edgeStyle:"raised",backgroundOpacity: 0,},
                        });                
                   
         playerInstance.on("error",function(){$("#video_player").html("<div class=\"ancok-iframe\"> <iframe src=\"'.$url1_source.'\" width=\"100%\" height=\"100%\" frameborder=\"0\" allowfullscreen=\"allowfullscreen\" class=\"ancok-box\"></iframe><div class=\"ancok-logo-top-right\"></div></div>")});                  
               
            ';

        $packer = new Packer($data, 'Normal', true, false, true);
        
        $packed = $packer->pack();

        $result .= '<script type="text/javascript">' . $packed . '</script>';
        
        		
        echo '<script language="javascript">document.write(unescape("'.encode($result).'"));
</script>';
?></div></div>
</body></html>
<?php 
} else {
	header("Location: /index.php");
   exit;
}