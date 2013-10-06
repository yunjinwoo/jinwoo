<?php
/**
 * Description of list
 *
 * @author Administrator
 */
class BoardList extends Board {
	
	private $listCnt = -1 ;
	protected $aWhere = array() ;
	protected $aKeyword = array() ;
			
	function __construct($board_table='',$page_size='',$list_size='') {
		parent::__construct($board_table, $page_size, $list_size) ;
	}
	
	function setSearch( $field , $keyword )
	{
		$this->aWhere[$field] = $field.' LIKE :'.$field ;
		$this->aKeyword[$field] = $keyword ;
	}
	
	function getList($page=1)
	{
		$startNum = ($page-1)*$this->list_size ;
		
		$stmt = db()->prepare($this->_list($startNum)) ;
		foreach( $this->aKeyword as $k => $v ){
			$stmt->bindValue(":$k", "%$v%");
		}
		
		stmtExecute($stmt);
		
		$ret = array();
		$no = $this->getCount() - $startNum ;
		while($r = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			$r['no'] = $no-- ;
			$ret[$r['board_idx']] = $this->replace($r) ;
		}
		
		return $ret ;
	}
	
	/**
	 * 게시판 상황에 맞게 데이타를 변환시켜야한다.
	 */
	function replace($r)
	{
		return $r ;
	}
	
	
	function getCount()
	{
		if( $this->listCnt < 0 )
			$this->setCount () ;
			
		return $this->listCnt ;
	}
	
	private function setCount()
	{
		$stmt = db()->prepare($this->_count()) ;
		foreach( $this->aKeyword as $k => $v ){
			$stmt->bindValue(":$k", "%$v%");
		}
		
		stmtExecute($stmt);
		$this->listCnt = $stmt->fetchColumn(0) ;
	}
	
	 
	function getWhere()
	{
		if( count($this->aWhere) >= 1 )
			return ' WHERE ('.implode( ' OR ', $this->aWhere).')' ;
		else return ' WHERE 1=1 ' ;
	}
	
	// QUERY STRING
	protected function _count()
	{
		return '
			SELECT count(*) FROM '.$this->board_table.' 
			'.$this->getWhere().' ' ;
	}
	protected function _list($start)
	{
		return '
			SELECT *
			FROM '.$this->board_table.' 
			'.$this->getWhere().'
			ORDER BY board_date desc
			LIMIT '.$start.','.$this->list_size  ;
	}
	
}