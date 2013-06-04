<?php
require '_default.php';

$sTpl = $_GET['tpl'] ;
$sFlie = 'euler/'.$sTpl ;
if(!is_file($sFlie)) return ;

include $sFlie ;
?>
