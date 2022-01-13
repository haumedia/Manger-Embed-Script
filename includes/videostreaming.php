<?php
$video 		= '';
$video		= '';
$videoTest 	= '';



class VideoStreamCurl{
    private $path = "";
    private $buffer = 102400;
    private $start  = -1;
    private $end    = -1;
    private $size   = 0;
	private $cache	='';
	private $testMODE = false;
 
    function __construct($filePath){
        $this->path = $filePath;
    }
    
	public function test($localFile,$bytes){
		$this->testMODE = true;
		$b 		= array();
		$b['Size'] 	= $this->curlSize();
		$b['MaxReadBytes'] 	= $bytes;
		$this->curlDownload(0,($bytes-1));
		$b['BytesCurl']	= $this->cache;
		$a		= fopen($localFile,'rb');
		$b['BytesLocal']	= fread($a, $bytes);
		$b['Header']	= $this->testHeader();
		$b['Start']	= $this->start;
		$b['End']	= $this->end;
		fclose($a);
		echo '<pre>';
			print_r($b);
		echo '</pre>';
	}
	
    private function open(){
     
	
		$ch = curl_init($this->path);
		curl_setopt($ch, CURLOPT_NOBODY, TRUE);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, TRUE);
		

		if(curl_exec($ch) === false)
		{
			echo 'ERROR URL';
			exit();
		}

		curl_close($ch);
    }
    
	private function testHeader(){
		ob_get_clean();
		
		$array=array();
			$array[] = 'Content-Type: video/mp4';
			$array[] = 'Cache-Control: max-age=2592000, public';
			$array[] = "Expires: ".gmdate('D, d M Y H:i:s', time()+2592000) . ' GMT';
			$this->start = 0;
			$this->size  = $this->curlSize(); //TAMAÑO DEL ARCHIVO.
			$this->end   = $this->size - 1;
			$array[] = "Accept-Ranges: 0-".$this->end;
			if (isset($_SERVER['HTTP_RANGE'])) {
				$c_start = $this->start;
            	$c_end = $this->end;
				list(, $range) = explode('=', $_SERVER['HTTP_RANGE'], 2);
				if (strpos($range, ',') !== false) {
					$array[] = 'HTTP/1.1 416 Requested Range Not Satisfiable';
					$array[] = "Content-Range: bytes $this->start-$this->end/$this->size";
					exit;
				}
				if ($range == '-') {
					$c_start = $this->size - substr($range, 1);
				}else{
					$range = explode('-', $range);
					$c_start = $range[0];

					$c_end = (isset($range[1]) && is_numeric($range[1])) ? $range[1] : $c_end;
				}
				$c_end = ($c_end > $this->end) ? $this->end : $c_end;
				if ($c_start > $c_end || $c_start > $this->size - 1 || $c_end >= $this->size) {
					$array[] = 'HTTP/1.1 416 Requested Range Not Satisfiable';
					$array[] = "Content-Range: bytes $this->start-$this->end/$this->size";
					exit;
				}
				$this->start = $c_start;
				$this->end = $c_end;
				$length = $this->end - $this->start + 1;
				//fseek($this->stream, $this->start);
				$array[] = 'HTTP/1.1 206 Partial Content';
				$array[] = "Content-Length: ".$length;
				$array[] = "Content-Range: bytes $this->start-$this->end/".$this->size;
			}
		return $array;
	}
	
    private function setHeader(){
        ob_get_clean();
        header("Content-Type: video/mp4");
        header("Cache-Control: max-age=2592000, public");
        header("Expires: ".gmdate('D, d M Y H:i:s', time()+2592000) . ' GMT');
        
        $this->start = 0;
        $this->size  = $this->curlSize(); 
        $this->end   = $this->size - 1;
        header("Accept-Ranges: 0-".$this->end);
         
        if (isset($_SERVER['HTTP_RANGE'])) {
  
            $c_start = $this->start;
            $c_end = $this->end;
 
            list(, $range) = explode('=', $_SERVER['HTTP_RANGE'], 2);
            if (strpos($range, ',') !== false) {
                header('HTTP/1.1 416 Requested Range Not Satisfiable');
                header("Content-Range: bytes $this->start-$this->end/$this->size");
                exit;
            }
            if ($range == '-') {
                $c_start = $this->size - substr($range, 1);
            }else{
                $range = explode('-', $range);
                $c_start = $range[0];
                 
                $c_end = (isset($range[1]) && is_numeric($range[1])) ? $range[1] : $c_end;
            }
            $c_end = ($c_end > $this->end) ? $this->end : $c_end;
            if ($c_start > $c_end || $c_start > $this->size - 1 || $c_end >= $this->size) {
                header('HTTP/1.1 416 Requested Range Not Satisfiable');
                header("Content-Range: bytes $this->start-$this->end/$this->size");
                exit;
            }
            $this->start = $c_start;
            $this->end = $c_end;
            $length = $this->end - $this->start + 1;
            //fseek($this->stream, $this->start);
            header('HTTP/1.1 206 Partial Content');
            header("Content-Length: ".$length);
            header("Content-Range: bytes $this->start-$this->end/".$this->size);
        }
        else
        {
            header("Content-Length: ".$this->size);
        }  
         
    }
    
	private function curlSize(){
		 $ch = curl_init();
	  	 curl_setopt($ch, CURLOPT_URL, $this->path);
		 curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		 curl_setopt($ch, CURLOPT_HEADER, TRUE);
		 curl_setopt($ch, CURLOPT_NOBODY, TRUE);

		 $data = curl_exec($ch);
		 $size = curl_getinfo($ch, CURLINFO_CONTENT_LENGTH_DOWNLOAD);

		 curl_close($ch);
		 return $size;
	}
     
	private function curlDownload($start,$end){
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->path);
		curl_setopt($ch, CURLOPT_RANGE, $start.'-'.$end); 	
		curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
		curl_setopt($ch, CURLOPT_ENCODING, 'identity');		
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_WRITEFUNCTION, function($ch, $chunk){
			


			if($this->testMODE==true){
				$this->cache = $chunk;
			}else{
				echo $chunk;
			}
			
			return strlen($chunk);			
			
		});
		$result = curl_exec($ch);
		curl_close($ch);
		
	}

    private function stream(){

		
		
        $i = $this->start;
		$e = $this->end;
        set_time_limit(0);
		
		$this->curlDownload($i,$e);
		
    }
     

    function start(){
        $this->open();
        $this->setHeader();
        $this->stream();
    }
}
?>