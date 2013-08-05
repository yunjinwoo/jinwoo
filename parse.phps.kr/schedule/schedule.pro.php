<?php 
require_once './_default.php';

$action = $_GET['action'] ;

$Schedule = new Schedule ;
if( $action == "list" )
{
	$Schedule->setDay($_GET['day']) ;
	$Schedule->
	
	$json = array() ;
	$json['list'] = getDayList($_GET['day'],$_GET['len']) ;
	$json['list'] = getDayList($json['list']) ;
	exit ;
}



###############################################
################# FUNCTION ####################
###############################################
/**
* 2013-08-02
* 변수가 날짜 형식의 문자열인지 아닌지 판단하는 함수
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
	*/
	function setDay($day)
	{
		if( !F::isDate($day) ) {
			console::error();
			return ;
		}
			
		$this->day = $day ;
		$this->day_list = array( $day ) ;
	}
	
	function dayToList($len)
	{
		if( !is_numeric($len) ) return ;
		
		$tmp = $this->day ;
		$this->day_list = array() ;
		for( $i = 1 ; $i <= $len ; $i++ )
		{
			$this->day_list[] = date('Y-m-d', strtotime(' '.$i.'day ', strtotime($tmp) )) ;
		}
	}
	
}

