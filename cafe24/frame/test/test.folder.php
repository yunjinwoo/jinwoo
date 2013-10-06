<?php
require_once '../_define.php';
require_once './head.php';

echo '<h1>폴더구조</h1>' ;
$continueFolder = array(
	'.'
,	'..'
,	'.svn'
,	'test'
,	'nbproject'	
);

$root = '..' ;
$readPath = array() ;
$dir = dir($root);
while (false !== ($entry = $dir->read())) {
	$path = $root.'/'.$entry ;
		if( in_array($entry, $continueFolder) ) continue;
		if( !is_dir($path) ) continue;
	
	$readPath[$entry] = $path ;
}
$dir->close();

foreach( $readPath as $top => $path )
{
	$subPath = array();
	$dir = dir($path);
	while (false !== ($entry = $dir->read())) {
		$path2 = $path.'/'.$entry ;
		if( in_array($entry, $continueFolder) ) continue;
		if( !is_dir($path2) ) continue;

		$subPath[$entry] = $entry ;
	}
	$dir->close();
	
	echo '
		<table>
		<caption>'.$path.'</caption>
		<thead>
		<tr>
			<th width="100">폴더명</th>
			<th width="100">하위폴더</th>
			<th width="200">비고</th>
		</tr>
		</thead>
		<tbody>
	' ;
	$first = '<td rowspan="'.count($subPath).'">'.$top.'</td>';
	foreach( $subPath as $r )
	{
		echo '
		<tr>
			'.$first.'
			<td>'.$r.'</td>
			<td></td>
		</tr>
		';
		$first = '' ;
	}
	echo '
		</tbody>
		</table>' ;
}
?>
<style type="text/css">
	body{ text-align:center; }
	table{margin:0 auto; margin-top: 20px;margin-bottom: 20px;width:400px;text-align:center;border:1px solid #a5a5a5;border-collapse: collapse;}
	table th { background: #cdbcb1;padding:4px;}
	table td { text-align:left; padding:4px;border-bottom:1px solid #a5a5a5;}
	table tr.info th { padding:4px; background: #e6cfb7;}
	table tr.info td { padding:4px; border-bottom:0px;}
	table caption{font-size: 15pt; font-weight: bold;}
	.tl{text-align:left;}
</style>