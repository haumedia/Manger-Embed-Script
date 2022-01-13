<?php
$action = $_REQUEST['action'];

if (!empty($action)) {
    require_once '../includes/Player.php';
    $obj = new Player();
}
// Don't Change
$season = 'season';
$episode = 'episode';
$tvseries = 'tvseries';
$movies = 'movies';
$subtitle = 'subtitle';
$settings = 'settings';
$ads = 'ads';
/////////////////////////////////////////////////////////////////////////
//////////   Show Setting     - Bởi Hậu Nguyễn              ////////////
///////////////////////////////////////////////////////////////////////
if ($action == "showsettings") {
    $players = $obj->listst($settings);
    if (!empty($players)) {
        $playerslist = $players;
    } else {
        $playerslist = [];
    }
    $playerArr = ['settings' => $playerslist];
    echo json_encode($playerArr);
    exit();
}
/////////////////////////////////////////////////////////////////////////
//////////   ADS     - Bởi Hậu Nguyễn                 ////////////
///////////////////////////////////////////////////////////////////////
if ($action == "listadds") {
    $page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
    $limit = 4;
    $start = ($page - 1) * $limit;
    $players = $obj->getRows($ads,$start, $limit);
    if (!empty($players)) {
        $playerslist = $players;
    } else {
        $playerslist = [];
    }
    $total = $obj->getCount($ads);
    $playerArr = ['count' => $total, 'listadsz' => $playerslist];
    echo json_encode($playerArr);
    exit();
}
// Get Ads
if ($action == "getad") {
    $playerId = (!empty($_GET['id'])) ? $_GET['id'] : '';
    if (!empty($playerId)) {
        $player = $obj->getRow($ads,'id', $playerId);
        echo json_encode($player);
        exit();
    }
}
// Add Ads
if ($action == 'addad' && !empty($_POST)) {
    $advast = $_POST['advast'];
    $adpopup = $_POST['adpopup'];
    $playerId = (!empty($_POST['id'])) ? $_POST['id'] : '';
    if (!empty($_POST['adsvast'])) {
    $playerData = [
            'advast' => $advast,
            'adpopup' => $adpopup,
        ];
	} else {
    $playerData = [
            'advast' => $advast,
            'adpopup' => $adpopup,
        ];
	}
    if ($playerId) {
        $obj->update($ads,$playerData, $playerId);
    } else {
        $playerId = $obj->add($ads,$playerData);
        
    }
    if (!empty($playerId)) {
        $player = $obj->getRow($ads,'id', $playerId);
        echo json_encode($player);
        exit();
    }
}
// Delete Ads
if ($action == "xoaad") {
    $playerId = (!empty($_GET['id'])) ? $_GET['id'] : '';
    if (!empty($playerId)) {
        $isDeleted = $obj->deleteRow($ads,$playerId);
        if ($isDeleted) {
            $message = ['deleted' => 1];
        } else {
            $message = ['deleted' => 0];
        }
        echo json_encode($message);
        exit();
    }
}
/////////////////////////////////////////////////////////////////////////
//////////    Movies    - Bởi Hậu Nguyễn                    ////////////
///////////////////////////////////////////////////////////////////////
if ($action == 'addphim' && !empty($_POST)) {
    $tmdb = $_POST['tmdb'];
    $imdb = $_POST['imdb'];
    $tenphim = $_POST['tenphim'];
    $anh = $_POST['anh'];
    $theloai = $_POST['theloai'];
    $anhnen = $_POST['anhnen'];
    $linkmain = $_POST['link'];
    $link1 = $_POST['link1'];
    $link2 = $_POST['link2'];
    $link3 = $_POST['link3'];
    $link4 = $_POST['link4'];
    $playerId = (!empty($_POST['id'])) ? $_POST['id'] : '';
    if (!empty($_POST['tmdb'])) {
        $playerData = [
            'tmdb' => $tmdb,
            'imdb' => $imdb,
            'tenphim' => $tenphim,
            'anh' => $anh,
            'theloai' => $theloai,
            'anhnen' => $anhnen,
            'hlink' => $linkmain,
            'link1' => $link1,
            'link2' => $link2,
            'link3' => $link3,
            'link4' => $link4,
        ];
	
    } else {
        $playerData = [
            'tmdb' => $tmdb,
            'imdb' => $imdb,
            'tenphim' => $tenphim,
            'anh' => $anh,
            'theloai' => $theloai,
            'anhnen' => $anhnen,
            'hlink' => $linkmain,
            'link1' => $link1,
            'link2' => $link2,
            'link3' => $link3,
            'link4' => $link4,
        ];
    }
    if ($playerId) {
        $obj->update($movies,$playerData, $playerId);
    } else {
        $playerId = $obj->add($movies,$playerData);
        
    }
    if (!empty($playerId)) {
        $player = $obj->getRow($movies,'id', $playerId);
        echo json_encode($player);
        exit();
    }
}
// Lấy Danh Sách Phim Lẻ
if ($action == "phimle") {
    $page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
    $limit = 4;
    $start = ($page - 1) * $limit;

    $players = $obj->getRows($movies,$start, $limit);
    if (!empty($players)) {
        $playerslist = $players;
    } else {
        $playerslist = [];
    }
    $total = $obj->getCount($movies);
    $playerArr = ['count' => $total, 'movie' => $playerslist];
    echo json_encode($playerArr);
    exit();
}
if ($action == "getphimle") {
    $playerId = (!empty($_GET['id'])) ? $_GET['id'] : '';
    if (!empty($playerId)) {
        $player = $obj->getRow($movies,'id', $playerId);
        echo json_encode($player);
        exit();
    }
}

