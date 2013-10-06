<?php
/**
 * BoardList 를 상속받아 바뀌는 부분 제구성
 *
 * @version 1
 */
class NewsBoardList extends BoardList {
	function __construct() {
		parent::__construct(str_replace('default', 'news',_db_board_));
	}
	
	/**
	 * override 
	 * 뉴스게시판의 리스트 쿼리 반환
	 * 
	 * @param int limit [$start] , $this->list_size
	 * @return string list query
	 */
	protected function _list($start)
	{
		$q = '
			SELECT *, 
				(SELECT count(*) FROM '._db_board_file_.'
				WHERE board_name = \''.$this->board_table.'\'
				AND board_sub_name = \'\'	
				AND board_idx = a.board_idx ) as file_cnt
			FROM '.$this->board_table.' a
				'.$this->getWhere().' AND is_notice = \'N\'
			ORDER BY board_date desc
			LIMIT '.$start.','.$this->list_size ;

		return $q ;
	}
	
	/**
	 * override 
	 * COUNT 쿼리 반환
	 * 
	 * @return string list count query
	 */
	protected function _count()
	{
		return '
			SELECT count(*) FROM '.$this->board_table.' 
			'.$this->getWhere().' AND is_notice = \'N\'
			ORDER BY board_idx asc' ;
	}
	
	/**
	 * 공지로 체크된 리스트 가져오기
	 * $page가 1 보다 크면 조회 안함
	 * 
	 * @param int $page 
	 * @return array fetch_assoc
	 */
	public function getNoticeList($page=1)
	{
		if( $page > 1 ) return array() ;
		
		$stmt = db()->prepare($this->_notice_list()) ;
		foreach( $this->aKeyword as $k => $v ){
			$stmt->bindValue(":$k", "%$v%");
		}	
		stmtExecute($stmt);
		
		$ret = array() ;
		while($r = $stmt->fetch(PDO::FETCH_ASSOC))
			$ret[$r['board_idx']] = $this->replace($r) ;
		
		return $ret ;
	}
	
	/**
	 * 공지사항 리스트용 쿼리 반환
	 * 
	 * @return string notice-list query
	 */
	protected function _notice_list()
	{
		$q = '
			SELECT *, (SELECT count(*) FROM '._db_board_file_.'
				WHERE board_name = \''.$this->board_table.'\'				
				AND board_sub_name = \'\'	
				AND board_idx = a.board_idx ) as file_cnt
			FROM '.$this->board_table.' a
				'.$this->getWhere().' AND is_notice = \'Y\'
			ORDER BY board_date desc' ;
	
		return $q ;
	}
	
	function replace($r)
	{

		if( isset($r['file_cnt']) )
			$r['is_file'] = $r['file_cnt']<=0?'N':'Y' ;
		$r['is_new'] = (strtotime($r['board_date']) + (60*60*24*3) - time()) > 0 ? "print" : "" ;

		return $r ;
	}
}


class NewsBoardRow extends BoardRow {
	function __construct($board_idx) {
		parent::__construct($board_idx, str_replace('default', 'news',_db_board_));
	}
	
}


class EventBoardList extends BoardList {
	private $aWhereSelf;
	protected $year ;
			
	function __construct() {
		parent::__construct(str_replace('default', 'event',_db_board_));
	}
	
	function setYear( $year )
	{
		if(empty($year) || strlen($year) != 4 || !is_numeric($year)) $year = date('Y');
		$this->aWhereSelf[] = ' left(board_start_date,4) = \''.$year.'\' ' ;	
		
		return $this->year = $year ;
	}
	
