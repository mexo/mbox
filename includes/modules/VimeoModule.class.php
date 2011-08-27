<?php 

	class VimeoModule{
		
		public function __construct(){}
		
		private static $VIMEO_VIDEO_URL = 'vimeo.com/api/v2/video/%d.php';
		
		public static function getMediumThumbnailUrl($videoId){
			
			$url = sprintf(self::$VIMEO_VIDEO_URL,$videoId);
			$data = self::getVimeoGenealInfo($url);
			return $data['thumbnail_medium'];
			
		}
		
		private static function getVimeoGenealInfo($url){

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, 1);
			// grab URL and pass it to the browser
			$data = curl_exec($ch);
			curl_close($ch);
			$finaldata = unserialize($data);
			return $finaldata[0];
			
		}
		
		public static function getVimeoUrl($vimeoId, $autoplay=false){
			
			$autoplay = ($autoplay)?1:0;
			return "http://player.vimeo.com/video/".$vimeoId."?title=0&amp;byline=0&amp;portrait=0&amp;autoplay=".$autoplay;
		
		}
		
		
		public static function getNumberOfPlays($videoId){
			
			$url = sprintf(self::$VIMEO_VIDEO_URL,$videoId);
			$data = self::getVimeoGenealInfo($url);
			return $data['stats_number_of_plays'];
			
		}
		
		public static function getDurationByMinute($videoId){
			
			$url = sprintf(self::$VIMEO_VIDEO_URL,$videoId);
			$data = self::getVimeoGenealInfo($url);
			return $data['stats_number_of_plays'];
			
		}
		
		
	}

?>