if ($action == "xoaphimle") {
    $playerId = (!empty($_GET['id'])) ? $_GET['id'] : '';
    if (!empty($playerId)) {
        $isDeleted = $obj->deleteRow($movies,$playerId);
        if ($isDeleted) {
            $message = ['deleted' => 1];
        } else {
            $message = ['deleted' => 0];
        }
        echo json_encode($message);
        exit();
    }
}

if ($action == 'search') {
    $queryString = (!empty($_GET['searchQuery'])) ? trim($_GET['searchQuery']) : '';
    $results = $obj->search($movies,$queryString);
    echo json_encode($results);
    exit();
}

/////////////////////////////////////////////////////////////////////////
//////////    TVseries    - Bởi Hậu Nguyễn                  ////////////
///////////////////////////////////////////////////////////////////////

if ($action == 'addphimb' && !empty($_POST)) {
    $tmdb = $_POST['tmdb'];
    $tenphim = $_POST['tenphim'];
    $anh = $_POST['anh'];
    $theloai = $_POST['theloai'];
    $anhnen = $_POST['anhnen'];
    $sophan = $_POST['sophan'];
    $playerId = (!empty($_POST['id'])) ? $_POST['id'] : '';
	
    if (!empty($_POST['tmdb'])) {
        $playerData = [
            'tmdb' => $tmdb,
            'tenphim' => $tenphim,
            'anh' => $anh,
            'theloai' => $theloai,
            'anhnen' => $anhnen,
            'sophan' => $sophan,
        ];
	
    } else {
        $playerData = [
            'tmdb' => $tmdb,
            'tenphim' => $tenphim,
            'anh' => $anh,
            'theloai' => $theloai,
            'anhnen' => $anhnen,
			'sophan' => $sophan,
        ];
    }
    if ($playerId) {
        $obj->update($tvseries,$playerData, $playerId);
    } else {
        $playerId = $obj->add($tvseries,$playerData);
        for($i = 1; $i <= $sophan; $i++){
	        $zz = [
			       'anh'	=>	$anh,
			       'tmdb'	=>	$tmdb,
				   'tenphim'	=>	$tenphim,
		           'tenphan'	=>	'Phần '.$i.'',
		           'idphan'	=>	''.$i.'',
	         ];
			 $playerId = $obj->add($season,$zz);
     }
    }

    if (!empty($playerId)) {
        $player = $obj->getRow($tvseries,'id', $playerId);
        echo json_encode($player);
        exit();
    }
}
// Lấy Danh Sách Phim Bộ
if ($action == "phimbo") {
    $page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
    $limit = 4;
    $start = ($page - 1) * $limit;

    $players = $obj->getRows($tvseries,$start, $limit);
    if (!empty($players)) {
        $playerslist = $players;
    } else {
        $playerslist = [];
    }
    $total = $obj->getCount($tvseries);
    $playerArr = ['count' => $total, 'ttphimbo' => $playerslist];
    echo json_encode($playerArr);
    exit();
}
if ($action == "getphimbo") {
    $playerId = (!empty($_GET['id'])) ? $_GET['id'] : '';
    if (!empty($playerId)) {
        $player = $obj->getRow($tvseries,'id', $playerId);
        echo json_encode($player);
        exit();
    }
}
if ($action == "xoaphimbo") {
    $playerId = (!empty($_GET['id'])) ? $_GET['id'] : '';
    if (!empty($playerId)) {
        $isDeleted = $obj->deleteRow($tvseries,$playerId);
        if ($isDeleted) {
            $message = ['deleted' => 1];
        } else {
            $message = ['deleted' => 0];
        }
        echo json_encode($message);
        exit();
    }
}

