<?php


class BtnSetter extends SingletonParent
{
	private $board_id ; 
	
	public $href_list		= '' ;
	public $href_write		= '' ;
	public $href_view		= '' ;
	public $href_modify 	= '' ;
	public $href_passwd 	= '' ;
	public $href_delete 	= '' ;
	public $href_cancel 	= '' ;
	public $href_check		= '' ;
	
	public $href_comment_modify	= '' ;
	public $href_comment_delete	= '' ;
	
	public $img_list		= '' ;
	public $img_write		= '' ;
	public $img_view		= '' ;
	public $img_modify		= '' ;
	public $img_passwd		= '' ;
	public $img_delete		= '' ;
	public $img_cancel 	= '' ;
	public $img_check 	= '' ;
	
	protected function __construct(){}
	
	public static function create()
    {
		return parent::singleton(__CLASS__) ;
    }
	
	public function setHref( $board_id )
	{	
		$this->board_id = $board_id ;
		
		## list
		$this->href_list	= '?mode=list&board_id='.$board_id ;
		$this->img_list		= '<img alt="글목록" src="/common/images/comm/btn/btn_a_list.gif">' ;
		
		## write
		if(LevelChecker::create()->isWriteLevel() )
			$this->href_write	= '?mode=write&board_id='.$board_id ;
		else
			$this->href_write	= 'javascript:alert( \'권한이 없습니다.\' );' ;
		
		$this->img_write = '<img src="/common/images/comm/btn/btn_a_write.gif" alt="글쓰기" />' ;
		
		## cancel 
		$this->href_cancel	= '?mode=list&board_id='.$board_id ;
		$this->img_cancel	= '<img alt="취소" src="/common/images/comm/btn/btn_a_cancel.gif">' ;
		
		## modify 
		$this->href_modify	= 'javascript:;" onclick="modifySubmit();' ;
		$this->img_modify	= '<img alt="수정" src="/common/images/comm/btn/btn_a_modify.gif">' ;
				
		## delete 
		$this->href_delete	= 'javascript:;" onclick="deleteSubmit();' ;
		$this->img_delete	= '<img alt="삭제" src="/common/images/comm/btn/btn_a_del.gif">' ;
		
		## check 
		$this->href_check	= 'javascript:;" onclick="writeSubmit();' ;
		$this->img_check	= '<img alt="확인" src="/common/images/comm/btn/btn_a_check.gif">' ;
		

			//	<img src="/common/images/comm/btn/btn_a_cancel.gif" alt="취소" />
			//	<img src="/common/images/comm/btn/btn_a_del.gif" alt="삭제" />
		/*
		 * 
		case 'list'		: $btn = '<a href="'.$this->href_list.'">'.$this->img_list.'</a>'		; break ;
		case 'view'		: $btn = '<a href="'.$this->href_view.'">'.$this->img_view.'</a>'		; break ;
		case 'write'	: $btn = '<a href="'.$this->href_write.'">'.$this->img_write.'</a>'		; break ;
		case 'passwd'	: $btn = '<a href="'.$this->href_passwd.'">'.$this->img_passwd.'</a>'	; break ;
		case 'modify'	: $btn = '<a href="'.$this->href_modify.'">'.$this->img_modify.'</a>'	; break ;
		case 'check'	: $btn = '<a href="'.$this->href_check.'">'.$this->check.'</a>'			; break ;
		case 'cancel'	: $btn = '<a href="'.$this->href_cancel.'">'.$this->img_cancel.'</a>'	; break ;
		case 'delete'	: $btn = '<a href="'.$this->href_delete.'">'.$this->img_delete.'</a>'	; break ;
		 * 
		$btn_check	= $this->BoardSetRow->BtnSetter->getBtn('check') ;
		$img_check	= $this->BoardSetRow->BtnSetter->img_check ;
		$href_check = $this->BoardSetRow->BtnSetter->href_check ;
		
		$btn_cancel = $img_cancel = $href_cancel = '' ;
		$btn_cancel	= $this->BoardSetRow->BtnSetter->getBtn('cancel') ;
		$img_cancel	= $this->BoardSetRow->BtnSetter->img_cancel ;
		$href_cancel = $this->BoardSetRow->BtnSetter->href_cancel ;
		
		$btn_delete = $img_delete = $href_delete = '' ;
		$btn_delete	= $this->BoardSetRow->BtnSetter->getBtn('delete') ;
		$img_delete = $this->BoardSetRow->BtnSetter->img_delete ;
		$href_delete = $this->BoardSetRow->BtnSetter->href_delete ;*/
	}
	
