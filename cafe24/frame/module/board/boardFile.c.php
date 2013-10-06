<?php

/**
 * 게시판 파일관리 
 * 
 * @version 1
 */
class boardFile {
	private $table ;
	private $idx ;
	
	/**
	 * 파일관리에 필요한 데이타 설정
	 * 
	 * @param string $board_table 테이블명
	 * @param int $board_idx 기본키
	 * @return this
	 */
	function __construct($board_table, $board_idx) {
		if( empty($board_table) ) debug('$board_table'. _MSG_ERROR_ ) ;
		
		$this->setIdx($board_idx) ;
		$this->table	= $board_table ;
	}
	
	/**
	 * 기본키 설정 - 추가시 사용된다.
	 * 
	 * @param int $board_idx 기본키
	 * @return void
	 */
	function setIdx( $idx )
	{
		if(!(is_numeric($idx) && $idx >= 1) ) debug('$board_idx '. _MSG_ERROR_ ) ;
		$this->idx		= $idx ;
		
	}
	
	/**
	 * 설정된 정보에 해당하는 정보 가져오기
	 * 
	 * @return array array( file_idx => row )
	 */
	function getList()
	{
		$stmt = db()->prepare($this->_list()) ;
		$stmt->bindValue(':board_table', $this->table) ;
		$stmt->bindValue(':board_idx', $this->idx, PDO::PARAM_INT) ;
		
		stmtExecute($stmt);
		$ret = array() ;
		while( $r = $stmt->fetch(PDO::FETCH_ASSOC)){
			$ret[$r['file_idx']] = $r ;
		}
		
		return $ret ;
	}
	
	/**
	 * 업로드된 파일 정보 삭제
	 * @static
	 * @param int $file_idx 파일 테이블 기본키
	 * @return bool
	 */
	static function delete($file_idx)
	{
		if( !is_numeric($file_idx) && $file_idx < 0 ) debug('$file_idx '. _MSG_ERROR_ ) ;
		$File = new BoardFile('tmp',1) ;
		
		$stmt = db()->prepare($File->getQuery('row')) ;
		$stmt->bindValue(':file_idx', $file_idx, PDO::PARAM_INT) ;
		
		stmtExecute($stmt);
		$row = $stmt->fetch(PDO::FETCH_ASSOC) ;
		@unlink( $_SERVER['DOCUMENT_ROOT'].$row['file_path'] ) ;
		
		$stmt = db()->prepare($File->getQuery('delete')) ;
		$stmt->bindValue(':file_idx', $file_idx, PDO::PARAM_INT) ;
		
		stmtExecute($stmt);
		
		return true ;
	}
	
	/**
	 * 업로드된 파일 다운로드
	 * exit
	 * @static
	 * @param int $file_idx 파일 테이블 기본키
	 * @return exit
	 */
	static function download($file_idx)
	{
		if( !is_numeric($file_idx) && $file_idx < 0 ) debug('$file_idx '. _MSG_ERROR_ ) ;
		$File = new BoardFile('tmp',1) ;
		
		$stmt = db()->prepare($File->getQuery('row')) ;
		$stmt->bindValue(':file_idx', $file_idx, PDO::PARAM_INT) ;
		
		stmtExecute($stmt);
		$row = $stmt->fetch(PDO::FETCH_ASSOC) ;
		
		//echo $row['file_type'] ;
		header('Content-type: '.$row['file_type']);
		header('Content-Disposition: attachment; filename="'.$row['file_upload_name'].'"');
		readfile($_SERVER['DOCUMENT_ROOT'].$row['file_path']);
		//readfile($_SERVER['DOCUMENT_ROOT'].$row['file_path']);
		exit ;
	}
	
	/**
	 * 파일정보 저장 [연도월] 폴더 생성
	 * $_FILES['board']
	 * $_POST[board_sub_name]
	 * $_POST[board_alt]
	 * 
	 * 
	 * @return void
	 */
	function insert()
	{
		$webpath = _WEB_PATH_DATA_.'/board/'.date('Ym') ;
		$path = _PATH_data_.'/board/'.date('Ym') ;
		if(!is_dir($path)) mkdir( $path ) ;
		
		$cnt = 0 ;
		$stmt = db()->prepare($this->_insert());
		$aSubName = G::postArr('board_sub_name');
		$aAtl = G::postArr('board_alt');
		foreach($_FILES['board']['tmp_name'] as $k => $tmp_name)
		{
			$name = $_FILES['board']['name'][$k] ;
			$size = $_FILES['board']['size'][$k] ;
			$type = $_FILES['board']['type'][$k] ;
			$alt  = A::str($aAtl,$k) ;
			$subName  = A::str($aSubName,$k) ;
			if(is_uploaded_file($tmp_name))
			{
				$ext = array_pop(explode('.',$name)) ;
				$filename =  microtime(true).rand(1,1000).'.'.$ext ;

				move_uploaded_file($tmp_name, $path.'/'.$filename);

				$stmt->bindValue(':board_name'		, $this->table) ;
				$stmt->bindValue(':board_idx'		, $this->idx , PDO::PARAM_INT) ;
				$stmt->bindValue(':board_sub_name'	, $subName) ;
				$stmt->bindValue(':file_path'		, $webpath.'/'.$filename) ;
				$stmt->bindValue(':file_alt'		, $alt) ;
				$stmt->bindValue(':file_upload_name', $name) ;
				$stmt->bindValue(':file_size'		, $size , PDO::PARAM_INT) ;
				$stmt->bindValue(':file_type'		, $type) ;
				$stmt->bindValue(':reg_date'		, F::datetime('')) ;

				stmtExecute($stmt) ;
			}
		}
	}
	
	/**
	 * 타입에 맞는 쿼리 반환
	 * 
	 * @param string $type 사용할 쿼리 종류
	 * @return string 해당 쿼리
	 */
	function getQuery($type)
	{
		$q = '' ;
		switch($type){
			case 'row' : $q = $this->_row() ; break ;
			case 'delete' : $q = $this->_delete() ; break ;
		}
		return $q ;
	}
	
	/**
	 * row 반환 [썸네일만들때 사용된다]
	 * 
	 * @return string 해당 row
	 */
	function find()
	{
		$q = '
			SELECT * FROM '._db_board_file_.'
			WHERE board_name = :board_name AND board_idx = :board_idx
		' ;
		
		$stmt = db()->prepare($q);
		$stmt->bindValue(':board_name', $this->table);
		$stmt->bindValue(':board_idx',	$this->idx, PDO::PARAM_INT);
		
		stmtExecute($stmt);
		
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}
	
	private function _list()
	{
		return '
			SELECT * FROM '._db_board_file_.'
			WHERE board_name = :board_table
			AND   board_idx = :board_idx
		' ;
	}
	
	private function _insert()
	{
		return '
			INSERT INTO '._db_board_file_.'
			SET			
			   board_name = :board_name
			,  board_idx = :board_idx
			,  board_sub_name = :board_sub_name
			,  file_path = :file_path
			,  file_alt = :file_alt
			,  file_upload_name = :file_upload_name
			,  file_size = :file_size
			,  file_type = :file_type
			,  reg_date = :reg_date
		' ;
	}
	
	
	private function _row()
	{
		return '
			SELECT * FROM '._db_board_file_.'
			WHERE file_idx = :file_idx
		' ;
	}
	
	private function _delete()
	{
		return '
			DELETE FROM '._db_board_file_.'
			WHERE file_idx = :file_idx
		' ;
	}
}
