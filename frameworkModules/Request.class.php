<?php 

	class Request {
				
		public static function issetFields($feilds, $type='GET'){
			
			$requestObj = ($type=='GET')? LiteFrame::FetchGetVariable() : LiteFrame::FetchPostVariable();
			foreach($feilds as $field){
				if(!isset($requestObj[$field])){
					return false;
				}
			}
			return true;
		}
		
		public static function hasEmptyField($feilds, $type='GET'){
			
			$requestObj = ($type=='GET')? LiteFrame::FetchGetVariable() : LiteFrame::FetchPostVariable();
			foreach($feilds as $field){
				if(empty($requestObj[$field])){
					return true;
				}
			}
			return false;
		}
		
		public static function trimAllRequest($type='GET'){
			
			$requestObj = ($type=='GET')? LiteFrame::FetchGetVariable() : LiteFrame::FetchPostVariable();
			foreach($requestObj as $key=>$field){
				$requestObj[$key] = trim($field);
			}
			return $requestObj;
		}
		
	}

?>