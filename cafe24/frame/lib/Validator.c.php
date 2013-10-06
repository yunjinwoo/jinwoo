<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Validator
 *
 * @author Administrator
 */
class Validator{
	static public $required 		= 'required' ;
	static public $isAlpha			= 'isAlpha' ;
	static public $isAlphaNumber	= 'isAlphaNumber' ;
//	static public $alphaNum = 'alphaNum' ;
//	static public $alphaNum = 'alphaNum' ;
//	static public $alphaNum = 'alphaNum' ;

	public $log = '' ;
	public $field = '' ;
	function __construct(){
		
	}
	
	function getLog() {	return $this->log ; }
	function getField() { return $this->field ;	}
	/**
	 * 검사기 샘플 =====
	 * $valid = array(		
	 * 	    'admin_id' => Validator::$required
	 * 	,	'admin_pw' => Validator::$required
	 * 	,	'admin_owner' => Validator::$required
	 * 	) ;
	 * 	$valid = new Validator ;
	 * 	if( $valid->check($row, $valid) )
	 * 		return $this->log ;
	 * 
	 * @param array 검사할 데이타
	 * @param array 검사할 형식
	 * @return bool Description
	 */
	function check( $data , $validRoll )
	{
		$flag = true ;
		foreach( $validRoll as $k => $v )
		{
			if( method_exists('Validator', $v) )
			{
				$is = call_user_func_array(array($this,$v), array($data[$k])) ;
				if( !$is ){
					$this->field = $v ;
					$this->log = '['.$k.' - '.$data[$k].' ] Validator 오류!!' ;
					$flag = false ;
					break ;
				}
			}else{
				$this->log = '['.$v.'] Validator 함수 없음!!' ;
				$flag = false ;
				break ;
			}	
		}
		
		return $flag ;
	}
	
	function required($v)
	{
		return preg_replace('/\s/', '', $v) != '' ;
	}
	
	function isAlpha($v)
	{
		return preg_replace( '/[a-zA-Z]/' , '', $v) == '' ;
	}
	
	function isAlphaNumber($v)
	{
		return preg_replace( '/[a-zA-Z0-9]/' , '', $v) == '' ;
	}
	
	
}
		 
