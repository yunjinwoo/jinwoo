<?php
/**
 * 1. BoardSetRow	- singleton 이며 게시판 설정 정보를 가지고 다닌다.
 * 2. BoardSet		- 게시판 추가, 수정 한다. 
 */

/** singleton 이며 게시판 설정 정보를 가지고 다닌다. */
class BoardSetRow extends FieldBoardSet
{
	private static $instance ;
	/** 게시판 아이디 */
	public $board_id			= 'board_id' ;
	/** 게시판 명 */
	public $board_name			= 'board_name' ;
	/** 페이지 출력 수 - 안쓸듯 */
	public $page_size			= 'page_size' ;
	/** 게시판 스킨 */
	public $board_skin			= 'board_skin' ;
	/** 게시판 기능 구분 */
	public $board_type			= 'board_type' ;
	/** 파일 업로드 */
	public $is_use_file			= 'is_use_file' ;
	/** 비밀글 */
	public $is_use_secret		= 'is_use_secret' ;
	/** 구분 */
	public $category			= 'category' ;
	/** 관리자 레벨 - 안쓸듯 */
	public $level_admin			= 'level_admin' ;
	/** 작성 레벨 */
	public $level_write			= 'level_write' ;
	/** 보기 레벨 */
	public $level_view			= 'level_view' ;
	/** 댓글 레벨 */
	public $level_comment		= 'level_comment' ;
	/** new 이미지 노출 시간 */
	public $img_new_hour		= 'img_new_hour' ;
	/** hot 이미지 출력 조회건 */
	public $img_hot_cnt			= 'img_hot_cnt' ;
	/** 리스트 출력 수 */
	public $list_count			= 'list_count' ;

	/** 스킨 path */
	public $skin_path			= 'skin_path' ;
	
	
	/**
	 * list 에 사용하는 변수 
	 * 시작 번호 */
	public $start_num			= '' ;
	/**
	 * list 에 사용하는 변수 
	 * 페이지 번호 */
	public $page				= '' ;
	/**
	 * list 에 사용하는 변수 
	 * 검색 필드 */
	public $search_field		= '' ;
	/**
	 * list 에 사용하는 변수 
	 * 검색 키워드 */
	public $search_keyword		= '' ;
	
	public $BtnSetter ;
	public $LevelChecker ;

	private function __construct() {}
	
	public static function singleton()
    {
        if (!isset(self::$instance)) {
            self::$instance = new BoardSetRow() ;
        }else{
			if( self::$instance->board_id == 'board_id' )
				errorDebug( '멤버 변수 설정 안됨' ) ;
		}
        return self::$instance;
    }
	public function setRow( $aSetRow )
	{
		foreach( $aSetRow as $k => $v )
			if(property_exists( $this , $k))
				$this->{$k} = $v ;
		
		$this->BtnSetter = BtnSetter::create() ;
		$this->BtnSetter->setHref($this->board_id) ;
				
		$this->LevelChecker = LevelChecker::create() ;
		
		$this->skin_path = _SKIN_PATH_.'/board/'.$this->board_skin ;
	}
}


/** 게시판 추가, 수정 한다. */
class BoardSet extends FieldBoardSet
{
	/**
	CREATE TABLE IF NOT EXISTS `add_board_set` (
		`board_id` varchar(50) NOT NULL COMMENT '게시판아이디',
		`board_name` varchar(50) NOT NULL COMMENT '게시판이름',
		`page_num` tinyint(3) unsigned NOT NULL COMMENT '페이지 출력갯수',
		`board_type` enum('free','qa','poll') NOT NULL DEFAULT 'free' COMMENT '게시판 기능 구분',
		`board_skin` varchar(30) NOT NULL COMMENT '게시판스킨',
		`is_use_file` enum('Y','N') DEFAULT 'N',
		`is_use_secret` enum('Y','N','A') DEFAULT 'N',
		`category` text NOT NULL COMMENT '카테고리',
		`level_admin` tinyint(3) unsigned NOT NULL COMMENT '레벨-관리자',
		`level_write` tinyint(3) unsigned NOT NULL COMMENT '레벨-쓰기',
		`level_view` tinyint(3) unsigned NOT NULL COMMENT '레벨-보기',
		`level_comment` tinyint(3) unsigned NOT NULL COMMENT '레벨-댓글',
		`img_new_hour` int(10) unsigned NOT NULL DEFAULT '48' COMMENT 'New 이미지 출력 시간',
		`img_hot_cnt` int(10) unsigned NOT NULL DEFAULT '40' COMMENT 'Hot 이미지 출력 조건(조회수)',
		`list_count` int(10) unsigned NOT NULL DEFAULT '15' COMMENT '리스트 출력 갯수',
		UNIQUE KEY `board_id` (`board_id`)
	) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='게시판 설정 정보';
	 * 	 
	 * 
CREATE TABLE IF NOT EXISTS `add_board_comment` (
  `comment_idx` int(10) unsigned NOT NULL auto_increment,
  `board_idx` int(10) unsigned NOT NULL default '0',
  `board_id` varchar(50) character set utf8 NOT NULL,
  `is_lock` char(1) character set utf8 NOT NULL default 'N' COMMENT '작성자만 확인:Y,N',
  `write_name` varchar(30) character set utf8 NOT NULL default '',
  `userid` varchar(20) character set utf8 NOT NULL default '',
  `passwd` varchar(55) character set utf8 NOT NULL COMMENT '비밀번호(md5)',
  `comment` text character set utf8 NOT NULL,
  `write_date` datetime NOT NULL default '0000-00-00 00:00:00',
  KEY `comment_idx` (`comment_idx`)
) ENGINE=MyISAM DEFAULT CHARSET=euckr AUTO_INCREMENT=1 ;
	 * 
	 */
	
	
	/**
	 * 게시판 설정 정보 가져오기
	 */
	public function getSetList( $sBoardId = '' )
	{
		$aReturn = array() ;
		
		$sWhere = '' ;
		if( $sBoardId != '' )
			$sWhere = ' WHERE board_id = \''.$sBoardId.'\' ' ;
		
		$q = 'SELECT * FROM '.self::table.' '.$sWhere.' ORDER BY board_name ' ;
		$r = str_query($q) ;
		while($a = fetch_assoc($r) )
			$aReturn[$a['board_id']] = $a ;
			
		return $aReturn ;
	}

