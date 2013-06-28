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
	
$aRow = array() ;
$aRow['board_idx']	= $a['board_idx'] ;
$aRow['subject']	= $a['subject'] ;
$aRow['write_name']	= $a['write_name'] ;
$aRow['userid']		= $a['userid'] ;
$aRow['content']	= stripslashes($a['content']) ;			
$aRow['date']		= $a['write_date'] ;


$btn_list	= $BoardInfo->aBtnTag['list'] ;
$btn_check	= $BoardInfo->aBtnTag['action_modify'] ;
$btn_cancel	= sprintf($BoardInfo->aBtnTag['view'],$BoardInfo->aHref['view'].'&board_idx='.$aRow['board_idx'] );


require $BoardInfo->skin_path.'/'.$BoardInfo->board_skin.'/modify.html' ;