if ($action == 'searchpb') {
    $queryString = (!empty($_GET['searchQuery'])) ? trim($_GET['searchQuery']) : '';
    $results = $obj->search($tvseries,$queryString);
    echo json_encode($results);
    exit();
}
/////////////////////////////////////////////////////////////////////////
//////////    Season    - Bởi Hậu Nguyễn                    ////////////
///////////////////////////////////////////////////////////////////////

if ($action == 'addseason' && !empty($_POST)) {
    $tmdb = $_POST['tmdb'];
    $tenphim = $_POST['tenphim'];
    $anh = $_POST['anh'];
    $idphan = $_POST['idphan'];
    $playerId = (!empty($_POST['id'])) ? $_POST['id'] : '';
	
    if (!empty($_POST['tmdb'])) {
        $playerData = [
            'tmdb' => $tmdb,
            'tenphim' => $tenphim,
            'anh' => $anh,
            'idphan' => $idphan,
        ];
	
    } else {
        $playerData = [
            'tmdb' => $tmdb,
            'tenphim' => $tenphim,
            'anh' => $anh,
            'idphan' => $idphan,
        ];
    }
    if ($playerId) {
        $obj->update($season,$playerData, $playerId);
    } else {
        $playerId = $obj->add($season,$playerData);
    }

    if (!empty($playerId)) {
        $player = $obj->getRow($season,'id', $playerId);
        echo json_encode($player);
        exit();
    }
}
// List Season
if ($action == "season") {
    $playerId = (!empty($_GET['id'])) ? $_GET['id'] : '';
    $players = $obj->getRowss($season,'tmdb', $playerId);
    if (!empty($players)) {
        $playerslist = $players;
    } else {
        $playerslist = [];
    }
    $total = $obj->getCountss($season,'tmdb', $playerId);
    $playerArr = ['count' => $total, 'ttseason' => $playerslist];
    echo json_encode($playerArr);
    exit();
}
if ($action == "getseason") {
    $playerId = (!empty($_GET['id'])) ? $_GET['id'] : '';
    if (!empty($playerId)) {
        $player = $obj->getRow($season,'id', $playerId);
        echo json_encode($player);
        exit();
    }
}
if ($action == "delseason") {
    $playerId = (!empty($_GET['id'])) ? $_GET['id'] : '';
    if (!empty($playerId)) {
        $isDeleted = $obj->deleteRow($season,$playerId);
        if ($isDeleted) {
            $message = ['deleted' => 1];
        } else {
            $message = ['deleted' => 0];
        }
        echo json_encode($message);
        exit();
    }
}

