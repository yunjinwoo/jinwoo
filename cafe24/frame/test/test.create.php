<?php
require_once '../_define.php';


$a = new CreateTables ;
$a->file() ;
$a->admin() ; //$a->admin_default() ;
$a->accessIp() ;
$a->category() ;$a->category_default() ;
$a->cateProd() ;
$a->product_menu();$a->product_menu_default() ;
$a->banner() ;

$a->board() ;
$a->board_file();

$a->product_item();