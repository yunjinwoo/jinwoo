<?php
?><!-- <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"> -->
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title><?=$g4['title']?></title>
<link rel="stylesheet" href="<?=$g4['path']?>/style.css" type="text/css">
</head>
<body>
<form method="post">
	<label><input type="checkbox" name="check[content]" value="content" <?php echo !empty($_POST['check']['content'])?'checked':''?>>파일내용</label>
	<label><input type="checkbox" name="check[file]" value="file"<?php echo !empty($_POST['check']['file'])?'checked':''?>>파일명</label>

	
	<label><input type="checkbox" name="is_folder" value="file"<?php echo !empty($_POST['is_folder'])?'checked':''?>>하위검색</label>

	<input type="text" name="keyword" value="<?php echo $_POST['keyword']?>" >
	<input type="submit">
</form>
<?php

$count = 0 ;
function readDirFile( $path , $sFindStr , $isLowDirRead = false )
{
	if( empty($sFindStr) ) return ;

	$aBinaryExt = array(
			'gif' , 'jpg' , 'epg' , 'swf' , 'fla' , 'psd' , 'zip' , 'exe'
		,	'bmp' , 'xls' , 'lsx' , 'ppt' , 'ptx' , 'pdf' , 'doc' , 'ocx'
		,	'pst' 
		) ;
	$d = dir($path);
	$i = 0 ;
	while (false !== ($entry = $d->read())) {
		if( $entry == '.' || $entry == '..' )
			continue ;

		if( is_dir($path.'/'.$entry) )
		{
			$aDir[$i] = $entry ;
			if( $isLowDirRead )
			{
				echo $path.'/'.$entry ;
				echo '<br />' ;
				flush() ;
				usleep(10);
				$aFileFind[$path][$entry] = readDirFile( $path .'/'.$entry , $sFindStr , $isLowDirRead ) ;				
			}
		}else{
			//if( ($t=mime_content_type($path.'/'.$entry )) != 'text/plain' )
			if( in_array(substr($entry,-3) , $aBinaryExt ) )
			{
				$aNotText[$path][] = $t.'::'.$entry ;
			}else{
				if( !empty($_POST['check']['content']) )
				{
					$content = file_get_contents( $path.'/'.$entry ) ;
					if( strpos( $content , $sFindStr ) !== false )
					{
						$GLOBALS['conut']++ ;
						echo 'find :: '.$path.'/'.$entry.'<br />' ;
						$aFileFind[$path][$entry] = $path.'/'.$entry ;
					}else{
						$aFile[$path][] = $entry ;
					}
					$content = null ;
				}

				if( !empty($_POST['check']['file']) )
				{
					if( strpos( $path.'/'.$entry , $sFindStr ) !== false )
					{
						$GLOBALS['conut']++ ;
						echo 'find file_name:: '.$path.'/'.$entry.'<br />' ;
						$aFileFind[$path][$entry] = $path.'/'.$entry ;
					}else{
						$aFile[$path][] = $entry ;
					}
					$content = null ;
				}


					
			}
		}
		$i++ ;
	}
	$d->close();
	
	if( $isLowDirRead )
	{
		//echo '<pre>' ;
		//echo '검색된 총 파일 갯수( '.count($aFileFind).' )<br />' ;
		//print_r( $aFileFind ) ;
		//echo '</pre>' ;
		return $aFileFind ;
	}else{
		echo '<pre>' ;
		echo 'dir<br />' ;
		print_r( $aDir ) ;
		echo 'file<br />' ;
		print_r( $aFileFind ) ;
		print_r( $aFile ) ;
		echo 'not text<br />' ;
		print_r( $aNotText ) ;
		echo '</pre>' ;
	}
}

//$sFindStr = 'member_part' ;


//$arr = array('decide') ; dbconnect_outer.php dbconnect_toolbars.php
$sFindStr = $_POST['keyword'] ;
if(empty($sFindStr) )
	return '' ;

echo '<pre>['.$sFindStr.']검색중....( 전체 : <b id="totals"></b>)<br /><div id="print_dir">' ;

$aFileFind = readDirFile( './add2', $sFindStr , empty($_POST['is_folder'])?false:true ) ;
echo '<hr />
검색된 총 파일 갯수( '.$GLOBALS['conut'].' )<br />' ;
print_r( $aFileFind ) ;

echo '</div>' ;
echo '</pre>' ;
/*
    [0] => jquerymobile
    [1] => mypage
    [2] => add2
    [3] => gnu
    [4] => sample
    [6] => test
    [7] => smart
    [10] => add
    [12] => cpoll
    [13] => MSN
    [14] => wsdl
    [15] => lnb
    [17] => mybook
    [19] => mobile
    [22] => nate_api
    [24] => api
    [26] => kamja
    [28] => bar
    [30] => jpgraph-3.5.0b1
    [32] => js
    [34] => easy_editor
    [35] => DATA
    [36] => images
    [40] => cafe
    [41] => zbxe
    [42] => open_source
    [46] => new
    [50] => manage
    [52] => wemade
	*/
?>
<input type="button" value="view" onclick="print_dir_onoff()">
<script type="text/javascript">	
<!--
	document.getElementById('totals').innerHTML = "<?php echo $GLOBALS['conut'] ?>" ;

	function print_dir_onoff()
	{
		if( document.getElementById('print_dir').style.display == '' )
		{
			document.getElementById('print_dir').style.display = 'none' ;
		}else{
			document.getElementById('print_dir').style.display = '' ;
		}		
	}
	
	print_dir_onoff() ;
//-->
</script>