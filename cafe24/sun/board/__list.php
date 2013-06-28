<?php

$BoardInfo		= getBoardInfoClassProprety() ;
$sWhereSearch	= getSearchQuery() ;

### page vars
$nPage			= $BoardInfo->nPage ;
$item_count		= db_count_query()	;
$list_count		= $BoardInfo->list_count ;
$page_size		= $BoardInfo->page_size ;

/* @Error - list@ */
if( G::get('list') != '' ) {
printArray($BoardInfo );
echo '$item_count' ;
printArray($item_count) ;
echo '$list_count' ;
printArray($list_count) ; }
/* @Error@ end */


$total_page_count	= ceil($item_count/$list_count) ;
if( $nPage > $total_page_count )
	$nPage = $BoardInfo->nPage = 1 ;
	
	
$start_num			= ( $nPage - 1 ) * $list_count ;

$nStartNum = $item_count - $start_num ;



$listResult = getListResult( ' LIMIT '.$start_num.', '.$list_count ) ;
$aList = array() ;
$countIsHot = $BoardInfo->img_hot_cnt ;
$countIsNew = $BoardInfo->img_new_hour*3600 ;
while( $a = fetch_assoc($listResult) )
{
	if( substr($a['write_date'],0,10) == date('Y-m-d') )
		$date = substr($a['write_date'],11,5) ;
	else $date = substr($a['write_date'],0,10) ;
	
	$hot = $new = '' ;
	if( $a['rcount'] >= $countIsHot )
		$hot = '<!-- 핫이미지-->' ;
	
	if( time() - strtotime($a['write_date']) < $countIsNew )
		$new = ' <img src="/common/images/comm/ico/ico_new.gif">' ;
	
	$aRow = array() ;
	$aRow['no']			= $nStartNum-- ;
	$aRow['href']		= $aHref['view'].'&board_idx='.$a['board_idx'] ;
	$aRow['subject']	= $a['subject'] ;
	$aRow['hot']		= $hot ;
	$aRow['new']		= $new ;
	$aRow['com_cnt']	= '';//'('.$a['recom'].')' ;
	$aRow['writer']		= $a['write_name'] ;
	$aRow['date']		= $date ;
	
	if( $a['dep_step'] != "100" )
	{
		$aRow['no'] = "&nbsp;" ;
		$aRow['subject'] = ' <img src="/common/images/comm/ico/pop_ico.jpg"> '.$aRow['subject'] ;
	}
		

	if( !empty($sSearchKeyword) )
		$aRow['subject'] = str_replace( $sSearchKeyword, '<span class="search">'.$sSearchKeyword.'</span>', $aRow['subject'] ) ;
	
	$aList[$a['board_idx']] = $aRow ;
}


$PageMaker = new PageMaker($nPage, $page_size, $total_page_count );
$page_tag = $PageMaker->getPageTag(
					preg_replace( '/\&page\=([\d]{0,})/i' 
								, '&page=%d'
								, $aHref['list'] )
				, '<a href="%s">%s</a>'
				, '<strong>%s</strong>') ;

$first_page		= $PageMaker->first_page ;
$last_page		= $PageMaker->last_page ;
$back_page		= $PageMaker->back_page ;
$next_page		= $PageMaker->next_page ;

if( $isWriter )
	$btn_write	= $BoardInfo->aBtnTag['write'] ;

require $BoardInfo->skin_path.'/'.$BoardInfo->board_skin.'/list.html' ;