	function setQuarter( $quarter )
	{	
		switch($quarter)
		{
			case 4 : break;case 3 : break;case 2 : break;case 1 : break;
			default : $quarter = ceil(date('n')/3);
		}

		$year = $this->year;
		switch($quarter)
		{
			case 1 : $q = ' board_start_date between \''.$year.'-01-01\' AND \''.$year.'-03-31\'' ; break;
			case 2 : $q = ' board_start_date between \''.$year.'-04-01\' AND \''.$year.'-06-31\'' ;break;
			case 3 : $q = ' board_start_date between \''.$year.'-07-01\' AND \''.$year.'-09-31\'' ;break;
			case 4 : $q = ' board_start_date between \''.$year.'-10-01\' AND \''.$year.'-12-31\'' ;break;
		}
		$this->aWhereSelf[] = $q;
		
		return $quarter ;
	}
	
	function setCountry($country)
	{	
		if(!empty($country))
			$this->aWhereSelf[] = ' board_country = \''.$country.'\'';
		
		return $country;
	}
	
	function getSubWhere()
	{
		$str = '' ;
		if( count($this->aWhereSelf) >= 1 )
			$str = ' AND '.implode( ' AND ', $this->aWhereSelf) ;
		
		return $str ;
	}
	
	protected function _list($start)
	{
		return '
			
				SELECT *, 
					(SELECT count(*) FROM '._db_board_file_.'
					WHERE board_name = \''.$this->board_table.'\'					
					AND board_sub_name = \'\'	
					AND board_idx = a.board_idx ) as file_cnt
				FROM '.$this->board_table.' a
					'.$this->getWhere().$this->getSubWhere().'
				ORDER BY board_start_date DESC
				LIMIT '.$start.','.$this->list_size.'
			
			 ' ;
			
	}

	// QUERY STRING
	protected function _count()
	{
		return '
			SELECT count(*) FROM '.$this->board_table.' 
			'.$this->getWhere().$this->getSubWhere().' ' ;
	}
	
	function getYear()
	{
		$q = '
			SELECT DISTINCT year FROM 
			(
				select left(board_start_date,4) as year from '.$this->board_table.'
				union
				select left(board_end_date,4) as year  from '.$this->board_table.'
			) a
		' ;
		$stmt = db()->prepare($q);
		stmtExecute($stmt);
		$ret = array() ;
		while($r=$stmt->fetch(pdo::FETCH_ASSOC))
			$ret[$r['year']] = $r['year'];
		
		return $ret ;
	}
	
	function getCountry()
	{
		$q = '
			SELECT DISTINCT board_country FROM '.$this->board_table ;
		$stmt = db()->prepare($q);
		stmtExecute($stmt);
		$ret = array() ;
		while($r=$stmt->fetch(pdo::FETCH_ASSOC))
			$ret[$r['board_country']] = $r['board_country'];
		
		return $ret ;
	}
	
	function replace($r)
	{
		$r['is_file'] = $r['file_cnt']<=0?'N':'Y' ;
		
		$startTime = strtotime($r['board_start_date']);
		$endTime = strtotime($r['board_end_date']);
		
		$q ='
			SELECT board_name, board_idx, board_sub_name, file_alt, file_path 
			FROM '._db_board_file_.'
			WHERE board_name = \''.$this->board_table.'\' AND board_idx = '.$r['board_idx'].' AND board_sub_name = \'prev\'' ;
		$s = db()->prepare($q);
		stmtExecute($s);
		$r2 = $s->fetch(PDO::FETCH_ASSOC);
		if( is_array($r2) )
			$r = array_merge($r, $r2);
		
		$r['print_start_end_date'] = date('d M',$startTime).'~'. date('d M',$endTime).', '.date('Y',$startTime) ;

		
		if( substr($r['board_site'],0,7) != 'http://')
			$r['board_site'] = 'http://'.$r['board_site'] ;

		return $r ;
	}

	/**
	 * 공지로 체크된 리스트 가져오기
	 * $page가 1 보다 크면 조회 안함
	 * 
	 * @param int $page 
	 * @return array fetch_assoc
	 */
	public function getListMain()
	{
		$q = '
			SELECT *
			FROM '.$this->board_table.' a
				'.$this->getWhere().' AND is_notice = \'Y\'
			ORDER BY board_date desc limit 2' ;
		console.log( $q );
		$stmt = db()->prepare($q) ;
		foreach( $this->aKeyword as $k => $v ){
			$stmt->bindValue(":$k", "%$v%");
		}	
		stmtExecute($stmt);
		
		$ret = array() ;
		while($r = $stmt->fetch(PDO::FETCH_ASSOC))
			$ret[$r['board_idx']] = $this->replace($r) ;
		
		return $ret ;
	}
	
}