/////////////////////////////////////////////////////////////////////////
//////////    Movies    - Bởi Hậu Nguyễn                    ////////////
///////////////////////////////////////////////////////////////////////
if ($action == 'addepisode' && !empty($_POST)) {
    $tmdb = $_POST['tmdb'];
    $tentap = $_POST['tentap'];
    $tenphan = $_POST['tenphan'];
    $linkmain = $_POST['link'];
    $link1 = $_POST['link1'];
    $link2 = $_POST['link2'];
    $link3 = $_POST['link3'];
    $link4 = $_POST['link4'];
    $playerId = (!empty($_POST['id'])) ? $_POST['id'] : '';
    if (!empty($_POST['tmdb'])) {
        $playerData = [
            'tmdb' => $tmdb,
            'tentap' => $tentap,
            'tenphan' => $tenphan,
            'hlink' => $linkmain,
            'link1' => $link1,
            'link2' => $link2,
            'link3' => $link3,
            'link4' => $link4,
        ];
	
    } else {
        $playerData = [
            'tmdb' => $tmdb,
            'tentap' => $tentap,
            'tenphan' => $tenphan,
            'hlink' => $linkmain,
            'link1' => $link1,
            'link2' => $link2,
            'link3' => $link3,
            'link4' => $link4,
        ];
    }
    if ($playerId) {
        $obj->update($episode,$playerData, $playerId);
    } else {
        $playerId = $obj->add($episode,$playerData);
        
    }
	$count = count($_POST['sub']);
	for($i = 0; $i < $count; $i++){
	        $addsub = [
		           'sublink'	=>	$_POST['sub'][$i],
		           'caption'	=>	$_POST['caption'][$i],
		           'tmdb'	    =>	$_POST['tmdb'],
		           'tap'  	=>	$_POST['tentap'],
		           'phan'	=>	$_POST['tenphan'],
	         ];
			 $playerId = $obj->addsub($subtitle,$addsub);
     }
    if (!empty($playerId)) {
        $player = $obj->getRow($episode,'id', $playerId);
        echo json_encode($player);
        exit();
    }
}
// List Episode
if ($action == "episode") {
    $playerId = (!empty($_GET['id'])) ? $_GET['id'] : '';
    $sss = (!empty($_GET['s'])) ? $_GET['s'] : '';
    $players = $obj->getRowep($episode,'tmdb', $playerId, 'tenphan', $sss);
    if (!empty($players)) {
        $playerslist = $players;
    } else {
        $playerslist = [];
    }
    $total = $obj->getCountep($episode,'tmdb', $playerId,'tenphan',$sss);
    $playerArr = ['count' => $total, 'episodess' => $playerslist];
    echo json_encode($playerArr);
    exit();
}
if ($action == "getepisode") {
    $playerId = (!empty($_GET['id'])) ? $_GET['id'] : '';
    if (!empty($playerId)) {
        $player = $obj->getRow($episode,'id', $playerId);
        echo json_encode($player);
        exit();
    }
}

if ($action == "delepisode") {
    $playerId = (!empty($_GET['id'])) ? $_GET['id'] : '';
    if (!empty($playerId)) {
        $isDeleted = $obj->deleteRow($episode,$playerId);
        if ($isDeleted) {
            $message = ['deleted' => 1];
        } else {
            $message = ['deleted' => 0];
        }
        echo json_encode($message);
        exit();
    }
}

if ($action == 'searchepisode') {
    $queryString = (!empty($_GET['searchQuery'])) ? trim($_GET['searchQuery']) : '';
    $results = $obj->search($episode,$queryString);
    echo json_encode($results);
    exit();
}