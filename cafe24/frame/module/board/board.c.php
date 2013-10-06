<?php

/**
 * 테이블명, 페이지 정보 가지고있는 최상위 클래스
 *
 * @version 1
 */
class Board {
	protected $board_table = _db_board_ ;
	protected $page_size = 0 ;
	protected $list_size = 0 ;
	
	function __construct($board_table,$page_size,$list_size) {
		$this->board_table = empty($board_table) ? _db_board_ : $board_table;
		$this->page_size = (is_numeric($list_size) && $list_size > 0) ? $page_size : 5;
		$this->list_size = (is_numeric($list_size) && $list_size > 0) ? $list_size : 15 ;
	}
	
	/**
	 * 페이지 수 반환
	 * @return int 페이지 수
	 */
	function getInfoPageSize(){ return $this->page_size;}
	
	/**
	 * 리스트 수 반환
	 * @return int 리스트 수
	 */
	function getInfoListSize(){ return $this->list_size;}
	
	
	/**
	 * 페이지 수 설정
	 * @param int 페이지 수
	 */
	function setInfoPageSize($page_size){ $this->page_size = $page_size;}
	
	/**
	 * 리스트 수 설정
	 * @param int 리스트 수
	 */
	function setInfoListSize($list_size){ $this->list_size = $list_size;;}
}
