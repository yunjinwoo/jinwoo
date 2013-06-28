<?php

class UseingSession extends SingletonParent
{
	public $name	= '' ;
	public $level	= '' ;
	public $userid	= '' ;
	
	protected function __construct() 
	{
		/*
		
		$this->name = '관리자' ;
		$this->level = '9' ;
		$this->userid = 'admin' ;
		
		$this->name = '' ;
		$this->level = '0' ;
		$this->userid = '' ;
		*/
		$this->name = '' ;
		$this->level = '' ;
		$this->userid = '' ;
		
	}
	
	public static function create()
    {
		return parent::singleton(__CLASS__) ;
    }
}

#######################
class LevelChecker extends SingletonParent
{
	private $BoardInfo ;
	
	protected function __construct() 
	{
		$this->BoardInfo		= getBoardInfoClassProprety() ;
		$this->UseingSession	= UseingSession::create() ;
	}
	
	public static function create()
    {
       return parent::singleton(__CLASS__) ;
    }
	
	public function isAdmin()
	{
		return $this->BoardInfo->level_admin <= $this->UseingSession->level ;
	}
	public function isMember( $check_id = '' )
	{
		if( empty($check_id) )
			return !empty($this->UseingSession->user_id) ;
		else
			return !empty($this->UseingSession->user_id) && $this->UseingSession->user_id == $check_id ;
		
	}
	public function isWriter( $check_id )
	{
		return !empty($check_id) && $check_id == $this->UseingSession->userid ;
	}
	public function isWriteLevel()
	{
		return $this->BoardInfo->level_write <= 0 || $this->BoardInfo->level_write <= $this->UseingSession->level ;
	}
	public function isViewLevel()
	{
		return $this->BoardInfo->level_view <= 0  || $this->BoardInfo->level_view <= $this->UseingSession->level ;
	}
}
