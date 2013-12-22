<?php
require_once '_default.php' ;

$nAction = get('action') ;
$sTitle = getPageTitle() ;

?><!DOCTYPE html>
<html lang="ko">
<title><?php echo $sTitle?></title>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="css.css"></link>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<head>
<body>
    
<div class="container">
	<h1><?php echo _TITLE_ ;?></h1>
	<div class="row">
		<div class="col-md-3">
			<ol class="nav nav-pills nav-stacked">
        <?php
                $index = 0 ;
                foreach( $_bookMenu as $sub_title => $a ) : 
                $index++; 
                $class = ( str_pad($index,2,'0',STR_PAD_LEFT) === substr($nAction,0,2) ) ? 'active open' : '';?>
				<li class="dropdown <?=$class?>"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo $sub_title?><span class="caret"></span></a>
					
					<ol class="nav nav-pills nav-stacked dropdown-menu" role="menu">
                <?php foreach( $a as $k => $v ) :
                    $print_index = str_pad($index,2,'0',STR_PAD_LEFT).str_pad($k+1,2,'0',STR_PAD_LEFT);
                    $class = ( $print_index === $nAction ) ? 'class="active"' : '';
                ?>
						<li <?=$class?>><a href="?action=<?=$print_index?>"><?php echo $v?></a></li>
                <?php endforeach; ?>
					</ol>
                </li>
        <?php endforeach ; ?>
			</ol>
	</div>
		
				
	<div class="col-md-7">