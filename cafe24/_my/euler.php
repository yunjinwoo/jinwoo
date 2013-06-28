<?php
require '_default.php';

$sTpl = $_GET['tpl'] ;
$sFlie = 'euler/'.$sTpl ;
if(!is_file($sFlie)) return ;

echo h1("http://euler.synap.co.kr/prob_list.php");
include $sFlie ;
?>
