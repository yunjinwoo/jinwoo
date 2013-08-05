<?php
require_once _INC_.'/FirePHP.class.php';
require_once _INC_.'/fb.php';

class console {
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
		return 'LINE '.$a[0]['line'].' '.$a[0]['file'] ;		
	}
}

?>
