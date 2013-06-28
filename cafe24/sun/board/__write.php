<?php
$BoardInfo		= getBoardInfoClassProprety() ;

require_once _ADD_.'/daumeditor/editor.php';


$date = date('Y-m-d') ;
$write_name = UseingSession::create()->name ;

$btn_list	= $BoardInfo->aBtnTag['list'] ;
$btn_check	= $BoardInfo->aBtnTag['action_write'] ;
$btn_cancel	= $BoardInfo->aBtnTag['cancel'] ;

require $BoardInfo->skin_path.'/'.$BoardInfo->board_skin.'/write.html' ;
