<?php
function test()
{
	$test = 1 ;
	return true ;
}


if( test() )
{
	echo '<A HREF="?test=1111">111</A> ' ;
}else{
	echo '<A HREF="">222</A>' ;
}

?>
<pre>
<? print_r( parse_url('http://www.addbasic.com/p.php?awera')) ;?>
<? print_r( parse_url('http://addbasic.com/p.php?awera')) ;?>
</pre>
<?

phpinfo() ;
?>