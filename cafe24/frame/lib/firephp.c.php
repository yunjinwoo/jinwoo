<?php
require_once dirname(__FILE__).'/FirePHP.class.php';
require_once dirname(__FILE__).'/fb.php';

class console {
	public static $logCnt = 1 ;
	public static function log($s)
	{
		FB::log($s.' #'.console::trace(debug_backtrace()));  
	}
	public static function info($s)
	{
		FB::info($s.' #'.console::trace(debug_backtrace()));  
	}
	public static function warn($s)
	{
		FB::warn($s.' #'.console::trace(debug_backtrace()));  
	}
	public static function error($s)
	{
		FB::error($s.' #'.console::trace(debug_backtrace()));  
	}
	public static function group($s)
	{
		FB::group($s.' #'.console::trace(debug_backtrace()));  
	}
	public static function groupEnd()
	{
		FB::groupEnd();  
	}
	
	public static function trace($a)
	{
		
		if( self::$logCnt == '1' )
			return 'LINE '.$a[0]['line'].' '.$a[0]['file'] ;
		else if(self::$logCnt > 1)
		{
			$s = '' ;
			for( $i = self::$logCnt - 1 ; $i >= 0 ; $i-- )
				$s .= chr(10).'LINE '.$a[$i]['line'].' '.$a[$i]['file'] ;
			
			return $s ;
		}else
			return print_r( $a , true ) ;
	}
}
