<?php

class BoardInfo extends SingletonParent
{
	private $notSetProperty = array('board_set_table') ;
	private $board_set_table = 'add_board_set' ;

	private $board_id;
    private $board_name;
    private $board_skin;
    private $board_type;
    private $is_use_file;
    private $is_use_secret;
    private $category;
    private $level_admin;
    private $level_write;
    private $level_view;
    private $level_comment;
    private $img_new_hour;
    private $img_hot_cnt;
    private $skin_path;


    private $page_size;
    private $list_count;

    private $nBoardIdx;
    private $nPage;
    private $sSearchKeyword;
	private $sWhere ;

	
	private $aHref = array() ;
	private $aBtnTag = array() ;

	protected function __construct() 
	{}

	public static function create()
    {
		$a = parent::singleton(__CLASS__) ;
		$a->skin_path = dirname(__FILE__) ;
		return $a ;
    }
	
	private function notSetProprety($name)
	{
		return in_array($name , $this->notSetProperty) ;
	}

	public function setBoardInfo( $boardInfo )
	{
		foreach( $boardInfo as $k => $v )
			if( $this->exists($k) )
				$this->{$k} = $v ;
			else
				errorDebug( '[$k : '.$k.'=>'.$v.'] property_exists by BoardInfo ' );
	}

	public function exists($name)
	{
		return property_exists($this, $name) ;
	}	
	
	public function __set($name, $value)
    {
		if( $this->notSetProprety($name) )
			errorDebug( '[$name : '.$name.'] notSetProprety by BoardInfo ' );
			
        if( $this->exists($name) )
			$this->{$name} = $value ;
		else
			errorDebug( '[$name : '.$name.'] property_exists by BoardInfo ' );
    }

    public function __get($name)
    {
		if( $this->exists($name) )
			return $this->{$name};
        else
			errorDebug( '[$name : '.$name.'] property_exists by BoardInfo ' );
    }
}
