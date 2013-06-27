<?php
$BoardInfo		= getBoardInfoClassProprety() ;

require_once _ADD_.'/daumeditor/editor.php';

if( !is_numeric($BoardInfo->nBoardIdx) ||  $BoardInfo->nBoardIdx < 0 )
	alertHref(MsgBoard::$noBoardIdx,$BoardInfo->aHref['list']) ;

if( !is_resource( $viewResult ) )
	$viewResult = getViewResult( $BoardInfo->nBoardIdx ) ;

$a = $aBoardRow ;
if( count($a) < 1 && ($a = fetch_assoc($viewResult)) )
	alertHref(MsgBoard::$noContents,$BoardInfo->aHref['list']) ;

$content	= $aBoardRow["content"] ;
$write_name = UseingSession::create()->name ;

$date = date('Y-m-d') ;


$btn_list	= $BoardInfo->aBtnTag['list'] ;
$btn_check	= $BoardInfo->aBtnTag['action_write'] ;
$btn_cancel	= $BoardInfo->aBtnTag['cancel'] ;

require $BoardInfo->skin_path.'/'.$BoardInfo->board_skin.'/reply.html' ;
