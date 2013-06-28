<?
include_once("./_common.php");

$g4['title'] = "";

$value = 'rhksflwk' ;
if( !empty($_GET['value']) )
{
	$value = $_GET['value'] ;
}

echo $value .'<br />' ;
$row = sql_fetch(" select password('$value') as pass ");
echo $row[pass].'<br />';

$row = sql_fetch(" select old_password('$value') as pass ");
echo $row[pass];

?>
