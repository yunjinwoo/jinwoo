<?php

class BoardRow extends Board {
	protected $boardIdx = -1 ;
	function __construct($boardIdx = -1, $board_table='',$page_size='',$list_size='') {
		if( is_numeric($this->boardIdx) && $boardIdx < 0 )
			$boardIdx = -1 ;
		$this->boardIdx = $boardIdx ;
		parent::__construct($board_table, $page_size, $list_size) ;
	}
	
	function setBoardIdx($board_idx)
	{
		if( is_numeric($board_idx) ) $this->boardIdx = $board_idx; 
	}
	
	private function _rowAction($q)
	{
		if( is_numeric($this->boardIdx) && $this->boardIdx < 0 ) return ;
		
		$stmt = db()->prepare($q) ;
		$stmt->bindValue(':board_idx', $this->boardIdx,PDO::PARAM_INT);
		stmtExecute($stmt);
		$row = $stmt->fetch(PDO::FETCH_ASSOC) ;
		if( !$row ) return array() ;
		
		return $this->replace($row) ;
	}
	
	function row()
	{
		return $this->_rowAction($this->_row()) ;
	}
	
	
	function rowUp()
	{
		return $this->_rowAction($this->_rowUp()) ;
	}
	
	
	function rowDown()
	{
		return $this->_rowAction($this->_rowDown()) ;
	}
	
	function replace( $row ) 
	{
		return $row;
	}
	
	function rowFileList()
	{
		if( !is_numeric($this->boardIdx) || $this->boardIdx < 0 ) return array();
		
		$BoardFile = new boardFile($this->board_table, $this->boardIdx) ;
		return $BoardFile->getList() ;
	}
	
	function save($row)
	{
		if( is_numeric($this->boardIdx) && $this->boardIdx > 0 ){
			$this->update ($row) ;
		}else{
			$this->insert ($row) ;
		}
		
		$this->fileUpload();
	}

	function fileUpload($row)
	{
		$BoardFile = new boardFile($this->board_table, $this->boardIdx);
		if( isset($row['del_file_idx']) && is_array($row['del_file_idx']) )
			foreach( $row['del_file_idx'] as $k => $v )
				$v = $BoardFile->delete ($k) ;
		
		$BoardFile->insert() ;
	}
	
	function delete()
	{
		$row = $this->row() ;
		$editor_session_key = A::str($row,'editor_session_key');
		if( !empty($editor_session_key) )
		{
			$EditorFile = new EditorFile($editor_session_key) ;
			$EditorFile->delete_session_key() ;
		}
		
		$stmt = db()->prepare($this->_delete()) ;
		$stmt->bindValue( ':board_idx', $this->boardIdx, PDO::PARAM_INT) ;
		
		$BoardFile = new boardFile($this->board_table,$this->boardIdx) ;
		$list = $BoardFile->getList() ;
		foreach( $list as $k => $v )
			boardFile::delete ($k) ;
		
		stmtExecute($stmt);
	}
	
