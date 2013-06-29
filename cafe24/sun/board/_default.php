<?php
if( !defined('_DB_NAME_') ){ require_once '../lib/define.php'; }
$path = dirname(__FILE__) ;

require_once $path.'/_moduleBoardInfo.f.php';
require_once $path.'/_boardInfo.c.php';
require_once $path.'/_MsgBoard.c.php';
require_once $path.'/_LevelChecker.c.php';
require_once _ADD_.'/FirePHPCore/fb.php';

class SingletonParent {
    private static $instance;
    public static function singleton($class = __CLASS__) {
			if (!isset(self::$instance))
				self::$instance = array();
			if (!isset(self::$instance[$class]))
				self::$instance[$class] = new $class;
			return self::$instance[$class];
    }
}


################################################
################################################
################################################
################################################

################################################
################################################
################################################
################################################
class PageMaker
{
	public $first_page		= 1 ;
	public $last_page		= 1 ;
	public $back_page		= 1 ;
	public $next_page		= 1 ;
	
	public $self_page		= '' ;
	public $page_num		= '' ;
	public $page_total		= '' ;
		
	function __construct( $self_page, $page_num, $page_total ) 
	{
		$this->PageMaker( $self_page, $page_num, $page_total ) ;
	}
	
	function PageMaker( $self_page, $page_num, $page_total )
	{
		$this->self_page	= $self_page ;
		$this->page_num		= $page_num ;
		$this->page_total	= $page_total ;
	}
	
	// $link_str = $this->BoardSetRow->BtnSetter->getPageHref($i)
	function getPageTag( $link_str, $page_tag = '' , $self_page_tag = '' )
	{		
		$pos = strpos($page_tag , '%s') ;
		if( $pos === false )
			$page_tag = '<a href="%s">%s</a>' ;
		
		$pos = strpos($self_page_tag , '%s') ;
		if( $pos === false )
			$self_page_tag = '<strong>%s</strong>' ;
		
		if( $this->self_page <= ($t = floor($this->page_num/2) ) + 1 ) 
			$startPage = 1 ;
		else
		{
			$startPage	= $this->self_page - $t ;
			if( $this->page_total <= ($startPage + $t*2) )
				$startPage = $this->page_total - ($t*2) ;
		}
		
		$aPage = array() ;
		for( $i = $startPage ; $i < $startPage+$this->page_num && $i <= $this->page_total ; $i++ )
			$aPage[$i] = sprintf($page_tag , sprintf( $link_str , $i) , $i ) ;
		
		$aPage[$this->self_page] = sprintf( $self_page_tag , $this->self_page) ;
		
		$back_page_num = $this->self_page-$this->page_num ;
		if( $back_page_num <= 1) $back_page_num = 1 ;
		
		$next_page_num = $this->self_page+$this->page_num ;
		if( $next_page_num >= $this->page_total) $next_page_num = $this->page_total ;
	
		$this->first_page		= sprintf( $link_str , 1) ;
		$this->last_page		= sprintf( $link_str , $this->page_total) ;
		$this->back_page		= sprintf( $link_str , $back_page_num) ;
		$this->next_page		= sprintf( $link_str , $next_page_num) ;
		
		return implode("\n",$aPage) ;
	}

}

########################################
########################################
########################################
function getBtn($aHref)
{
	$aBtn = array() ;
	$aBtn['list']	= '<a href="'.$aHref['list'].'"><img alt="글목록" src="/common/images/comm/btn/btn_a_list.gif"></a>' ;
	$aBtn['write']	= '<a href="'.$aHref['write'].'"><img alt="글쓰기" src="/common/images/comm/btn/btn_a_write.gif" /></a>' ;
	$aBtn['cancel']	= '<a href="'.$aHref['cancel'].'"><img alt="취소" src="/common/images/comm/btn/btn_a_cancel.gif" /></a>' ;
	$aBtn['reply']	= '<a href="'.$aHref['reply'].'"><img alt="글쓰기" src="/common/images/comm/btn/btn_a_reply.gif" /></a>' ;

	$aBtn['modify']	= '<a href="%s"><img alt="수정" src="/common/images/comm/btn/btn_a_modify.gif" /></a>' ;
	$aBtn['view']	= '<a href="%s"><img alt="취소" src="/common/images/comm/btn/btn_a_cancel.gif" /></a>' ;
	$aBtn['delete']	= '<a href="%s"><img alt="삭제" src="/common/images/comm/btn/btn_a_del.gif" /></a>' ;
	$aBtn['reply']	= '<a href="%s"><img alt="답글" src="/common/images/comm/btn/btn_a_reply.gif" /></a>' ;
	
	$aBtn['action_write']	= '<a href="'.$aHref['action_write'].'"><img alt="확인" src="/common/images/comm/btn/btn_a_check.gif" /></a>' ;
	$aBtn['action_modify']	= '<a href="'.$aHref['action_modify'].'"><img alt="확인" src="/common/images/comm/btn/btn_a_check.gif" /></a>' ;
	$aBtn['action_delete']	= '<a href="'.$aHref['action_delete'].'"><img alt="삭제" src="/common/images/comm/btn/btn_a_del.gif" /></a>' ;

	return $aBtn ;
}

function getHref( $url )
{
	$aHref = array() ;
	$aHref['no_owner']	= 'javascript:alert( \'권한이 없습니다.\' );' ;

	$aHref['list']		= $url.'&mode=list' ;
	$aHref['write']		= $url.'&mode=write' ;
	$aHref['reply']		= $url.'&mode=reply' ;
	$aHref['view']		= $url.'&mode=view' ;
	$aHref['modify']	= $url.'&mode=modify' ;
	$aHref['delete']	= $url.'&mode=delete' ;
	$aHref['passwd']	= $url.'&mode=passwd' ;
	$aHref['cancel']	= $url.'&mode=list' ;

	$aHref['action_write']	= 'javascript:writeSubmit();';//$url.'&mode=action_write' ;
	$aHref['action_modify']	= 'javascript:writeSubmit();';//$url.'&mode=action_modify' ;
	$aHref['action_delete']	= 'javascript:writeSubmit();';//$url.'&mode=action_delete' ;

	$aHref['action_comment_write']	= $url.'&mode=action_comment_write' ;
	$aHref['action_comment_modify']	= $url.'&mode=action_comment_modify' ;
	$aHref['action_comment_delete']	= $url.'&mode=action_comment_delete' ;

	return $aHref ;
}


################################
### 이하는 최종 지워야 될 것들...


require_once 'Field.c.php';