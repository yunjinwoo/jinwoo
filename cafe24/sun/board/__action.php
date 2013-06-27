<?php

$BoardInfo		= getBoardInfoClassProprety() ;

$actionMode = G::post('mode') ;
if( $actionMode == 'action_write' )
{
	$aSave = G::post_arr('_BW') ;
	
	if( !$isWriter )
		alertHref(MsgBoard::$isNoWriter, 'back' ) ;


	## 100 단위 기준으로 더한다.
	if( is_numeric($aSave['dep_step']) )
		$aSave['dep_step'] += $aSave['dep_step'] / 100 ;
	else
		$aSave['dep_step'] = 100 ;

	$aSave['idx_group'] = 0 ;

	$q = ' INSERT INTO add_board_data
		SET 
			board_idx	= null
		,	board_id	= \''.$BoardInfo->board_id.'\'
		,	user_id		= \''.UseingSession::create()->userid.'\'
		,	ip			= \''.G::server('REMOTE_ADDR').'\'
		,	idx_group	=   '.$aSave['idx_group'].'
		,	dep_step	=   '.$aSave['dep_step'].'
		,	passwd		= \''.$aSave['passwd'].'\'
		,	category	= \''.$aSave['category'].'\'
		,	email		= \''.$aSave['email'].'\'
		,	write_name	= \''.$aSave['write_name'].'\'
		,	subject		= \''.$aSave['subject'].'\'
		,	homepage	= \''.$aSave['homepage'].'\'
		,	content		= \''.$aSave['content'].'\'
		,	islock		= \''.$aSave['islock'].'\'
		,	rcount		= \'1\'
		,	recom		=   0
		,	write_date	= \''.date('Y-m-d H:i:s').'\'
	' ;

	if( !str_query($q) )
		alertHref(MsgBoard::$error_insert, 'back' ) ;

	$board_idx = mysql_insert_id() ;

	$q = ' UPDATE add_board_data
		SET 
			idx_group	= \''.$board_idx.'\'
		WHERE board_idx = '.$board_idx ;
	str_query($q) ;

	alertHref('', $BoardInfo->aHref['view'].'&board_idx='.$board_idx ) ;
}


if( $actionMode == 'action_modify' )
{
	$aSave = G::post_arr('_BW') ;
	
	if( !is_numeric($aSave['board_idx']) ||  $aSave['board_idx'] < 0 )
		alertHref(MsgBoard::$noBoardIdx,$BoardInfo->aHref['list']) ;

	if( !$isOwner )
		if( !empty($aBoardRow['user_id']) || $aBoardRow['passwd'] != $aSave['passwd'] )
			alertHref(MsgBoard::$passwdError,'back') ;
	
	$q = ' UPDATE add_board_data
		SET 
			board_id	= \''.$BoardInfo->board_id.'\'
		,	passwd		= \''.$aSave['passwd'].'\'
		,	category	= \''.$aSave['category'].'\'
		,	email		= \''.$aSave['email'].'\'
		,	subject		= \''.$aSave['subject'].'\'
		,	homepage	= \''.$aSave['homepage'].'\'
		,	content		= \''.$aSave['content'].'\'
		,	islock		= \''.$aSave['islock'].'\'
		WHERE board_idx = '.$aSave['board_idx'] ;

	if( !str_query($q) )
		alertHref(MsgBoard::$error_insert, 'back' ) ;

	$board_idx = $aSave['board_idx'] ;
	alertHref('', $BoardInfo->aHref['view'].'&board_idx='.$board_idx ) ;
}

if( $actionMode == 'action_delete' )
{
	$aSave = G::post_arr('_BW') ;

	if( !is_numeric($BoardInfo->nBoardIdx) ||  $BoardInfo->nBoardIdx < 0 )
		alertHref(MsgBoard::$noBoardIdx,$BoardInfo->aHref['list']) ;

	if( !$isWriter )
		alertHref(MsgBoard::$isNoWriter, 'back' ) ;

	if( !$isOwner )
		if( $aBoardRow['passwd'] != $aSave['passwd'] )
			alertHref(MsgBoard::$passwdError,'back') ;

	deleteStatus( $BoardInfo->nBoardIdx ) ;
	alertHref(MsgBoard::$delete,$BoardInfo->aHref['list']) ;
}



if( $actionMode == 'action_reply' )
{
	$aSave = G::post_arr('_BW') ;
	
	if( !$isWriter )
		alertHref(MsgBoard::$isNoWriter, 'back' ) ;

	if( !is_numeric($aBoardRow['dep_step']) || !is_numeric($aBoardRow['idx_group']) )
		alertHref(MsgBoard::$noBoardIdx,$BoardInfo->aHref['list']) ;
	
	## 답변에 답변인 경우를 추가해야함
	## 100 단위 기준으로 더한다.
	$aSave['dep_step']  = $aBoardRow['dep_step'] + 100 ;
	$aSave['idx_group'] = $aBoardRow['idx_group'] ;

	$q = ' INSERT INTO add_board_data
		SET 
			board_idx	= null
		,	board_id	= \''.$BoardInfo->board_id.'\'
		,	user_id		= \''.UseingSession::create()->userid.'\'
		,	idx_group	=   '.$aSave['idx_group'].'
		,	dep_step	=   '.$aSave['dep_step'].'
		,	passwd		= \''.$aSave['passwd'].'\'
		,	category	= \''.$aSave['category'].'\'
		,	email		= \''.$aSave['email'].'\'
		,	write_name	= \''.$aSave['write_name'].'\'
		,	subject		= \''.$aSave['subject'].'\'
		,	homepage	= \''.$aSave['homepage'].'\'
		,	content		= \''.$aSave['content'].'\'
		,	islock		= \''.$aSave['islock'].'\'
		,	rcount		= \'1\'
		,	recom		=   0
		,	write_date	= \''.date('Y-m-d H:i:s').'\'
	' ;

	if( !str_query($q) )
		alertHref(MsgBoard::$error_insert, 'back' ) ;

	$board_idx = mysql_insert_id() ;
	alertHref('', $BoardInfo->aHref['view'].'&board_idx='.$board_idx ) ;
}
