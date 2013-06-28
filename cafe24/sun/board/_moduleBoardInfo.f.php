<?php

/**
 * 게시판 설정 가져오기(클래스 변수)
 */
function getBoardInfoClassProprety( $sProprety = '' )
{
	$BoardInfo = BoardInfo::create() ;
	if( !empty($sProprety) && $BoardInfo->exists($sProprety) )
		return $BoardInfo->{$sProprety} ;
	else return $BoardInfo ;
}

/**
 * @database DB 연결
 * 게시판 설정 가져오기
 */
function getBoardInfo( $sBoardId = '' )
{
	$aReturn = array() ;
	
	$sWhere = '' ;
	if( $sBoardId != '' )
		$sWhere = ' WHERE board_id = \''.$sBoardId.'\' ' ;
	
	$q = 'SELECT * FROM '.getBoardInfoClassProprety('board_set_table').' '.$sWhere.' ORDER BY board_name ' ;
	$r = str_query($q) ;
	while($a = fetch_assoc($r) )
		$aReturn[$a['board_id']] = $a ;
		
	return $aReturn ;
}


/**
 * 검색 쿼리문 반환
 */
function getSearchQuery()
{
	$BoardInfo = getBoardInfoClassProprety() ;

	if( !empty($BoardInfo->sWhere) )
		return $BoardInfo->sWhere ;
	
	$sSearchKeyword = $BoardInfo->sSearchKeyword ;
	if( empty($sSearchKeyword) )
		return '' ;
		
	$sWhereSearch = '' ;
	//@@@ 추후 검색 테이블로 가져온다
	$sWhereSearch = '
			AND (  write_name LIKE \'%'.$sSearchKeyword.'%\'
			OR subject LIKE \'%'.$sSearchKeyword.'%\'
			OR content LIKE \'%'.$sSearchKeyword.'%\'
			)
		' ;

	$BoardInfo->sWhere = $sWhereSearch ;
	return $BoardInfo->sWhere ;
}

/**
 * 전체글 갯수 반환
 */
function db_count_query()
{
	$q = ' 
		SELECT COUNT(*) as cnt  
		FROM add_board_data 
		WHERE
		board_id = \''.getBoardInfoClassProprety('board_id').'\' AND stauts = \'1\' '.getSearchQuery() ;
		
	/* @Error - query_view@ */
	if( G::get('query_view') != '' ) {
		fb::log('db_count_query()'); 
		fb::log($q); }
	/* @Error@ end */
	return mysql_fetch_object(str_query($q))->cnt ;	
}	


/**
 * list result 반환
 */
function getListResult( $limit )
{
	$q = ' 
		SELECT * 
		FROM add_board_data 
		WHERE 
		board_id = \''.getBoardInfoClassProprety('board_id').'\' AND stauts = \'1\'
		'.getSearchQuery().'
		ORDER BY idx_group DESC, dep_step ASC
		' . $limit ;

	/* @Error - query_view@ */
	if( G::get('query_view') != '' ) {
		fb::log('getListResult()'); 
		fb::log($q); }
	/* @Error@ end */
	return str_query($q) ;
}

/**
 * view result 반환
 */
function getViewResult($board_idx)
{
	$q = ' 
		SELECT * 
		FROM add_board_data WHERE board_id = \''.getBoardInfoClassProprety('board_id').'\' AND stauts = \'1\'
		AND board_idx = '.$board_idx ;

	/* @Error - query_view@ */
	if( G::get('query_view') != '' ) {
		fb::log('getViewResult()'); 
		fb::log($q); }
	/* @Error@ end */
	return str_query($q) ;
	
}
/**
 * 조회수 업데이트
 */
function updateRCount( $board_idx )
{
	$q = ' 
		UPDATE add_board_data 
		SET rcount = rcount + 1
		WHERE
		board_id = \''.getBoardInfoClassProprety('board_id').'\' AND board_idx = '.$board_idx ;
		
	/* @Error - query_view@ */
	if( G::get('query_view') != '' ) {
		fb::log('updateRCount()'); 
		fb::log($q); }
	/* @Error@ end */
	
	$r = str_query($q) ;
	return mysql_affected_rows() ;
}	


/**
 * comment list 반환
 */
function getCommentList($board_idx, $board_id)
{	
	$q = '
		SELECT * FROM add_board_comment WHERE board_id = \''.$board_id.'\'
		AND board_idx = '.$board_idx ;

	/* @Error - query_view@ */
	if( G::get('query_view') != '' ) {
		fb::log('getCommentList()'); 
		fb::log($q); }
	/* @Error@ end */

	$r = str_query($q) ;
	$return = array() ;
	while( $a = fetch_assoc($r) )
		$return[$a['comment_idx']] = $a ;

	return $return ;
}


/**
 * 게시물 삭제처리
 */
function deleteStatus( $board_idx )
{
	$q = ' 
		UPDATE add_board_data 
		SET stauts = \'2\'
		WHERE
		board_id = \''.getBoardInfoClassProprety('board_id').'\' AND board_idx = '.$board_idx ;
		
	/* @Error - query_view@ */
	if( G::get('query_view') != '' ) {
		fb::log('deleteStatus()'); 
		fb::log($q); }
	/* @Error@ end */
	
	$r = str_query($q) ;
	return mysql_affected_rows() ;
}	