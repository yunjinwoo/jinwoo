<?php 
require_once './_default.php';

$action = $_GET['action'] ;

$Schedule = new Schedule ;
if( $action == "list" )
{
	$Schedule
			->setDay($_GET['day'])
			->dayToList($_GET['len']) ;
	
	
	exit ;
}



###############################################
################# FUNCTION ####################
###############################################
/**
 * 2013-08-02
 * 스케줄 관련 클레스
 * @param string 2000-10-10
 */
class Schedule
{
	private $day ;
	private $day_list ;
	
	
	function __construct( $day = "" ){
		$this->Schedule($day) ;
	}
	function Schedule( $day = "" ){
		if( !F::isDate($day) ) $day = date('Y-m-d') ;
		
		$this->setDay($day) ;
	}
	
	/**
	 * 기준 날짜를 설정
	 * @param string 2000-10-10
	 * @return $this 
	 */
	function setDay($day)
	{
		if( !F::isDate($day) ) {
			console::error();
			return ;
		}
			
		$this->day = $day ;
		$this->day_list = array( $day ) ;
		
		return $this ;
	}
	
	/**
	 * 검색할 날짜 영역을 구한다
	 * @param int 2000-10-10
	 * @return $this 
	 */
	function dayToList($len)
	{
		if( !is_numeric($len) ) return ;
		
		$tmp = $this->day ;
		$this->day_list = array() ;
		for( $i = 1 ; $i <= $len ; $i++ )
		{
			$this->day_list[] = date('Y-m-d', strtotime(' '.$i.'day ', strtotime($tmp) )) ;
		}
		
		return $this ;
	}
	
}