	/**
	 * boardDataChecker 길어서 한글자로...
	 */
	private function C( $key , $value )
	{
		if( !empty($value) )
			return $value ;
		
		$r = 0 ;
		switch( $key )
		{
			// string 
			case 'board_id'		:
			case 'board_name'	:	
			case 'board_skin'	:
			
			case 'is_use_file'	:
			case 'is_use_file'	:	
			case 'is_use_secret':
			case 'category'		:
				$r = '' ;
			break ;
			
			// int 
			case 'page_size'	:
			case 'level_admin'	:
			case 'level_write'	:
			case 'level_view'	:	
			case 'level_comment':
			case 'img_new_hour'	:
			case 'img_hot_cnt'	:	
			case 'list_count'	:
			break ;
		}
		
		return $r ;
	}
	
	public function updateBoardSet($aBoardFormData)
	{
		// 평소에는 return 한다.
		// board_id 에 대한 필터링이 없다....
		
		if( count($aBoardFormData) < 10 )
			return ;
		
		foreach($aBoardFormData as $k => $v )
			$aBoardFormData[$k] = self::C( $k , $v ) ;
		
		$q = '
			REPLACE INTO add_board_set
			SET
				board_id		= \''.$aBoardFormData['board_id'].'\' 
			,	board_name		= \''.$aBoardFormData['board_name'].'\' 
			,	page_size		=   '.$aBoardFormData['page_size'].'
			,	board_skin		= \''.$aBoardFormData['board_skin'].'\'
			,	board_type		= \''.$aBoardFormData['board_type'].'\'
			,	is_use_file		= \''.$aBoardFormData['is_use_file'].'\'
			,	is_use_secret	= \''.$aBoardFormData['is_use_secret'].'\'
			,	category		= \''.$aBoardFormData['category'].'\'
			,	level_admin		=   9 
			,	level_write		=   '.$aBoardFormData['level_write'].'
			,	level_view		=   '.$aBoardFormData['level_view'].'
			,	level_comment	=   '.$aBoardFormData['level_comment'].'
			,	img_new_hour	=   '.$aBoardFormData['img_new_hour'].'
			,	img_hot_cnt		=   '.$aBoardFormData['img_hot_cnt'].'
			,	list_count		=   '.$aBoardFormData['list_count'].'
		' ;
		//echo $q ; 
		str_query($q) ;	
		
		$q = '
			CREATE TABLE IF NOT EXISTS `add_board_data` (
				`board_idx` int(10) unsigned NOT NULL auto_increment,
				`user_id` varchar(50) NOT NULL,
				`idx_group` int(11) default NULL,
				`dep_step` float unsigned default \'1000\',
				`passwd` varchar(20) NOT NULL default \'\',
				`category` varchar(50) NOT NULL default \'\',
				`email` varchar(60) NOT NULL,
				`write_name` varchar(30) NOT NULL default \'\',
				`subject` varchar(255) default NULL,
				`homepage` varchar(30) NOT NULL,
				`content` text,
				`islock` char(1) NOT NULL default \'n\',
				`rcount` int(10) unsigned NOT NULL default \'0\' COMMENT \'조회수\',
				`recom` int(10) unsigned NOT NULL default \'0\' COMMENT \'댓글수??\',
				`write_date` datetime NOT NULL default \'0000-00-00 00:00:00\',
				PRIMARY KEY  (`board_idx`)
			) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
			

			CREATE TABLE IF NOT EXISTS `add_board_comment` (
				`comment_idx` int(10) unsigned NOT NULL auto_increment,
				`board_idx` int(10) unsigned NOT NULL default \'0\',
				`board_id` varchar(50) character set utf8 NOT NULL,
				`is_lock` char(1) character set utf8 NOT NULL default \'N\' COMMENT \'작성자만 확인:Y,N\',
				`write_name` varchar(30) character set utf8 NOT NULL default \'\',
				`userid` varchar(20) character set utf8 NOT NULL default \'\',
				`passwd` varchar(55) character set utf8 NOT NULL COMMENT \'비밀번호(md5)\',
				`comment` text character set utf8 NOT NULL,
				`write_date` datetime NOT NULL default \'0000-00-00 00:00:00\',
				KEY `comment_idx` (`comment_idx`)
			) ENGINE=MyISAM DEFAULT CHARSET=euckr AUTO_INCREMENT=1 ;
		' ;
		//
		//str_query($q) ;	
	}
}
?>