<?php 


class Redirect {
	
	public static function action( $action = 'homepage', $querystring = array() ){
		
		$url = LiteFrame::BuildActionUrl( $action );
		if(sizeof($querystring) > 0 ){ $url .= '&'.http_build_query($querystring, '&'); }
		self::redirectTo( $url );
		
	}/* </ action > */	

	
	
	public static function redirectTo( $url ){
		
		header( 'Location: ' . $url );
		
	}/* </ redirectTo > */	
	
	
	
	public static function removeFacebookQueryString(){
		
		$get = LiteFrame::FetchGetVariable();
		unset($get['fb_comment_id']);
		$action = $get['action'];
		unset($get['action']);
		self::action($action,$get);
	
	}/* </ removeFacebookQueryString > */	
	
	
}/* </ Redirect > */	

?>