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

///////////////////////////////////////////////////////////////
//////      Phần Get Link - By Hậu Nguyễn         /////////////
//////    fb : https://www.facebook.com/haun.ytb  /////////////
///////////////////////////////////////////////////////////////
// Get streamtape
function dailymotion($link){ 
if (strpos($link,"dailymotion.com") !==false) {
  preg_match ("/video\/([a-zA-Z0-9]+)/",$link,$m);
  $id=$m[1];
  $link="https://www.dailymotion.com/embed/video/".$id;
  $ua="Mozilla/5.0 (Windows NT 10.0; rv:63.0) Gecko/20100101 Firefox/63.0";

  $h=file_get_contents($link);
  $t1=explode('var config = {',$h);
  $t2=explode('window.playerV5',$t1[1]);
  $t1=explode('window.__PLAYER_CONFIG__ = {',$h);
  $t2=explode(';</script',$t1[1]);
  $h1=trim("{".$t2[0]);

  $r1=json_decode($h1,1);

  $l1=$r1['context']['metadata_template_url'];
  $l1=str_replace(':videoId',$id,$l1);
  $l1=str_replace('embedder=:',urlencode($link),$l1);
  $h3=file_get_contents($l1);
  $r2=json_decode($h3,1);

  $l_main=$r2['qualities']['auto'][0]['url'];
  $zlink=$l_main;

  $h2=file_get_contents($l_main);

  if (preg_match_all("/^http(.*)$/m",$h2,$q)) {
   $zlink=$q[0][count($q[0])-1];
   $t1=explode("#",$zlink);
   $zlink=$t1[0];
  }
  }
    $sources = '[{"label":"HD","type":"video\/mp4","file":"'.$zlink.'"}]';
   return $sources;
}

?>
