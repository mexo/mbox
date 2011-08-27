<?php

class JsonRPCLoader {
		
	public static function loader( $className ){

		$path = LiteFrame::GetFileSystemPath().'includes/jsonrpc/'.$className.'.class.php';
		
		if( !file_exists( $path ) ){ return false; }
			
		require_once ( $path );
		
	}/* </ Loader >*/	
	
}


spl_autoload_register( array( 'JsonRPCLoader', 'loader' ) ); // As of PHP 5.3.0

?>