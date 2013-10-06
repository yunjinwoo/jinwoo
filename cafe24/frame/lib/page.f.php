<?php

/**
 * 페이지 순차적으로 들어간다.
 * @param string 페이지 출력할 html 파일 경로
 * @param array page, page_size, total_page_count 포함
 * @return 없음 include 한다
 */
function page_include( $includePage , $data )
{
	$self_page = A::number($data, 'page', 1) ;
	$page_size = A::number($data, 'page_size', 5) ;
	$total_page_count = A::number($data, 'total_page_count', 1) ;
	
	if( $self_page <= ($t = floor($page_size/2) ) + 1 ) {
		$start_page = 1 ;
	}else{
		$start_page	= $self_page - $t ;
		if( $total_page_count <= ($start_page + $t*2) )
			$start_page = F::number ($total_page_count - ($t*2),1) ;
	}
	$last_page = $start_page + $page_size - 1;
	if( $last_page >= $total_page_count) $last_page = $total_page_count ;
	
	$prev_page = $self_page - $page_size ;
	if( $prev_page <= 1) $prev_page = 1 ;

	$next_page = $self_page + $page_size ;
	if( $next_page >= $total_page_count) $next_page = $total_page_count ;

	$aUrl = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
	parse_str($aUrl, $arr);
	if(isset($arr['page']))	unset($arr['page']);
	
	$link_default = $_SERVER['PHP_SELF'].'?'.  http_build_query($arr,'','&amp;') ;
	$link_first = $link_default.'&amp;page=1' ;
	$link_prev = $link_default.'&amp;page='.$prev_page ;
	$link_next = $link_default.'&amp;page='.$next_page ;
	$link_last = $link_default.'&amp;page='.$total_page_count ;
		
	include $includePage ;
}

/**
 * 평범한 페이지
 * @param string 페이지 출력할 html 파일 경로
 * @param array page, page_size, total_page_count 포함
 * @return 없음 include 한다
 */
function page_include_old( $includePage , $data )
{
	$self_page = A::number($data, 'page', 1) ;
	$page_size = A::number($data, 'page_size', 5) ;
	$total_page_count = A::number($data, 'total_page_count', 1) ;
	
	$start_page = 1 ;
	if( $self_page > $page_size ) $start_page = (ceil($self_page / $page_size) - 1) * $page_size +1;
	
	$last_page = $start_page + $page_size - 1;
	if( $last_page >= $total_page_count) $last_page = $total_page_count ;
	
	$prev_page = $self_page - $page_size ;
	if( $prev_page <= 1) $prev_page = 1 ;

	$next_page = $start_page + $page_size ;
	if( $next_page >= $total_page_count) $next_page = $total_page_count ;

	$aUrl = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
	parse_str($aUrl, $arr);
	if(isset($arr['page']))	unset($arr['page']);
	
	$link_default = $_SERVER['PHP_SELF'].'?'.  http_build_query($arr,'','&amp;') ;
	$link_first = $link_default.'&amp;page=1' ;
	$link_prev = $link_default.'&amp;page='.$prev_page ;
	$link_next = $link_default.'&amp;page='.$next_page ;
	$link_last = $link_default.'&amp;page='.$total_page_count ;
		
	include $includePage ;
}

