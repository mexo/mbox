<?php 

	/**
	 * Site Objects Can be Considered as Factory Classes. 
	 * try to do all your development under Core Objects.
	 * 
	 * try to hadle all you error handings here instead of having it in other Classes.
	 * pass all exceptions to SiteObjectHere
	 * 
	 * @author spedramr
	 * @throws SiteObjectException
	 */
	class Test extends SiteObject{
		
		public function __construct(){
			
			parent::__construct();
		
		}
		
		protected function process(){
		
			//throw new SiteObjectException("WOW",USER_FRIENDLY_EXCEPTION_CODE);
		
		}
		
	}



?>