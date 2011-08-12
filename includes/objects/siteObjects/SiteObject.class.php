<?php

define("EXCEPTION_CODE",0);
define("SYSTEM_EXCEPTION_CODE",1);
define("USER_FRIENDLY_EXCEPTION_CODE",2);

abstract class SiteObject {
	
	/**
	 * Custom error messages can be set here, indexed by the error tag
	 * @var array
	 */
	protected $errorMessages = array() ;
	
	/**
	 * Object results are stored here
	 * @var unknown_type
	 */
	protected $results = array();
	
	
	public function __construct() {
		try {
			$this->process();
			
		}catch(SiteObjectException $e){

			if($e->getCode() === 1){
				throw new SystemException($e->getMessage(),$e->getCode());
			}else if($e->getCode() ===  2){
				$this->userFriendlyException($e);
			}else if($e->getCode() ===  0){
				throw new Exception($e->getMessage(),$e->getCode());
			}
				
		}catch (UserFriendlyException $e){
			$this->userFriendlyException($e);
		}
	}
	
	public function getResults() { return $this->results; }

	abstract protected function process();
	
	private function getErrorMessage($e){
		
		if(isset($this->errorMessages[$e->getCode()])){
			return $this->errorMessages[$e->getCode()];
		}
		return $e->getMessage();
	}
	
	private function userFriendlyException($e){
			if(!isset($this->results['error'])){ $this->results['error'] = array(); }
			$this->results['error'][] = $this->getErrorMessage($e);
			SiteHelper::Debug( "SiteObject Exception: " , $e->__toString()); 
	}
}

?>