	function insert($row)
	{
		$row['board_title']		= $this->valid($row['board_title'],'board_title') ;
		$row['board_text']		= $this->valid($row['board_text'],'board_text') ;
		$row['board_date']		= $this->valid($row['board_date'],'board_date') ;
		$row['reg_date']		= $this->valid('','reg_date') ;
		$row['is_notice']		= $this->valid(A::str($row, 'is_notice'),'is_notice') ;
		
		$stmt = db()->prepare($this->_insert()) ;
		$stmt->bindValue(':board_title'	, $row['board_title']);
		$stmt->bindValue(':board_text'	, $row['board_text']);
		$stmt->bindValue(':reg_date'	, $row['reg_date']);
		$stmt->bindValue(':board_date'	, $row['board_date']);
		$stmt->bindValue(':is_notice'	, $row['is_notice']);
		
		$this->bind_over($row, $stmt) ;
		
		stmtExecute($stmt);
		
		$this->boardIdx = db()->lastInsertId() ;
		
		// 에디터용 필드를 업데이트 한다.
		$editor_session_key = A::str($row, 'editor_session_key') ;
		if( !empty($editor_session_key) )
			$this->editor_key_update($editor_session_key) ;
	}
	function editor_key_update( $session_key)
	{
		$q = '
			UPDATE '.$this->board_table.' 
			SET  editor_session_key = :editor_session_key
			WHERE board_idx = :board_idx
		' ;
		
		$sttm = db()->prepare($q) ;
		$sttm->bindValue(':editor_session_key', $session_key) ;
		$sttm->bindValue(':board_idx', $this->boardIdx, PDO::PARAM_INT) ;	
		stmtExecute($sttm) ;
		
		$EditorFile = new EditorFile($session_key) ;
		$EditorFile->use_writing() ;
	}
	function bind_over($row, &$stmt){}
	
	function update($row)
	{
		$row['board_title']		= $this->valid($row['board_title'],'board_title') ;
		$row['board_text']		= $this->valid(A::str($row,'board_text'),'board_text') ;
		$row['board_date']		= $this->valid(A::str($row, 'board_date'),'board_date') ;
		$row['is_notice']		= $this->valid(A::str($row, 'is_notice'),'is_notice') ;
		
		
		$stmt = db()->prepare($this->_update()) ;
		$stmt->bindValue(':board_title'	, $row['board_title']);
		$stmt->bindValue(':board_text'	, $row['board_text']);
		$stmt->bindValue(':board_date'	, $row['board_date']);
		$stmt->bindValue(':is_notice'	, $row['is_notice']);
		$stmt->bindValue(':board_idx'	, $this->boardIdx , PDO::PARAM_INT);
		
		$this->bind_over($row, $stmt) ;
		
		stmtExecute($stmt);
		return $this->boardIdx ;
	}
	
	function valid($data,$type)
	{
		switch( $type )
		{
			case 'board_title'	: $data = F::str($data) ; break ;
			case 'board_text'	: $data = F::str($data) ; break ;
			case 'board_date'	: $data = F::datetime($data) ; break ;
			case 'reg_date'		: $data = F::datetime($data) ; break ;
			case 'is_notice'	: $data = F::YN($data) ; break ;
		}
		return $data ;
	}
	
	protected function _row()
	{
		return '
			SELECT * FROM '.$this->board_table.' 
			WHERE board_idx = :board_idx ' ;
	}
	
	protected function _rowUp()
	{
		return '
			SELECT * FROM '.$this->board_table.' 
			WHERE board_idx > :board_idx 
			ORDER BY board_idx limit 1' ;
	}
		
	protected function _rowDown()
	{
		return '
			SELECT * FROM '.$this->board_table.' 
			WHERE board_idx < :board_idx 
			ORDER BY board_idx DESC limit 1' ;
	}
	
	
	protected function _insert()
	{
		return '
			INSERT INTO '.$this->board_table.' 
			SET 
			  board_title = :board_title
			, board_text = :board_text
			, board_date = :board_date
			, reg_date = :reg_date
			, read_cnt = 0
			, is_notice = :is_notice ' ;
	}
	
	
	protected function _update()
	{
		return '
			UPDATE '.$this->board_table.' 
			SET 
			  board_title = :board_title
			, board_text = :board_text
			, board_date = :board_date
			, is_notice = :is_notice
			WHERE board_idx = :board_idx ' ;
	}
	
	protected function _updateReadCnt()
	{
		return '
			UPDATE '.$this->board_table.' 
			SET 
			  read_cnt = read_cnt+1
			WHERE board_idx = :board_idx ' ;
	}
	
	
	protected function _delete()
	{
		return '
			DELETE FROM '.$this->board_table.' 
			WHERE board_idx = :board_idx ' ;
	}
}
