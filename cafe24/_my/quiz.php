<?php
require '_default.php';

$sTpl = $_GET['tpl'] ;
$sFlie = 'quiz/'.$sTpl ;
if(!is_file($sFlie)) return ;

echo h1("이런저런 사이트에서 구경...");
include $sFlie ;
?>
