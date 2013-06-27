<?php
/**
 * 1. FieldBoard	- 생성된 게시판 필드 정보
 * 2. FieldBoardSet - 게시판 설정 테이블 필드 정보
 */

/**
 * 생성된 게시판 필드 정보
 */
class FieldBoard
{
	/** 게시물 고유번호 */
	public $f_board_idx		= 'board_idx' ;
	/** 게시물 작성자 아이디 */
	public $f_user_id		= 'user_id' ;
	/** 게시물 답변 그룹 */
	public $f_idx_group		= 'idx_group' ;
	/** 게시물 그룹 출력 순서 */
	public $f_dep_step		= 'dep_step' ;
	/** 게시물 비밀번호 */
	public $f_passwd		= 'passwd' ;
	/** 게시물 분류 */
	public $f_category		= 'category' ;
	/** 작성자 이메일 */
	public $f_email			= 'email' ;
	/** 작성자 명 */
	public $f_write_name	= 'write_name' ;
	/** 게시물 제목 */
	public $f_subject		= 'subject' ;
	/** 작성자 url */
	public $f_homepage		= 'homepage' ;
	/** 게시물 내용 */
	public $f_content		= 'content' ;
	/** 비밀글 여부 */
	public $f_islock		= 'islock' ;
	/** 게시물 조회수 */
	public $f_rcount		= 'rcount' ;
	/** 게시물 댓글수 */
	public $f_recom			= 'recom' ;
	/** 게시물 작성일 */
	public $f_write_date	= 'write_date' ;
}

/**
 * 게시판 설정 테이블 필드 정보
 */
class FieldBoardSet
{
	const table = 'add_board_set' ;
	
	/** 게시판 아이디 */
	public $f_board_id		= 'board_id' ;
	/** 게시판 명 */
	public $f_board_name	= 'board_name' ;
	/** 페이지 출력 수 - 안쓸듯 */
	public $f_page_size		= 'page_size' ;
	/** 게시판 스킨 */
	public $f_board_skin	= 'board_skin' ;
	/** 게시판 기능 구분 */
	public $f_board_type	= 'board_type' ;
	/** 파일 업로드 */
	public $f_is_use_file	= 'is_use_file' ;
	/** 비밀글 */
	public $f_is_use_secret = 'is_use_secret' ;
	/** 구분 */
	public $f_category		= 'category' ;
	/** 관리자 레벨 - 안쓸듯 */
	public $f_level_admin	= 'level_admin' ;
	/** 작성 레벨 */
	public $f_level_write	= 'level_write' ;
	/** 보기 레벨 */
	public $f_level_view	= 'level_view' ;
	/** 댓글 레벨 */
	public $f_level_comment = 'level_comment' ;
	/** new 이미지 노출 시간 */
	public $f_img_new_hour	= 'img_new_hour' ;
	/** hot 이미지 출력 조회건 */
	public $f_img_hot_cnt	= 'img_hot_cnt' ;
	/** 리스트 출력 수 */
	public $f_list_count	= 'list_count' ;
}

?>
