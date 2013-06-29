<?php
require_once dirname( __FILE__ ).'/_default.php' ;


/**
 * 
$board_id = 'board_test' ;
$board_module_skin = 'basic' ;
$board_list_deco_style = array(
		'new' => ''
	,	'hot' => ''
	,	'comment' => ''
	,	'notice' => ''
) ;
 * 게시판 실행!!!
 */
function board_start( $board_id , $mode = '' )
{
	if( empty($mode) )
		$mode = G::request('mode');

	$include_page = '' ;
	switch($mode)
	{
		case 'write'	: 		$include_page = '__write.php' ; break ;	
		case 'reply'	:		$include_page = '__reply.php' ; break ;	
		case 'modify'	:		$include_page = '__modify.php' ; break ;	
		case 'delete'	:		$include_page = '__delete.php' ; break ;	
		case 'view'	:			$include_page = '__view.php' ; break ;	
		case 'action_write'		:	$include_page = '__action.php' ; break ;	
		case 'action_modify'	:	$include_page = '__action.php' ; break ;
		case 'action_delete'	:	$include_page = '__action.php' ; break ;
		case 'action_reply'		:	$include_page = '__action.php' ; break ;	
		//case 'commentAction' :	$include_page = '__action.php' ; break ;	
		default			:
		case 'list'		:		$include_page = '__list.php' ; break ;	
	}

	$BoardInfo		= getBoardInfoClassProprety() ;
	$LevelChecker	= LevelChecker::create() ;
 
	## request
	$sSearchKeyword = addslashes(G::request('search_keyword')) ;
	$nPage			= is_numeric(G::request('page'))?G::request('page'):1 ;	
	$nBoardIdx		= addslashes(G::request('board_idx')) ;	

	$BoardInfo->sSearchKeyword		= $sSearchKeyword ;
	$BoardInfo->nPage				= $nPage ;
	$BoardInfo->nBoardIdx			= $nBoardIdx ;
	
	## var 
	$aBoardInfo = getBoardInfo( $board_id ) ;
	$aHref		= getHref( '?board_id='.$board_id.'&search_keyword='.$sSearchKeyword.'&page='.$nPage ) ;
/* @Error - query_view@ */
if( G::get('query_view') != '' ) {
	$aHref		= getHref( '?board_id='.$board_id.'&search_keyword='.$sSearchKeyword.'&page='.$nPage.'&query_view=view' ) ; }
/* @Error@ end */
	$aBtnTag	= getBtn($aHref) ;

/* @Error - info@ */
if( G::get('info') != '' ) {
	fb::log( '$mode:'.$mode ) ;
	fb::log( dirname( __FILE__ ).'/'.$include_page ) ;
	fb::log(print_r($aBoardInfo,true)); }
/* @Error@ end */

	$BoardInfo->setBoardInfo( $aBoardInfo[$board_id] ) ;
	$BoardInfo->aHref		= $aHref ;
	$BoardInfo->aBtnTag		= $aBtnTag ;

	
	/* 보드 번호가 있으면 검색해두자 있으면 편할듯해서.. */
	if( is_numeric($BoardInfo->nBoardIdx) &&  $BoardInfo->nBoardIdx > 0 )
		$viewResult = getViewResult( $BoardInfo->nBoardIdx ) ;
	
	$aBoardRow = array() ;
	if( is_resource( $viewResult ) )
		$aBoardRow = fetch_assoc($viewResult) ;

	
	$isOwner	= false ;
	$isAdmin	= $LevelChecker->isAdmin() ;
	$isMember	= $LevelChecker->isMember() ;
	$isWriter	= $LevelChecker->isWriteLevel() ;
	$isViewer	= $LevelChecker->isViewLevel() ;
	
	if( $LevelChecker->isWriter( $aBoardRow['userid'] )
	||  $isAdmin )
		$isOwner = true ;
	
	if( $isAdmin && !$isMember )
		$isMember = true ;

/* @Error - info@ */
if( G::get('info') != '' ) {
	fb::log( ($isWriter) ? "[isWriter 임]" : "[isWriter 아님]" );
	fb::log( ($isViewer) ? "[isViewer 임]" : "[isViewer 아님]" );
	fb::log( ($isAdmin) ? "[관리자 임]" : "[관리자 아님]" );
	fb::log( ($isOwner) ? "[오너 임]" : "[오너 아님]" );
	fb::log( ($isMember) ? "[회원 임]" : "[회원 아님]" ); }
/* @Error@ end */
	

	require dirname( __FILE__ ).'/'.$include_page ;
}
