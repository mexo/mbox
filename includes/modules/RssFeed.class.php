<?php 
	class RssFeed{

		private static $RSS_XML;			
		private static $RSS_ITEM_XML;
		
		private $link;
		private $title;
		private $desc;
		private $lang;
		private $copyright;
		private $items;

		

		public function __construct(){
			header("Content-Type: application/rss+xml; charset=utf-8");
			self::$RSS_XML = 
			"<?xml version='1.0' encoding='utf-8'?>\n".
		    "<rss version='2.0' xmlns:atom='http://www.w3.org/2005/Atom'>\n".
			    "<channel>\n".
					"<atom:link href='http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']."' rel=\"self\" type=\"application/rss+xml\" />\n".
				    "<title>%s</title>\n".
				    "<link>%s</link>\n".
				    "<description>%s</description>\n".
				    "<language>%s</language>\n".
					"<lastBuildDate>".gmdate("r", time())."</lastBuildDate>\n".
				    "<copyright>%s</copyright>\n".
				"%s".
				"</channel>\n".
			 "</rss>\n";	
			
			self::$RSS_ITEM_XML = 
			"<item>\n".
        		"<title>%s</title>\n".
				"<description>%s</description>\n".
				"<link>%s</link>\n".
				"<guid>%s</guid>\n".
				"<pubDate>%s</pubDate>\n".
			"</item>\n";
		}
		
		public function setTitle($title){
			$this->title = $title;
		}
		
		public function setLink( $link ){
			$this->link = $link;
		}
		
		public function setDesc($desc){
			$this->desc = $desc;
		}
		
		public function setLang($lang){
			$this->lang = $lang;
		}
		
		public function setCopyright($copyright){
			$this->copyright = $copyright;
		}
		
		public function addItem( $title, $descrition, $link, $pubDate){
			
			$this->items[] = array(
				'title'=> $title,
				'descrition'=> $descrition,
				'link'=> $link,
				'pubDate'=> $pubDate
			);
			
		}
		
		public function getResult(){
			
			return sprintf(
				self::$RSS_XML,
				$this->title,
				$this->link,
				$this->desc,
				$this->lang,
				$this->copyright,
				$this->builtItemsXML()
			);
			
		}
		
		private function builtItemsXML(){
			$items = array();
			foreach($this->items as $item){
			        $items[] = sprintf(
			        	self::$RSS_ITEM_XML,
			        	$item['title'],
			        	$item['descrition'],
			        	htmlentities($item['link']),
			        	htmlentities($item['link']),
			        	date("r", strtotime($item['pubDate']))
			        );
    		}	
    		return implode("\n", $items);
    		
		}
		
	}

?>