class EventBoardRow extends BoardRow {
	function __construct($board_idx) {
		parent::__construct($board_idx, str_replace('default', 'event',_db_board_));
	}
	
	
	function bind_over($row, &$stmt){
		$stmt->bindValue(':board_site'			, A::str($row, 'board_site'));
		$stmt->bindValue(':board_start_date'	, A::str($row, 'board_start_date'));
		$stmt->bindValue(':board_end_date'		, A::str($row, 'board_end_date'));
		$stmt->bindValue(':board_country'	, A::str($row, 'board_country'));
		
	}
	
	function replace( $row ) 
	{
		
		$startTime = strtotime($row['board_start_date']);
		$endTime = strtotime($row['board_end_date']);
		$row['print_start_end_date'] = date('d M',$startTime).'~'. date('d M',$endTime).', '.date('Y',$startTime) ;
		
		if( substr($row['board_site'],0,7) != 'http://')
			$row['board_site'] = 'http://'.$row['board_site'] ;

		return $row ;
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
			, is_notice = :is_notice 
			, board_site = :board_site
			, board_start_date = :board_start_date
			, board_end_date = :board_end_date
			, board_country = :board_country' ;
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
			, board_site = :board_site
			, board_start_date = :board_start_date
			, board_end_date = :board_end_date
			, board_country = :board_country
			WHERE board_idx = :board_idx ' ;
	}

	
	function setYear( $year )
	{
		if(empty($year) || strlen($year) != 4 || !is_numeric($year)) $year = date('Y');
		$this->aWhereSelf[] = ' left(board_start_date,4) = \''.$year.'\' ' ;	
		
		return $this->year = $year ;
	}
	
	function setQuarter( $quarter )
	{	
		switch($quarter)
		{
			case 4 : break;case 3 : break;case 2 : break;case 1 : break;
			default : $quarter = ceil(date('n')/3);
		}
		
		$year = $this->year;
		switch($quarter)
		{
			case 1 : $q = ' board_start_date between \''.$year.'-01-01\' AND \''.$year.'-03-31\'' ; break;
			case 2 : $q = ' board_start_date between \''.$year.'-04-01\' AND \''.$year.'-06-31\'' ;break;
			case 3 : $q = ' board_start_date between \''.$year.'-07-01\' AND \''.$year.'-09-31\'' ;break;
			case 4 : $q = ' board_start_date between \''.$year.'-10-01\' AND \''.$year.'-12-31\'' ;break;
		}
		$this->aWhereSelf[] = $q;
		
		return $quarter ;
	}
	
	function setCountry($country)
	{	
		if(!empty($country))
			$this->aWhereSelf[] = ' board_country = \''.$country.'\'';
		
		return $country;
	}
	
	function getSubWhere()
	{
		$str = '' ;
		if( count($this->aWhereSelf) >= 1 )
			$str = ' AND '.implode( ' AND ', $this->aWhereSelf) ;
		
		return $str ;
	}

	protected function _rowUp()
	{
		return '
			SELECT * FROM '.$this->board_table.' 
			WHERE board_idx > :board_idx '.$this->getSubWhere().'
			ORDER BY board_idx limit 1' ;
	}
		
	protected function _rowDown()
	{
		return '
			SELECT * FROM '.$this->board_table.' 
			WHERE board_idx < :board_idx  '.$this->getSubWhere().'
			ORDER BY board_idx DESC limit 1' ;
	}

}



class TestimoniaBoardList extends BoardList {
	function __construct() {
		parent::__construct(str_replace('default', 'testimonia',_db_board_));
	}
	
