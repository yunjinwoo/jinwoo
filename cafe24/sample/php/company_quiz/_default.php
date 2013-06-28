<?php
function fileToSource( $file ){
	$fp = fopen( $file , 'r' );
	$data = fread( $fp , filesize( $file ) );
	fclose( $fp );


}
?>