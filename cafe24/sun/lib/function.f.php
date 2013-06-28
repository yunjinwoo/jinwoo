<?php
	function xmp($s)
	{
		echo "<xmp>" ;
		print_r( $s ) ;
		echo "</xmp>" ;	
	}

	function JSPrint( $str ){
		echo "<script type=\"text/javascript\">" ;
		echo $str ;
		echo "</script>" ;
	}

	function printArray( $arr )
	{
		echo "<pre>" ;
		print_r( $arr ) ;
		echo "</pre>" ;	
	}

	
	function alertHref( $str , $href = ""){
		echo "<script type=\"text/javascript\">" ;
		if( !empty($str) )
			echo "alert('".$str."');" ;
		if( $href == 'back' )
			echo "history.back();" ;
		if( $href != 'back' && !empty($href) )
			echo "location.replace('".$href."');" ;
		echo "</script>" ;
		exit;
	}


	function urlMinus( $url , $aKey )
	{
		$_gourl = explode( '?' , $url ) ;
		$tmpGourl = array() ;		
		parse_str ( $_gourl[1] , $tmpGourl ) ;
		foreach( $aKey as $v ){
			unset($tmpGourl[$v]) ;
		}

		$gourl	= $_gourl[0].'?' ;
		foreach( $tmpGourl as $key => $value )
		{
			$gourl	.= $key.'='.$value.'&' ;
		}
		return $gourl ;
	}

	function getHrefSelf(){
		$aArgs = func_get_args();

		return urlMinus($_SERVER['REQUEST_URI'], $aArgs );
	}



	function optionMake( $arr , $str = '' , $how )
	{
		if( !is_array($arr) ){
			return '' ;
		}

		$returnVar = '' ;
		$count = count($arr);
		$_key = array() ; $_value = array() ;
		switch( $how )
		{
			case 'kv' : $_key = array_keys($arr) ; $_value = array_values($arr) ;	break ;
			case 'kk' : $_key = array_keys($arr) ; $_value = $_key ;				break ;
			case 'vv' : default : $_key = array_values($arr) ; $_value = $_key ;	break ;
		}
		for( $i = 0 ; $i < $count ; $i++ )
		{
			$selected = '' ;	
			if( !strcmp($_key[$i],$str) )
			{
				$selected = 'selected' ;
			}
			$returnVar .= '<option value="'.$_key[$i].'" '.$selected.'>'.$_value[$i].'</option>'."\r\n" ;		
		}
		return $returnVar ;
	}

	function errorDebug( $msg = "" )
	{
		echo '<h3>'.$msg.'</h3><pre>' ;
		debug_print_backtrace() ;
		echo '</pre>' ;
		exit ;
	}


	#######################
	########## DB #########
	#######################

	
class DB 
{
	var $conn ;
	
	function DB( $sDbKey = 'add' )
	{
		$this->DBconnect( $sDbKey ) ;
	}
	

	function getDBconnect( $sDbKey = 'add' )
	{	
		if(!is_resource($this->conn[$sDbKey]))
			return false;
		else
			return $this->conn[$sDbKey] ;
	}
	
	function DBconnect( $sDbKey = 'add' )
	{		
		if( !is_resource($this->conn[$sDbKey]) )
		{	
			$this->conn[$sDbKey] = mysql_connect( _DB_HOST_ , _DB_USER_ , _DB_PASSWD_ ) ;
			
			if( !@mysql_select_db( _DB_NAME_  ) )
			{
				echo ' NOT SELECT DATA BASE ' ;
			}
		}
	}
	
	function close( $sDbKey = '' )
	{
		if( empty( $sDbKey )){		
			foreach( $this->conn as $k => $v )
			{
				@mysql_close($v) ;			
			}	
		}else{
			@mysql_close( $this->conn[$sDbKey] ) ;
		}
	}
}

$DB = new DB() ;
##################################################
################  FUNCTION  ######################
##################################################
	class __LAST_INSERT_ID__{	static $insert_id = '' ; }
	
	function get_last_insert_id()
	{
		return __LAST_INSERT_ID__::$insert_id ;
	}

	function str_query( $query  ){
		$result = mysql_query($query) ;
		//__LAST_INSERT_ID__::$insert_id = mysql_insert_id() ;
		if( !$result )
		{
			$sErr = $query."<hr>\n".mysql_error() ;	
			echo '<pre>' ;
			echo $sErr ;
			debug_print_backtrace() ;
			echo '</pre>' ;	
			exit ;
		}

		return $result ;
	}



	function fetch_array( $result ){
		if( $tmp = mysql_fetch_array($result) ){
			//array_walk( $tmp , 'deInsertQuery') ;	
			return $tmp ;
		}else{
			return false ;
		}	
	}

	function fetch_assoc( $result ){
		if( $tmp = mysql_fetch_assoc ($result) ){
			//array_walk( $tmp , 'deInsertQuery');			
			return $tmp ;
		}else{
			return false ;
		}	
	}

	function fetch_row( $result ){
		if( $tmp = mysql_fetch_row ($result) ){
			//array_walk( $tmp , 'deInsertQuery');			
			return $tmp ;
		}else{
			return false ;
		}	
	}

	function fetch_object( $result ){
		if( $tmp = mysql_fetch_object($result) ){
			//array_walk( $tmp , 'deInsertQuery');			
			return $tmp ;
		}else{
			return false ;
		}	
	}

	
	function rowsData( $query ){
		$result = str_query($query) ;
		$_row = fetch_assoc($result ) ;
		return $_row ;
	}


	function addslashesQuery( &$value ){
		$value = "'".addslashes(trim($value))."'";
	}
	function deInsertQuery( &$value , $key ){
		$value = iconv('EUC-KR','UTF-8',stripslashes($value)) ;
		//$value = stripslashes($value) ;
	}

#######################################
#######################################
#######################################

class G 
{
	static function post_arr($v)
	{
		$arr = array() ;
		if( !isset($_POST[$v]) )
			return $arr ;

		foreach( $_POST[$v] as $k => $vv )
			$arr[$k] = G::slash($vv) ;

		return $arr ;
	}

	static function get( $v , $null = '' )
	{
		return isset($_GET[$v])?G::slash($_GET[$v]):$null ;
	}

	static function post( $v , $null = '' )
	{
		return isset($_POST[$v])?G::slash($_POST[$v]):$null ;
	}

	static function request( $v , $null = '' )
	{
		return isset($_REQUEST[$v])?G::slash($_REQUEST[$v]):$null ;
	}

	static function server( $v , $null = '' )
	{
		return isset($_SERVER[$v])?G::slash($_SERVER[$v]):$null ;
	}

	static function session( $v , $null = '' )
	{
		return isset($_SESSION[$v])?G::slash($_SESSION[$v]):$null ;
	}

	static function cookie( $v , $null = '' )
	{
		return isset($_COOKIE[$v])?G::slash($_COOKIE[$v]):$null ;
	}

	static function slash($s)
	{
		return trim($s);
	}
}


function slash($a)
{
	if( !is_array($a) )
		return array() ;
	foreach( $a as $k => $v )
		$a[$k] = addslashes ($v) ;
	return $a ;
}
