<?php 
		//error_reporting(0);
		 require_once('includes/functions.php');
		$link = (isset($_GET['link'])) ? $_GET['link'] : '';
            $dailymotion = preg_match('/(www.?|)dailymotion.com\/.*/', $link, $match);		

			switch (true) {
				case $dailymotion:
						$sources = dailymotion($link);
					break;				
				default:
					 $sources = '{"label":"HD","type":"video\/mp4","file":"https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/Sintel.mp4"}';
					break;
			}
			echo $sources;


?>
