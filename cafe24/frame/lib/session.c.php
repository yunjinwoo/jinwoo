<?php
		
/**
 * Description of session
 *
 * @author Administrator
 */
class Session {
	protected $userid ;
	protected $username ;
	protected $tmpArr ;
	
	function __construct(){

		$this->userid =		isset($_SESSION['userid'])?$_SESSION['userid']:'' ;
		$this->username =	isset($_SESSION['username'])?$_SESSION['username']:'' ;
		
		$tmpSession = $_SESSION ;
		unset( $tmpSession['userid'] ) ;
		unset( $tmpSession['username'] ) ;
		foreach( $tmpSession as $k => $v )
			$this->tmpArr[$k] = $v ;
	}
	
	function destroy()
	{
		session_destroy() ;
	}
	
	function getMd5key()
	{
//		$key = $this->getSession('md5_key') ;
//		if( empty($key) )
//			$this->setSession ('md5_key', md5( microtime(true).$_SERVER['REMOTE_ADDR'].session_id()) ) ;
//		return $this->getSession('md5_key') ;
		return md5( microtime(true).$_SERVER['REMOTE_ADDR'].session_id()) ;
	}
	
	function setSession( $key , $value )
	{
		if( property_exists ( $this , $key) )
		{
			$_SESSION[$key] = $this->{$key} = $value ;
		}else
			$_SESSION[$key] = $this->tmpArr[$key] = $value ;
		//	throw new Exception( "[".$key."] session".print_r(debug_backtrace(), true)); 
	}
	
	
	function getSession($k)
	{
		return $this->tmpArr[$k] ;
	}
	
	function getUserid()
	{
		return $this->userid ;
	}
	
	function getUsername()
	{
		return $this->username ;
	}
	
}

//$Session->setSession('test', 'wqrwqra');
//echo $Session->getSession('test') ;
//print_r($_SESSION);
