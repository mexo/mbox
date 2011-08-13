<?php
 
class FrameworkModuleLoader {
		
	public static function Loader( $className ){
		
		$path = LiteFrame::GetFileSystemPath().'frameworkModules/'.$className.'.class.php';
		
		if( !file_exists( $path ) ){ return false; }
			
		require_once ( $path );
		
	}/* </ Loader >*/	
	
}


spl_autoload_register( array( 'FrameworkModuleLoader', 'Loader' ) ); // As of PHP 5.3.0


?>