	protected function _list($start)
	{
		$q = '
			SELECT *
			FROM (
				SELECT * FROM 
				'.$this->board_table.'
					'.$this->getWhere().'
			ORDER BY board_date desc
			LIMIT '.$start.','.$this->list_size.'
			) a LEFT JOIN (
				SELECT board_name , board_idx as b_board_idx, board_sub_name, file_alt, file_path 
				FROM '._db_board_file_.'
				WHERE board_sub_name = \'\'
			) b ON a.board_idx = b.b_board_idx AND b.board_name = \''.$this->board_table.'\'
			LEFT JOIN (
				SELECT board_idx as c_board_idx, file_path as pdf_file_path
				FROM '._db_board_file_.'
				WHERE board_sub_name = \'pdf\'
			) c ON a.board_idx = c.c_board_idx AND b.board_name = \''.$this->board_table.'\'
			
			ORDER BY board_date desc ';
			//pre($q);
		return $q;
	}
	
	function replace($r)
	{
		$q ='
			SELECT board_name, board_idx, board_sub_name, file_alt, file_path 
			FROM '._db_board_file_.'
			WHERE board_name = \''.$this->board_table.'\' AND board_idx = '.$r['board_idx'].' AND board_sub_name = \'\'' ;
		$s = db()->prepare($q);
		stmtExecute($s);
		$r2 = $s->fetch(PDO::FETCH_ASSOC);
		if( is_array($r2) )
			$r = array_merge($r, $r2);

		$r['board_type_text'] = $r['board_type'] == 'youtube'	?'유투브':'' ;
		$r['board_type_text'] = $r['board_type'] == 'pdf'		?'PDF':$r['board_type_text'] ;
		$r['board_youtube_url'] = F::youtube($r['board_youtube_url']);
		
		return $r ;
	}
}


class TestimonialBoardRow extends BoardRow {
	function __construct($board_idx) {
		parent::__construct($board_idx, str_replace('default', 'testimonia',_db_board_));
	}
	
	/*
	
	function fileUpload($row)
	{
		$BoardFile = new boardFile($this->board_table, $this->boardIdx);
		if( isset($row['del_file_idx']) && is_array($row['del_file_idx']) )
			foreach( $row['del_file_idx'] as $k => $v )
				$v = $BoardFile->delete ($k) ;
		
		$BoardFile->insert() ;
	}
	*/
	
	function bind_over($row, &$stmt){
		$stmt->bindValue(':board_type'			, A::str($row, 'board_type'));
		$stmt->bindValue(':board_youtube_url'	, A::str($row, 'board_youtube_url'));
	}
	
	function replace( $row ) 
	{
		if( $row['board_type'] == 'pdf' )
			$row['checked_action'] = ' $("#typeP").click();' ;
		if( $row['board_type'] == 'youtube' )
			$row['checked_action'] = ' $("#typeY").click();' ;
		
		
		$row['board_youtube_url_replace'] = F::youtube($r['board_youtube_url']);
		
		return $row ;
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
			, is_notice = :is_notice 
			, board_type = :board_type
			, board_youtube_url = :board_youtube_url' ;
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
			, board_type = :board_type
			, board_youtube_url = :board_youtube_url
			WHERE board_idx = :board_idx ' ;
	}
}


class YoutubeBoardList extends TestimoniaBoardList {
	function __construct() {
		parent::__construct(str_replace('default', 'youtube',_db_board_));
		$this->board_table = str_replace('default', 'youtube',_db_board_);
	}
	
	protected function _list($start)
	{
		return '
				SELECT * FROM 
				'.$this->board_table.'
					'.$this->getWhere().'
			ORDER BY board_date desc
			LIMIT '.$start.','.$this->list_size.'
			 ' ;
	}
}


class YoutubeBoardRow extends TestimonialBoardRow {
	function __construct($board_idx) {
		parent::__construct($board_idx, str_replace('default', 'youtube',_db_board_));
		$this->board_table = str_replace('default', 'youtube',_db_board_);
	}
}