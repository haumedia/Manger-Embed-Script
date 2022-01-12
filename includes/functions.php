<?php 
// Curl By Hậu Nguyễn
class cURL {
var $headers;
var $user_agent;
var $compression;
var $cookie_file;
var $proxy;
    function __construct($cookies=TRUE,$cookie='cookies.txt',$compression='gzip',$proxy='') { 
        $this->headers[] = 'Accept: image/gif, image/x-bitmap, image/jpeg, image/pjpeg'; 
        $this->headers[] = 'Connection: Keep-Alive'; 
        $this->headers[] = 'Content-type: application/x-www-form-urlencoded;charset=UTF-8'; 
        $this->user_agent = 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36'; 
        $this->compression=$compression; 
        $this->proxy=$proxy; 
        $this->cookies=$cookies; 
        if ($this->cookies == TRUE) $this->cookie($cookie); 
    }
    function cookie($cookie_file) {
        if (file_exists($cookie_file)) {
        $this->cookie_file=$cookie_file;
        } else {
        fopen($cookie_file,'w+') or $this->error('The cookie file could not be opened. Make sure this directory has the correct permissions');
        $this->cookie_file=$cookie_file;
        fclose($this->cookie_file);
        }
    }

    function getheader($url) {
        $process = curl_init($url);
        curl_setopt($process, CURLOPT_HTTPHEADER, $this->headers);
        curl_setopt($process, CURLOPT_HEADER, 1);
        curl_setopt($process, CURLOPT_USERAGENT, $this->user_agent);
        if ($this->cookies == TRUE) curl_setopt($process, CURLOPT_COOKIEFILE, $this->cookie_file);
        if ($this->cookies == TRUE) curl_setopt($process, CURLOPT_COOKIEJAR, $this->cookie_file);
        curl_setopt($process,CURLOPT_ENCODING , $this->compression);
        curl_setopt($process, CURLOPT_TIMEOUT, 60);
        curl_setopt($process, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($process, CURLOPT_NOBODY, 1);
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($process, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($process,CURLOPT_CAINFO, NULL);
        curl_setopt($process,CURLOPT_CAPATH, NULL);
        $return = curl_exec($process);
        curl_close($process);
        return $return;
    }

    function get($url) {
        $process = curl_init($url); 
        curl_setopt($process, CURLOPT_HTTPHEADER, $this->headers);
        curl_setopt($process, CURLOPT_USERAGENT, $this->user_agent);
        if ($this->cookies == TRUE) curl_setopt($process, CURLOPT_COOKIEFILE, $this->cookie_file);
        if ($this->cookies == TRUE) curl_setopt($process, CURLOPT_COOKIEJAR, $this->cookie_file);
        curl_setopt($process,CURLOPT_ENCODING , $this->compression);
        curl_setopt($process, CURLOPT_TIMEOUT, 60);
        if ($this->proxy) curl_setopt($process, CURLOPT_PROXY, $this->proxy); 
        curl_setopt($process, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($process, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($process, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($process,CURLOPT_CAINFO, NULL); 
        curl_setopt($process,CURLOPT_CAPATH, NULL);
        $return = curl_exec($process);
        curl_close($process);
        return $return;
    }

    function post($url,$data) {
        $process = curl_init($url);
        curl_setopt($process, CURLOPT_HTTPHEADER, $this->headers);
        curl_setopt($process, CURLOPT_USERAGENT, $this->user_agent);
        if ($this->cookies == TRUE) curl_setopt($process, CURLOPT_COOKIEFILE, $this->cookie_file);
        if ($this->cookies == TRUE) curl_setopt($process, CURLOPT_COOKIEJAR, $this->cookie_file);
        curl_setopt($process, CURLOPT_ENCODING , $this->compression);
        curl_setopt($process, CURLOPT_TIMEOUT, 60);
        if ($this->proxy) curl_setopt($process, CURLOPT_PROXY, $this->proxy); 
        curl_setopt($process, CURLOPT_POSTFIELDS, $data);
        curl_setopt($process, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($process, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($process, CURLOPT_POST, 1);
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($process, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($process,CURLOPT_CAINFO, NULL); 
        curl_setopt($process,CURLOPT_CAPATH, NULL); 
        $return = curl_exec($process);
        curl_close($process);
        return $return;
    }

    function checkCode($url) {
        $process = curl_init();
        curl_setopt($process, CURLOPT_URL, $url);
        curl_setopt($process, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36");
        curl_setopt($process, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($process, CURLOPT_SSL_VERIFYHOST,false);
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER,false);
        curl_setopt($process, CURLOPT_MAXREDIRS, 10);
        curl_setopt($process, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($process, CURLOPT_TIMEOUT, 20);
        $rt = curl_exec($process);
        $info = curl_getinfo($process);
        return $info["http_code"];
    }

    function getOri($url)
    {
        $ch = curl_init($url);
        curl_setopt($ch,CURLOPT_HEADER,true);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION,false);
        $header = curl_exec($ch);
         
        $fields = explode("\r\n", preg_replace('/\x0D\x0A[\x09\x20]+/', ' ', $header));
             
        for($i=0;$i<count($fields);$i++)
        {
            if(strpos($fields[$i],'location') !== false)
            {
                $url = str_replace("location: ","",$fields[$i]);
            }
        }
        return $url;
    }
    
    function error($error) {
        echo "<center><div style='width:500px;border: 3px solid #FFEEFF; padding: 3px; background-color: #FFDDFF;font-family: verdana; font-size: 10px'><b>cURL Error</b><br>$error</div></center>";
        die;
    }
}
// Mã Hóa
function encrypte($string,$key){
    $returnString = "";
    $charsArray = str_split("e7NjchMCEGgTpsx3mKXbVPiAqn8DLzWo_6.tvwJQ-R0OUrSak954fd2FYyuH~1lIBZ");
    $charsLength = count($charsArray);
    $stringArray = str_split($string);
    $keyArray = str_split(hash('sha256',$key));
    $randomKeyArray = array();
    while(count($randomKeyArray) < $charsLength){
        $randomKeyArray[] = $charsArray[rand(0, $charsLength-1)];
    }
    for ($a = 0; $a < count($stringArray); $a++){
        $numeric = ord($stringArray[$a]) + ord($randomKeyArray[$a%$charsLength]);
        $returnString .= $charsArray[floor($numeric/$charsLength)];
        $returnString .= $charsArray[$numeric%$charsLength];
    }
    $randomKeyEnc = '';
    for ($a = 0; $a < $charsLength; $a++){
        $numeric = ord($randomKeyArray[$a]) + ord($keyArray[$a%count($keyArray)]);
        $randomKeyEnc .= $charsArray[floor($numeric/$charsLength)];
        $randomKeyEnc .= $charsArray[$numeric%$charsLength];
    }
    return $randomKeyEnc.hash('sha256',$string).$returnString;
}
function split_link($link) {
	  $list = '';
	$spilt = chunk_split($link, 500, "=");
	$array = explode('=', $spilt);
	foreach($array as $i => $data) {
		$list .= 'id'.($i+1).'='.$data.'&';
	}
	$split_link = rtrim($list, '&');
	return $split_link;
}
 function encode($input){
    $temp = '';
    $length = strlen($input);
    for($i = 0; $i < $length; $i++)
        $temp .= '%' . bin2hex($input[$i]);
    return $temp;
}
// function get fembed
     include 'videostreaming.php'; 
    function curl_get_contents_fvs($url){
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
$headers = array();
$headers[] = 'Authority: fvs.io';
$headers[] = 'Sec-Ch-Ua: ^^';
$headers[] = 'Sec-Ch-Ua-Mobile: ?0';
$headers[] = 'Upgrade-Insecure-Requests: 1';
$headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.212 Safari/537.36 Edg/90.0.818.66';
$headers[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9';
$headers[] = 'Sec-Fetch-Site: none';
$headers[] = 'Sec-Fetch-Mode: navigate';
$headers[] = 'Sec-Fetch-User: ?1';
$headers[] = 'Sec-Fetch-Dest: document';
$headers[] = 'Accept-Language: en-US,en;q=0.9';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$result = curl_exec($ch);
$curl_info = curl_getinfo($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);	
}
curl_close($ch);
return $curl_info['redirect_url'];	
}
function curl_get_contents($url,$data,$link,$host){
	$ch = curl_init();    
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
	$headers = array();
	$headers[] = 'Authority: '.$host;
	$headers[] = 'Sec-Ch-Ua: ^^';
	$headers[] = 'Accept: */*';
	$headers[] = 'X-Requested-With: XMLHttpRequest';
	$headers[] = 'Sec-Ch-Ua-Mobile: ?0';
	$headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.212 Safari/537.36 Edg/90.0.818.66';
	$headers[] = 'Content-Type: application/x-www-form-urlencoded; charset=UTF-8';
	$headers[] = 'Origin: https://'.$host;
	$headers[] = 'Sec-Fetch-Site: same-origin';
	$headers[] = 'Sec-Fetch-Mode: cors';
	$headers[] = 'Sec-Fetch-Dest: empty';
	$headers[] = 'Referer: '.$link;
	$headers[] = 'Accept-Language: en-US,en;q=0.9';
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
	$res = curl_exec($ch);
	curl_close($ch); 
	return $res;
}
///////////////////////////////////////////////////////////////
//////      Phần Get Link - By Hậu Nguyễn         /////////////
//////    fb : https://www.facebook.com/hadprozz  /////////////
///////////////////////////////////////////////////////////////

function amazon_drive($link){
        $curl = new cURL();
        preg_match('/share\/(.*)/', $link, $matchID);
        $getSource = $curl->get('https://www.amazon.com/drive/v1/shares/'.$matchID[1].'?resourceVersion=V2&ContentType=JSON&asset=ALL');
        $deJson = json_decode($getSource);
        $getTemp = $curl->get('https://www.amazon.com/drive/v1/nodes/'.$deJson->nodeInfo->id.'/children?resourceVersion=V2&ContentType=JSON&limit=200&sort=%5B%22kind+DESC%22%2C+%22modifiedDate+DESC%22%5D&asset=ALL&tempLink=true&shareId='.$matchID[1]);        
        $deJsonTemp = json_decode($getTemp);        
        $tempLink = (isset($deJsonTemp->data[0]->tempLink)) ? $deJsonTemp->data[0]->tempLink : 'undefined';        
        $sources = '[{"label":"HD","type":"video\/mp4","file":"'.$tempLink.'"}]';
        return $sources;
    }
// Get Player archive By Hậu Nguyễn
    function archive($link){
        $curl = new cURL();
        $getSource = $curl->get($link);
        preg_match('/"sources":\[(.*?)\],/', $getSource, $match);
        $deJson = json_decode('[' . $match[1] . ']');
        foreach ($deJson as $key => $value) {
            switch ($value->height) {
                case '1080':
                        $s[1080] = '{"file": "'.$curl->getOri('https://archive.org' . $value->file).'", "type": "video\/mp4", "label": "1080p"}';
                    break;

                case '720':
                        $s[720] = '{"file": "'.$curl->getOri('https://archive.org' . $value->file).'", "type": "video\/mp4", "label": "720p"}';
                    break;
                
                case '480':
                        $s[480] = '{"file": "'.$curl->getOri('https://archive.org' . $value->file).'", "type": "video\/mp4", "label": "480p"}';
                    break;

                case '360':
                        $s[360] = '{"file": "'.$curl->getOri('https://archive.org' . $value->file).'", "type": "video\/mp4", "label": "360p"}';
                    break;
            }
        }
        krsort($s);        
        $enJson = implode(',', $s);        
        $sources = '['.$enJson.']';
        return $sources;
    }
// Get Player blogger By Hậu Nguyễn
    function blogger($link){
        $curl = new cURL();
        $checkLink = preg_match('/(www.?|)blogger.com\/.*/', $link, $match);
        if ($checkLink) {
            $getSource = $curl->get($link);
            preg_match('/VIDEO_CONFIG\s*\=\s*\{(.*?)\]\}/', $getSource, $match);           
            $deJson = json_decode('{' . $match[1] . ']}');           
            foreach ($deJson->streams as $key => $value) {
                switch ($value->format_id) {
                    case '37':
                            $s[1080] = '{"file": "'.$value->play_url.'", "type": "video\/mp4", "label": "1080p"}';
                        break;

                    case '22':
                            $s[720] = '{"file": "'.$value->play_url.'", "type": "video\/mp4", "label": "720p"}';
                        break;
                    
                    case '18':
                            $s[360] = '{"file": "'.$value->play_url.'", "type": "video\/mp4", "label": "360p"}';
                        break;
                }
            }
            krsort($s);            
            $enJson = implode(',', $s);           
            $sources = '['.$enJson.']';       
            $checkSource = preg_match('/\[\]/', $sources, $match);           
            if($checkSource) {
                $sources = '[{"label":"undefined","type":"video\/mp4","file":"undefined"}]';
            }
        }else{
			$getVideoLink = $curl->get($link);
            $dom = new DOMDocument();
            @$dom->loadHTML($getVideoLink);
            $xpath = new DOMXPath($dom);
            $nlist = $xpath->query("//iframe");
            $fileurl = $nlist[0]->getAttribute("src");
            $getSource = $curl->get($fileurl);
            preg_match('/VIDEO_CONFIG\s*\=\s*\{(.*?)\]\}/', $getSource, $match);           
            $deJson = json_decode('{' . $match[1] . ']}');           
            foreach ($deJson->streams as $key => $value) {
               switch ($value->format_id) {
                    case '37':
                            $s[1080] = '{"file": "'.$value->play_url.'", "type": "video\/mp4", "label": "1080p"}';
                        break;

                    case '22':
                            $s[720] = '{"file": "'.$value->play_url.'", "type": "video\/mp4", "label": "720p"}';
                        break;
                    
                    case '18':
                            $s[360] = '{"file": "'.$value->play_url.'", "type": "video\/mp4", "label": "360p"}';
                        break;
                }
            }
            krsort($s);            
            $enJson = implode(',', $s);            
            $sources = '['.$enJson.']';        
            $checkSource = preg_match('/\[\]/', $sources, $match);           
            if($checkSource) {
                $sources = '[{"label":"undefined","type":"video\/mp4","file":"undefined"}]';
            }
        }
        return $sources;
    }
// Get player FaceBook By Hậu Nguyễn
    function facebook($link){
        $curl = new cURL();
        preg_match('/\/videos\/([0-9]*)(\/|)/', $link, $matchID);
        $sourceURL = $curl->get('https://www.facebook.com/video/embed?video_id=' . $matchID[1]);
        preg_match('/"hd_src":"(.*?)"/', $sourceURL, $match_hd);
        preg_match('/"sd_src":"(.*?)"/', $sourceURL, $match_sd);
        if (isset($match_hd[1])) {
            $sources = '[{"default":"true","label":"HD","type":"video\/mp4","file":"'.$match_hd[1].'"}, {"label":"SD","type":"video\/mp4","file":"'.$match_sd[1].'"}]';
        }elseif (isset($match_sd[1])) {
            $sources = '[{"label":"SD","type":"video\/mp4","file":"'.$match_sd[1].'"}]';
        }else $sources = '[{"label":"undefined","type":"video\/mp4","file":"undefined"}]';
        return $sources;
    }
// Get Link Player Fembed By Hậu Nguyễn
function fembed($link){  

	      $host=parse_url($link)['host'];
  preg_match("/v\/([\w\-]*)/",$link,$m);
  $id=$m[1];
  $url="https://".$host."/api/source/".$id;
  $data = array('r' => '','d' => $host);
  $h3 = curl_get_contents($url,$data,$link,$host);
  $r=json_decode($h3,1);
  if (isset($r['player']['poster_file'])) {
        $t1=explode("userdata/",$r['player']['poster_file']);
        $t2=explode("/",$t1[1]);
        $userdata=$t2[0];
    }else{
        $userdata="";
    }
  if (isset($r["captions"][0]["path"])) {
        if (strpos($r["captions"][0]["path"],"http") === false){
             $srt="https://".$host."/asset".$r["captions"][0]["path"];
        }else{
             $srt=$r["captions"][0]["path"]; 
        }
  } elseif (isset($r["captions"][0]["hash"])) {
         $srt="https://".$host."/asset/userdata/".$userdata."/caption/".$r["captions"][0]["hash"]."/".$r["captions"][0]["id"].".".$r["captions"][0]["extension"];
  }
  $c = count($r["data"]);
  if (strpos($r["data"][$c-1]["file"],"http") === false){
         $links="https://".$host.$r["data"][$c-1]["file"];
    }else{
         $links=$r["data"][$c-1]["file"];
  }
   if (preg_match("/\#caption\=(.+)/",$link,$m)){
     $srt=$m[1];
   }
$curl2 = curl_get_contents_fvs($links);

 $sources = '[{"label":"HD","type":"video\/mp4","file":"'.$curl2.'"}]';
     return $sources;
	}
// Get Player rumble By Hậu Nguyễn
    function rumble($link){
        $curl = new cURL();
        $getID = $curl->get($link);
        preg_match('/"video":"(.*?)"/', $getID, $matchID);      
        $getSource = $curl->get('https://rumble.com/embedJS/u3/?request=video&v='.$matchID[1].'&ext=%7B%22ad_count%22%3Anull%7D');
        preg_match_all('/"([0-9]*)":\["(.*?).mp4/', $getSource, $matchLink);
        foreach ($matchLink[1] as $key => $value) {
            switch ($value) {
                case '360':
                        $s[360] = '{"file": "'.$matchLink[2][$key].'.mp4", "type": "video\/mp4", "label": "360p"}';
                    break;
                case '480':
                        $s[480] = '{"file": "'.$matchLink[2][$key].'.mp4", "type": "video\/mp4", "label": "480p"}';
                    break;
                case '720':
                        $s[720] = '{"file": "'.$matchLink[2][$key].'.mp4", "type": "video\/mp4", "label": "720p"}';
                    break;
                case '1080':
                        $s[1080] = '{"file": "'.$matchLink[2][$key].'.mp4", "type": "video\/mp4", "label": "1080p"}';
                    break;
                case '1440':
                        $s[1440] = '{"file": "'.$matchLink[2][$key].'.mp4", "type": "video\/mp4", "label": "1440p"}';
                    break;
                case '2160':
                        $s[2160] = '{"file": "'.$matchLink[2][$key].'.mp4", "type": "video\/mp4", "label": "2160p"}';
                    break;
            }
        }
        krsort($s);
        $enJson = implode(',', $s);
        $sources = '['.$enJson.']';   
        $checkSource = preg_match('/\[\]/', $sources, $match);       
        if($checkSource) {
            $sources = '[{"label":"undefined","type":"video\/mp4","file":"undefined"}]';
        }
        return $sources;
    }
// Get Player streamable By Hậu Nguyễn
    function streamable($link){
        $curl = new cURL();
        $getSource = $curl->get($link);
        preg_match('/property="og:video:url"\s*content="(.*?)"/', $getSource, $matchLink);
        $sources = '[{"label":"HD","type":"video\/mp4","file":"'.$matchLink[1].'"}]';
        return $sources;
    }
// Get Player vimeo By Hậu Nguyễn
    function vimeo($link){
        $curl = new cURL();        
        preg_match('/vimeo.com\/([0-9]*)/', $link, $matchID);
        $ranServer = rand(1,15);
        $getSource = $curl->post('https://us'.$ranServer.'.proxysite.com/includes/process.php?action=update', 'server-option=us'.$ranServer.'&d='.urlencode('https://player.vimeo.com/video/'.$matchID[1].'/config').'');       
        $deJson = json_decode($getSource);
        foreach ($deJson->request->files->progressive as $key => $value) {
            switch ($value->quality) {
                case '1080p':
                        $s[1080] = '{"file": "'.$value->url.'", "type": "video\/mp4", "label": "1080p"}';
                    break;
                case '720p':
                        $s[720] = '{"file": "'.$value->url.'", "type": "video\/mp4", "label": "720p"}';
                    break;               
                case '540p':
                        $s[540] = '{"file": "'.$value->url.'", "type": "video\/mp4", "label": "540p"}';
                    break;
                case '360p':
                        $s[360] = '{"file": "'.$value->url.'", "type": "video\/mp4", "label": "360p"}';
                    break;
                case '270p':
                        $s[270] = '{"file": "'.$value->url.'", "type": "video\/mp4", "label": "270p"}';
                    break;
            }
        }
        krsort($s);        
        $enJson = implode(',', $s);       
        $sources = '['.$enJson.']';
        $checkSource = preg_match('/\[\]/', $sources, $match);        
        if($checkSource) {
            $sources = '[{"label":"undefined","type":"video\/mp4","file":"undefined"}]';
        }
        return $sources;
    }
// Get Player vimeo By Hậu Nguyễn
    function yandex($link){
        $curl = new cURL();
        $getSource = file_get_contents('https://cloud-api.yandex.net/v1/disk/public/resources/download?public_key=' . $link);
        $deJson = json_decode($getSource);        
        $oriLink = $curl->getOri($deJson->href);       
        $sources = '[{"label":"HD","type":"video\/mp4","file":"'.$oriLink.'"}]';
        return $sources;
    }
// Get Player youtube By Hậu Nguyễn - Đang sửa
    function youtube($link){
        preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[\w\-?&!#=,;]+/[\w\-?&!#=/,;]+/|(?:v|e(?:mbed)?)/|[\w\-?&!#=,;]*[?&]v=)|youtu\.be/)([\w-]{11})(?:[^\w-]|\Z)%i', $link, $matchID);
        require('vendor/autoload.php');

        $youtube = new \YouTube\YouTubeDownloader();

        $getSource = $youtube->getDownloadLinks($link);

        $s = [];

        foreach ($getSource as $key => $value) {

              switch ($value['itag']) 
              {
                    case '37':
                        $s[] = [
                            'type'  => 'video/mp4',
                            'label' => '1080p',
                            'file'  => preg_replace(["/[^\/]+\.googlevideo\.com/"], ["redirector.googlevideo.com"], $value['url']),
                        ];
                      break;

                    case '22':
                        $s[] = [
                            'type'  => 'video/mp4',
                            'label' => '720p',
                            'file'  => preg_replace(["/[^\/]+\.googlevideo\.com/"], ["redirector.googlevideo.com"], $value['url']),
                        ];
                      break;

                     case '18':
                        $s[] = [
                            'type'  => 'video/mp4',
                            'label' => '360p',
                            'file'  => preg_replace(["/[^\/]+\.googlevideo\.com/"], ["redirector.googlevideo.com"], $value['url']),
                        ];
                      break;
              }
        }

        $sources = json_encode($s);

        return $sources;
    }
// Get Link Player OK.RU Bởi Hậu Nguyễn
function okru($link){
  $user_agent = 'Mozilla/5.0(Linux;Android 7.1.2;ro;RO;MXQ-4K Build/MXQ-4K) MXPlayer/1.8.10';
  $user_agent = 'Mozilla/5.0(Linux;Android 10.1.2) MXPlayer';
  $pattern = '/(?:\/\/|\.)(ok\.ru|odnoklassniki\.ru)\/(?:videoembed|video)\/(\d+)/';
  preg_match($pattern,$link,$m);
  $id=$m[2];
  $l="https://www.ok.ru/dk";
  $post="cmd=videoPlayerMetadata&mid=".$id;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $l);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt ($ch, CURLOPT_POST, 1);
  curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);
  curl_setopt($ch, CURLOPT_REFERER,"https://www.ok.ru");
  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
  curl_setopt($ch, CURLOPT_TIMEOUT, 15);
  $h = curl_exec($ch);
  curl_close($ch);
  $z=json_decode($h,1);

  $vids=$z["videos"];
  $c=count($vids);
  $link=$vids[$c-1]["url"];
  if ($link) {
    $t1=explode("?",$link);
    $link=$t1[0]."/ok.mp4?".$t1[1];
  }
   $sources = '[{"label":"HD","type":"video\/mp4","file":"'.$link.'"}]';
    return $sources;
}
// Get Google Diver - By Hậu NGuyễn - Lỗi
    function google_drive($link){
        global $proxyDomain;
        $curl = new cURL();  
        preg_match('/https?:\/\/(?:www\.)?(?:drive|docs)\.google\.com\/(?:file\/d\/|open\?id=)?([a-z0-9A-Z_-]+)(?:\/.+)?/is', $link, $id);
        $getSource = $curl->get( $proxyDomain . '/link/?driveId=' . $id[1]);
        $sources = $getSource;
        return $sources;
    }
// Get Photo - By Hậu NGuyễn - Lỗi
    function google_photos($link){
        $curl = new cURL();
        $getSource = $curl->get($link);
        $checkLink = preg_match('/photos.google.com\/share\/.*\/photo\/.*/', $link, $match);
        if ($checkLink) {
            $deSource = rawurldecode($getSource);
            preg_match_all('/https:\/\/(.*?)=m(22|18|37)/', $deSource, $matchSource);
            foreach ($matchSource[2] as $key => $value) {
                switch ($value) {
                    case '37':
                            $s[1080] = '{"file": "https://' . $matchSource[1][0] . '=m37", "type": "video\/mp4", "label": "1080p"}';
                        break;

                    case '22':
                            $s[720] = '{"file": "https://' . $matchSource[1][0] . '=m22", "type": "video\/mp4", "label": "720p"}';
                        break;
                    
                    case '18':
                            $s[360] = '{"file": "https://' . $matchSource[1][0] . '=m18", "type": "video\/mp4", "label": "360p"}';
                        break;
                }
            }   
            krsort($s);           
            $enJson = implode(',', $s);            
            $sources = '['.$enJson.']';
            $checkSource = preg_match('/\[\]/', $sources, $match);            
            if($checkSource) {
                $sources = '[{"label":"undefined","type":"video\/mp4","file":"undefined"}]';
            }
        }
        else{
            preg_match('/<meta property="og:image" content="(.*?)\=.*">/', $getSource, $matchLink);
            $f1080p = trim($matchLink[1] . '=m37');
            $f720p = trim($matchLink[1] . '=m22');
            $f360p = trim($matchLink[1] . '=m18');
            if ($curl->checkCode($f1080p) != 404) {
                $sources = '[{"label":"1080p","type":"video\/mp4","file":"'.$f1080p.'"}, {"label":"720p","type":"video\/mp4","file":"'.$f720p.'"}, {"label":"360p","type":"video\/mp4","file":"'.$f360p.'"}]';
            }
            else if ($curl->checkCode($f720p) != 404) {
                $sources = '[{"label":"720p","type":"video\/mp4","file":"'.$f720p.'"}, {"label":"360p","type":"video\/mp4","file":"'.$f360p.'"}]';
            }
            else if ($curl->checkCode($f360p) != 404) {
                $sources = '[{"label":"360p","type":"video\/mp4","file":"'.$f360p.'"}]';
            }
            else $sources = '[{"label":"undefined","type":"video\/mp4","file":"undefined"}]';
        }       
        $sources = str_replace('lh3.googleusercontent.com', '3.bp.blogspot.com', $sources);
        return $sources;
    }
// Get Player Mp4Upload By Hậu Nguyễn - Lỗi
    function mp4upload($link){       
        $unpacker = new JavascriptUnpacker;        
        $curl = new cURL();
        preg_match('/mp4upload.com\/(.*)/', $link, $matchID);
        $getSource = $curl->get('https://www.mp4upload.com/embed-'.$matchID[1].'.html'); 
        preg_match('/eval(.*?)\s*<\/script>/', $getSource, $matchSource);                   
        $uPack = $unpacker->unpack($matchSource[0]);       
        preg_match('/src:"(.*?)"/', $uPack, $directLink);        
        $sources = '[{"label":"HD","type":"video\/mp4","file":"'.$directLink[1].'"}]';
        return $sources;
    }
// Get Player mediafire By Hậu Nguyễn - Lỗi
    function mediafire($link){
        $sourceURL = file_get_contents($link, false, stream_context_create(['socket' => ['bindto' => '0:0']]));
		preg_match('/href\=\"https\:\/\/download(.*?).mediafire\.com\/(.*?)\"\>/', $sourceURL, $matchLink);
        $linkMF = (isset($matchLink[1])) ? 'https://download' . $matchLink[1] . '.mediafire.com/' . $matchLink[2] : '';       
        if (isset($matchLink[1])) {
            $sources = '[{"label":"HD","type":"video\/mp4","file":"'.stripslashes($linkMF).'"}]';
        } else $sources = '[{"label":"undefined","type":"video\/mp4","file":"undefined"}]';
        return $sources;
    }
// Get Player onedrive By Hậu Nguyễn - Lỗi
    function onedrive($link){
        $curl = new cURL();
        $linkOneDrive = str_replace('1drv.ms', '1drv.ws', $link);       
        $sourceURL = $curl->get($linkOneDrive . '?txt');       
        $sources = '[{"label":"HD","type":"video\/mp4","file":"'.$sourceURL.'"}]';
        return $sources;
    }


?>
