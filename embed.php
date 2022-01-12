<?php 
/**
 * Name: APICodes CPanel
 * Version: 1.0, Last updated: June 30, 2020
 * Website: https://apicodes.com
 * Contact: Support@apicodes.com
 */ 
		//error_reporting(0);
		 require_once('includes/functions.php');
		$link = (isset($_GET['link'])) ? $_GET['link'] : '';
		    $okru             = preg_match('/(www.?|)ok.ru\/.*/', $link, $match);
            $linkembed        = preg_match('/embedsito\.com|fvs\.io|dutrag\.com|vidsrc\.xyz|feurl\.|fcdn\.stream|fembed\.|femax\d+\.com|gcloud\.live|bazavox\.com|xstreamcdn\.com|smartshare\.tv|streamhoe\.online|animeawake\.net|mediashore\.org|sexhd\.co|diasfem\.com|streamm4u\.club/', $link, $match);
			$ninjastream      = preg_match('/(www.?|)ninjastream.to\/.*/', $link, $match);
            $pregAmazonDrive  = preg_match('/(www.?|)amazon.com\/.*/', $link, $match);
			$pregArchive      = preg_match('/(www.?|)archive.org\/.*/', $link, $match);	
			$pregBlogger      = preg_match('/(www.?|)(blogspot.com|blogger.com)\/.*/', $link, $match);
			$pregFacebook     = preg_match('/(www.?|)facebook.com\/.*/', $link, $match);	
			$pregGoogleDrive  = preg_match('/(www.?|)drive.google.com\/.*/', $link, $match);
			$pregGooglePhotos = preg_match('/(www.?|)(photos.google.com|photos.app.goo.gl)\/.*/', $link, $match);
			$pregMP4Upload    = preg_match('/(www.?|)mp4upload.com\/.*/', $link, $match);
			$pregMediafire    = preg_match('/(www.?|)mediafire.com\/.*/', $link, $match);
			$pregOneDrive     = preg_match('/(www.?|)1drv.ms\/.*/', $link, $match);
			$pregRumble       = preg_match('/(www.?|)rumble.com\/.*/', $link, $match);
			$pregSendSpace    = preg_match('/(www.?|)sendspace.com\/.*/', $link, $match);
			$pregSolidfiles   = preg_match('/(www.?|)solidfiles.com\/.*/', $link, $match);
			$pregSoundCloud   = preg_match('/(www.?|)soundcloud.com\/.*/', $link, $match);
			$pregStreamable   = preg_match('/(www.?|)streamable.com\/.*/', $link, $match);
			$pregTikTok       = preg_match('/(www.?|)tiktok.com\/.*/', $link, $match);
			$pregVimeo        = preg_match('/(www.?|)vimeo.com\/.*/', $link, $match);
			$pregYandex       = preg_match('/(www.?|)yadi.sk\/.*/', $link, $match);
			$pregYoutube      = preg_match('/(www.?|)youtube.com\/.*/', $link, $match);
			$pregZippyshare   = preg_match('/(www.?|)zippyshare.com\/.*/', $link, $match);
			$pregpCloud       = preg_match('/(www.?|)pcloud.com\/.*/', $link, $match);

			switch (true) {
				case $okru:
						$sources = okru($link);
					break;
				case $ninjastream:
						$sources = ninjastream($link);
					break;
				case $linkembed:
						$sources = fembed($link);
					break;
				case $pregAmazonDrive:
						
						$sources = amazon_drive($link);

					break;
				case $pregArchive:
					
						$sources = archive($link);

					break;

				case $pregBlogger:
					
						$sources = blogger($link);

					break;

				case $pregFacebook:
					
						$sources = facebook($link);

					break;

				case $pregGoogleDrive:

						$sources = google_drive($link);
					
					break;

				case $pregGooglePhotos:

						$sources = google_photos($link);
					
					break;

				case $pregMP4Upload:
						
						$sources = mp4upload($link);

					break;

				case $pregMediafire:

						$sources = mediafire($link);
					
					break;

				case $pregOneDrive:
						
						$sources = onedrive($link);

					break;

				case $pregRumble:
						
						$sources = rumble($link);

					break;

				case $pregSoundCloud:

						$sources = soundcloud($link);
					
					break;

				case $pregStreamable:
						
						$sources = streamable($link);

					break;

				case $pregTikTok:
						
						$sources = tiktok($link);

					break;

				case $pregVimeo:
						
						$sources = vimeo($link);

					break;

				case $pregYandex:
						
						$sources = yandex($link);

					break;

				case $pregYoutube:
						
						$sources = youtube($link);

					break;

				case $pregZippyshare:
						
						$sources = zippyshare($link);

					break;

				case $pregpCloud:
						
						$sources = pcloud($link);

					break;
				
				default:
					 $sources = '{"label":"HD","type":"video\/mp4","file":"https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/Sintel.mp4"}';
					break;
			}

			echo $sources;


?>
