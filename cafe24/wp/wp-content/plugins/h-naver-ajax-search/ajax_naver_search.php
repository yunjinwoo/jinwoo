<?
header("Content-type: text/xml; charset=UTF-8");
header("Last-Modified: ".gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
	$query = $_GET[query];
		
	if($_GET[in] != "") {
		$query .= " $_GET[in]";
	}
	
	$query = urlencode($query);

	$cate = $_GET[cate];
	$key = $_GET[key];

	
	
	$url = "openapi.naver.com";
	$fp = fsockopen($url, 80, $errno, $errstr, 60);
 	fputs($fp, "GET /search?");
  	fputs($fp, "key=$key&query=$query&display=$count&start=1&target=$cate&sort=sim");
  	fputs($fp, " XML\r\n");
	fputs($fp, "Host: openapi.naver.com\r\n");
  	fputs($fp, "Connection: Close\r\n\r\n");
	$result = stream_get_contents($fp);	
	$result = explode("<?xml", $result);
	$n_result = explode("</rss>", $result[1]);	
	$real_result = $n_result[0];
	
	echo "<?xml ";
	echo $real_result;
	echo "</rss>";
?>