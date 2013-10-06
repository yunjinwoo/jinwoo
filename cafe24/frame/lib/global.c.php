<?php
/**
 * Description of global
 *
 * @author Administrator
 */
class G{
	static function file($k)
	{
		return isset($_FILES[$k])?$_FILES[$k]:'';
	}
	static function get($k)
	{
		return isset($_GET[$k])?trim($_GET[$k]):'';
	}
	static function post($k)
	{
		return isset($_POST[$k])?trim($_POST[$k]):'';
	}
	static function postArr($k)
	{
		if( isset($_POST[$k]) && is_array($_POST[$k]) )
			return self::_arrTirm($_POST[$k]) ;
		else
			return array() ;
	}
	static function postArrFind($arr_key, $val_key)
	{
		if( isset($_POST[$arr_key][$val_key]) )
			return trim($_POST[$arr_key][$val_key]);
		else
			return '' ;
	}
	
	static function _arrTirm(&$a)
	{
		if(is_array($a))
		{
			foreach( $a as $k => $v )
			{
				if( is_array($v) )
					$a[$k] = self::_arrTirm ($v) ;				
				else 
					$a[$k] = trim($a[$k]) ;
			}
			
			return $a ;
		}
	}
}
