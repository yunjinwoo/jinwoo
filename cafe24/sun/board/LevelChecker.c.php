<?php


class LevelChecker extends SingletonParent
{
	private $BoardSetRow ;
	private $UseingSession ;
	
	protected function __construct() 
	{
		$this->BoardSetRow = BoardSetRow::singleton() ;
		$this->UseingSession = UseingSession::create() ;
	}
	
	public static function create()
    {
       return parent::singleton(__CLASS__) ;
    }
	
	public function isAdmin()
	{
		return $this->BoardSetRow->level_admin <= $this->UseingSession->level ;
	}
	public function isMember( $check_id = '' )
	{
		if( empty($check_id) )
			return !empty($this->UseingSession->user_id) ;
		else
			return !empty($this->UseingSession->user_id) && $this->UseingSession->user_id == $check_id ;
		
	}
	public function isWriter()
	{
		return empty($this->BoardSetRow->level_write) || $this->BoardSetRow->level_write <= $this->UseingSession->level ;
	}
	public function isViewer()
	{
		return empty($this->BoardSetRow->level_view) || $this->BoardSetRow->level_view <= $this->UseingSession->level ;
	}
}

?>