	function getPageHref( $page = '' )
	{
		return $this->href_list.'&page='.$page ;
	}
	
	function getViewHref( $board_idx = '' )
	{
		if( !is_numeric($board_idx) )
			return ;
		
		return $this->href_view	= '?mode=view&board_id='.$this->board_id.'&board_idx='.$board_idx ;
	}
	
	function setHrefComment( $comment_idx = '' )
	{
		if( empty($this->href_view) )	return ;
		if( !is_numeric($comment_idx) )	return ;
			
		$this->href_comment_modify	= $this->href_view.'&comment_mode=modify&comment_idx='.$comment_idx ;
		$this->href_comment_delete	= $this->href_view.'&comment_mode=delete&comment_idx='.$comment_idx ;
	}
	
	public function getBtn($mode = '')
	{
		$btn = '' ;
		switch($mode)
		{
			case 'list'		: $btn = '<a href="'.$this->href_list.'">'.$this->img_list.'</a>'		; break ;
			case 'view'		: $btn = '<a href="'.$this->href_view.'">'.$this->img_view.'</a>'		; break ;
			case 'write'	: $btn = '<a href="'.$this->href_write.'">'.$this->img_write.'</a>'		; break ;
			case 'passwd'	: $btn = '<a href="'.$this->href_passwd.'">'.$this->img_passwd.'</a>'	; break ;
			case 'modify'	: $btn = '<a href="'.$this->href_modify.'">'.$this->img_modify.'</a>'	; break ;
			case 'check'	: $btn = '<a href="'.$this->href_check.'">'.$this->img_check.'</a>'		; break ;
			case 'cancel'	: $btn = '<a href="'.$this->href_cancel.'">'.$this->img_cancel.'</a>'	; break ;
			case 'delete'	: $btn = '<a href="'.$this->href_delete.'">'.$this->img_delete.'</a>'	; break ;
			
			case 'comment_modify'	: $btn = '<a href="'.$this->href_comment_modify.'">'.$this->img_modify.'</a>'	; break ;
			case 'comment_delete'	: $btn = '<a href="'.$this->href_comment_delete.'">'.$this->img_delete.'</a>'	; break ;
		}
		
		return $btn ;
	}
	
	public function move( $mode , $msg = '' , $isReplace = true )
	{
		require_once _ADD_.'/FirePHPCore/FirePHP.class.php';
		$firephp = FirePHP::getInstance(true);
		
		$firephp->log(print_r(debug_backtrace(),true), 'error');
		
		switch($mode)
		{
			case 'list'		: $href = $this->href_list		; break ;
			case 'view'		: $href = $this->href_view		; break ;
			case 'write'	: $href = $this->href_write		; break ;
			case 'passwd'	: $href = $this->href_passwd	; break ;
			case 'modify'	: $href = $this->href_modify	; break ;
			case 'check'	: $href = $this->href_check		; break ;
			case 'cancel'	: $href = $this->href_cancel	; break ;
			case 'delete'	: $href = $this->href_delete	; break ;
		}
		if( !empty($msg) )
			$msg = 'alert("'.$msg.'");' ;
		
		if( $mode == 'back' )
			JSPrint( $msg.'history.back();' ) ;
		
		if( $isReplace )
			JSPrint( $msg.'location.replace("'.$href.'");' ) ;
		else
			JSPrint( $msg.'location.href = "'.$href.'" ;' ) ;
		
		exit ;
	}
}

?>
