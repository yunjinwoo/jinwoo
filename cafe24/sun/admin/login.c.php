<?php
/**
 * 
 */
class DataLogin {
	private $userName ;
	private $userId ;


	function __construct()
	{
		$this->DataLogin() ;
	}

	function DataLogin()
	{
		$this->__set('userName',	G::session('user_name') );
		$this->__set('userId',		G::session('user_id')   );
	}

	public function __set($name, $value)
    {
        $this->$name = $value;
    }

}


//require_once _PATH_LIB_.'/module/Login.c.php' ;
/**
 *
 */
class Login {
	function __construct()
	{
		$this->Login() ;
	}

	function Login()
	{
	
	}

	function isUser()
	{
		return !empty($_SESSION['user_id']) ;
	}

	function loginExec()
	{
		$userid = G::post('userid') ;
		$userpw = G::post('userpw') ;
		if( empty($userid) || empty($userpw) )
			return ;

		if( $userid === _USERID_ && $userpw === _PASSWD_ )
		{
			$_SESSION['user_name']	= "관리자" ;
			$_SESSION['user_id']	= $userid ;
		}
	}

	function logout()
	{
		$_SESSION['user_name']	= "" ;
		$_SESSION['user_id']	= "" ;
	}
}