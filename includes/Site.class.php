<?php 


/**
* @name         Site Class 
* @author        Mahdi Pedram
* @access        Mexo Programming Team
* @version       1.0
* @copyright     Mexo INC
*
*/


session_start(); // start up your PHP session! 

require_once(LiteFrame::GetFileSystemPath()."includes/SiteHelper.class.php");

class Site extends SiteHelper{
	
	public function __construct(){
		$args = func_get_args();
		if( count($args) === 1 && $args[0] == 'jsonrpc' ){
			$this->jsonrpc();
			return;
		}	
		try{
			
			$this->process( func_get_args() );
			
		}catch ( SystemException $e ){			
			SiteHelper::Debug($e->__toString());
			LiteFrame::WriteLog( $e->__toString(), $e->getMessage() );
			exit();
			
		}catch( Exception $e){
			print_r($e);
			SiteHelper::Debug($e->__toString());
			LiteFrame::WriteLog( $e->__toString(), $e->getMessage() );
			exit();
			
		}
		
	} /* </ __construct >  */
  
	
	private function process( $args ){

			parent::__construct();
			
			$requiredObjects = GlobalUtil::getArguments( $args );
			
			if(!LiteFrame::IsAjax()) {  $this->loadObjects( self::$staticObjects ); }
			
			if( !empty( $requiredObjects ) ){
			
				$this->loadObjects( $requiredObjects );
			
			}		
			
			$this->setObjectsForTemplate(); 
		
	}/* </ process > */
	
	
	private function loadObjects( $requiredObjects ){
		//throw new Exception("shoot");
		foreach($requiredObjects as $obj){ 
			$this->generateObject( $obj, lcfirst($obj) );  
		}
	}/* </ loadObjects >  */	
	

	private function generateObject($className, $field) {

		$this->siteObjects[$field] = new $className();
		
		self::$siteObjectsData[$field] = $this->siteObjects[$field]->getResults();
		
	}/* </ generateObject >  */	
	
	
	private function jsonrpc(){
			parent::__construct();
			$post = LiteFrame::FetchPostVariable();
			$api = new $post['api']();
			self::$siteObjectsData[$post['api'] . "_" . $post['method']] = call_user_func_array(array($api, $post['method']), $post['config']);
			$this->setObjectsForTemplate(); 
	}
	
}	/* </Site> */


?>