<?php

$BoardInfo		= getBoardInfoClassProprety() ;

/* @Error - view@ */
if( G::get('view') != '' ) {
printArray($BoardInfo );}
/* @Error@ end */

/*
//위 내용 적용시키면서...
$btn_write = $img_write = $href_write = '' ;
$btn_write	= $this->BoardSetRow->BtnSetter->getBtn('write') ;
$img_write	= $this->BoardSetRow->BtnSetter->img_write ;
$href_write = $this->BoardSetRow->BtnSetter->href_write ;
$btn_list = $img_list = $href_list = '' ;
$btn_list	= $this->BoardSetRow->BtnSetter->getBtn('list') ;
$img_list	= $this->BoardSetRow->BtnSetter->img_list ;
$href_list	= $this->BoardSetRow->BtnSetter->href_list ;

*/		

if( !is_numeric($BoardInfo->nBoardIdx) ||  $BoardInfo->nBoardIdx < 0 )
	alertHref(MsgBoard::$noBoardIdx,$BoardInfo->aHref['list']) ;

if( !is_resource( $viewResult ) )
	$viewResult = getViewResult( $BoardInfo->nBoardIdx ) ;

$a = $aBoardRow ;
if( count($a) < 1 && ($a = fetch_assoc($viewResult)) )
	alertHref(MsgBoard::$noContents,$BoardInfo->aHref['list']) ;
	

if( substr($a['write_date'],0,10) == date('Y-m-d') )
	$date = substr($a['write_date'],11,5) ;
else $date = substr($a['write_date'],0,10) ;

$aRow = array() ;
$aRow['board_idx']	= $a['board_idx'] ;
$aRow['subject']	= $a['subject'] ;
$aRow['write_name']	= $a['write_name'] ;
$aRow['userid']		= $a['userid'] ;
$aRow['content']	= stripslashes($a['content']) ;			
$aRow['date']		= $date ;

updateRCount( $aRow['board_idx'] );
/* 일단 코멘트는 없다.
$aCommentList = getCommentList( $BoardInfo->nBoardIdx ,$BoardInfo->board_id ) ;
foreach( $aCommentList as $k => $v )
{
}
*/


$btn_list	= $BoardInfo->aBtnTag['list'] ;

$btn_modify	= sprintf($BoardInfo->aBtnTag['modify'],$BoardInfo->aHref['modify'].'&board_idx='.$aRow['board_idx'] );
$btn_delete	= sprintf($BoardInfo->aBtnTag['delete'],$BoardInfo->aHref['delete'].'&board_idx='.$aRow['board_idx'] );

if( $isAdmin )
	$btn_reply	= sprintf($BoardInfo->aBtnTag['reply'],$BoardInfo->aHref['reply'].'&board_idx='.$aRow['board_idx'] );

require $BoardInfo->skin_path.'/'.$BoardInfo->board_skin.'/view.html' ;
