<?php

$BoardInfo		= getBoardInfoClassProprety() ;


if( !is_numeric($BoardInfo->nBoardIdx) ||  $BoardInfo->nBoardIdx < 0 )
	alertHref(MsgBoard::$noBoardIdx,$BoardInfo->aHref['list']) ;


$viewResult = getViewResult( $BoardInfo->nBoardIdx ) ;
if( !($a = fetch_assoc($viewResult)) )
	alertHref(MsgBoard::$noContents,$BoardInfo->aHref['list']) ;
	


if( $isOwner )
{
	deleteStatus( $BoardInfo->nBoardIdx ) ;
	alertHref(MsgBoard::$delete,$BoardInfo->aHref['list']) ;
}

$btn_list	= $BoardInfo->aBtnTag['list'] ;
$btn_delete	= $BoardInfo->aBtnTag['action_delete'] ;

require $BoardInfo->skin_path.'/'.$BoardInfo->board_skin.'/passwd.html' ;
