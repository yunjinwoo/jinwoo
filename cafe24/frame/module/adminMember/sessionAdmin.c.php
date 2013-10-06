<?php
require_once _PATH_lib_.'/session.c.php';
 

 /**
  * 관리자 세션 관리
  * 껍데기만 존재한다....
  * 
  * @version 1
  */
class SessionAdmin extends Session{
	function __construct() {
		parent::__construct();
		
//		$q = _SQL_ADMIN_MEMBER_SELECT_ ;		
//		db()->prepare($q) ;
	}
	
	/**
	 * 세션에 로그인정보를 추가한다.
	 * 
	 * @param string $admin_id 관리자아이디
	 * @param string $admin_name 관리자 이름
	 * @return void
	 */
	function setLogin($admin_id, $admin_name)
	{
		// 추후 로그인 정보 넣기
		$this->setSession('userid'	, $admin_id) ;
		$this->setSession('username', $admin_name) ;
	}
	
	function isAdmin()
	{
		
	}
	
}

