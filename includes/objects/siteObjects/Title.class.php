<?php 

	class Title extends SiteObject {
		
		public function __construct(){
			parent::__construct();
		}
		
		
		public function process(){
			
			$title = "Page Title";
			switch(LiteFrame::getActiveAction()){	
			}
			$this->results = $title;
			
		}
		
	}


?>