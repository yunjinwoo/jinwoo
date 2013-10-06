<?php
require_once '../_define.php';

console::group('test') ;
console::error('test') ;
console::groupEnd() ;

require_once _PATH_lib_.'/session.c.php';

console::log('test1') ;

$Session = new Session ;
console::log(print_r($Session,true)) ;
console::log('test2') ;
$Session->logout() ;
//echo 'test' ;
