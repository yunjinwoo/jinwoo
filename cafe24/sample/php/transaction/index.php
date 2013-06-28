<?php
$add_path = '../../../add' ;
include_once $add_path.'/_default.php' ;

class TransactionTest{
	var $sTable = 'add_transaction_test' ;
	var $aList = array() ;
	var $DB ;
	function __construct()
	{
		$this->DB = moduleLoader::getDatabase() ;
		$q = '
		CREATE TABLE IF NOT EXISTS `'.$this->sTable.'` (
		  `idx` int(10) unsigned NOT NULL auto_increment,
		  `datetime` datetime NOT NULL COMMENT \'일자\',
		  `msg` varchar(200) NOT NULL COMMENT \'문구\',
		  PRIMARY KEY  (`idx`)
		) ENGINE=innodb  DEFAULT CHARSET=utf8 ;
		' ;
		
		$this->DB->str_query( $q ) ;
	}

	function getData()
	{
		$q = 'select * from '.$this->sTable ;
		$r = $this->DB->str_query( $q ) ;
		while( $a = $r->fetch_assoc() )
		{
			$this->aList[$a['idx']] = $a ;
		}
		return $this->aList ;
	}

	function getRow( $n )
	{
		$q = 'select * from '.$this->sTable.' where idx IN ('.$this->DB->real_escape_string($n).') ' ;
		$a = $this->DB->rowsData( $q ) ;
		$this->aList[$a['idx']] = $a ;
		return $a ;
	}

	function start()
	{
		$this->DB->str_query('set autocommit=0') ;
		$this->DB->str_query('begin') ;
	}

	function save( $sMsg , $nIdx ) 
	{
		if( is_numeric( $nIdx ) ){ 
			$q = 'UPDATE '.$this->sTable.' SET ' ;
			$s = ' WHERE idx='.$nIdx ; 
		}else{
			$q = 'INSERT INTO '.$this->sTable.' SET ' ;
			$s = ' , `datetime` = now() ' ;
		}
		
		$q .= ' msg = \''.$this->DB->real_escape_string( $sMsg ).'\'' ;

		return $this->DB->query( $q.$s ) ;
	}

	function del( $n )
	{
		$q = 'delete from '.$this->sTable.' where idx IN ('.$this->DB->real_escape_string($n).') ' ;
		return $this->DB->query( $q ) ;
	}
}

###################
$TransactionTest = new TransactionTest() ;

## type 1 
//$TransactionTest->DB->autocommit(TRUE);
## type 2
$TransactionTest->start() ;


$sPostMsg = R::post('msg') ;
$sGetIdx = R::get('idx') ;
$sGetDelIdx = R::get('del_idx') ;

if( !empty($sPostMsg) )
{
	if( $TransactionTest->save( $sPostMsg , $sGetIdx ) )
	{	
		echo 'rollback-save' ;
	}
}
if( is_numeric( $sGetDelIdx ) )
{
	if( $TransactionTest->del( $sGetDelIdx ) )
	{
		echo 'rollback' ;
	}	
}
## type 1 
$TransactionTest->DB->rollback();
## type 2
//$TransactionTest->DB->query('rollback') ;


## type 1 
//$TransactionTest->DB->commit();
## type 2
//$TransactionTest->DB->query('commit');

if( is_numeric( $sGetIdx ) )
{
	$aRow = $TransactionTest->getRow( $sGetIdx ) ;
}

$aList = $TransactionTest->getData() ;

$TransactionTest->DB->rollback();

$TransactionTest->DB->close();


DEFAULTTAG( 'utf-8' ) ;
?>
<pre>
트렌잭션 테스트
add_transaction_test 생성

begin

commit

rollback
에따른 결과 확인 및 
</pre>

<div>
	<form method=post action="?idx=<?php echo $aRow['idx']?>">
		문구<input type="text" name="msg" value="<?php echo $aRow['msg']?>">
		<input type="submit">
	</form>
</div>

<table cellpadding=0 cellspacing=0 width="100%" border=0 class="table_table">
<tr>
	<td class="table_title">번호</td>
	<td class="table_title">일자</td>
	<td class="table_title">문구</td>
</tr>
<?php foreach( $aList as $aRow ) : ?>
<tr>
	<td class="table_data">
		<input type="button" value="<?php echo $aRow['idx']?>" onclick="location.href='?idx='+this.value">
		<input type="button" value="del" onclick="location.href='?del_idx=<?php echo $aRow['idx']?>'">
	</td>
	<td class="table_data"><?php echo $aRow['datetime']?></td>
	<td class="table_data"><?php echo $aRow['msg']?></td>
</tr>
<?php endforeach ; ?>
</table>

<hr /> 
<hr /> 
<?php highlight_file(__FILE__);?>
</body>
</html>