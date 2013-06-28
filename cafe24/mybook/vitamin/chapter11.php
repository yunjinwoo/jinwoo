code 정리하기....
<?php

$aCity = array(
	'서울' 
,	'인천' 
,	'대전' 
,	'대구' 
,	'울산' 
,	'부산' 
,	'광주' 
) ;

$aCityWeight = array(
	'서울' => array( '인천' => 5 , '대전' => 5)
,	'인천' => array( '서울' => 2 , '대전' => 2 , '광주' => 8)
,	'대전' => array( '서울' => 5 , '인천' => 2 , '대구' => 3)
,	'대구' => array( '울산' => 1 , '대전' => 3 , '광주' => 5 , '부산' => 3)
,	'울산' => array( '대구' => 1 , '부산' => 1)
,	'부산' => array( '대구' => 3 , '울산' => 1 , '광주' => 4)
,	'광주' => array( '인천' => 8 , '대구' => 5 , '부산' => 4)
) ;
$aCityData = array() ;
$aCityContinue = array() ;

$startCity = '부산' ;
$endCity = '서울' ;

if( !(in_array($startCity, $aCity) && in_array($endCity, $aCity)) )
	die( '없는도시' ) ;

$num = 0 ;
$thisCity = $startCity ;
$i = 0 ;
while( true && $i++ < 100 )
{	
	$aMoveData = array() ;

	// 이전도시 구하기
	foreach( $aCityWeight[$thisCity] as $k => $v )
	{
		// 음영 처리부분 제외하기
		if( isset($aCityContinue[$k]) )
			continue ; 
		
		if( isset($aCityData[$k]) )
		{
			// 이전도시 기록이 있으면 비교해 정보 수정하기
			if( !isset($aCityContinue[$k]) && $aCityData[$k][1] > ($v +  $num) ) 
			{
				$aCityData[$k][0] =  $city ;
				$aCityData[$k][1] =  $v + $num ;			
			}			
		}else{
			$aCityData[$k] = array( $thisCity , $v+$num );	
		}
		$aMoveData[$aCityData[$k][1]] = $k ;	
	}

	// 음영 처리하기
	$aCityContinue[$thisCity] = $thisCity ;

	if( !is_array($aMoveData) )
		exit ;
	ksort( $aMoveData ) ;
	list( $num , $city ) = each( $aMoveData ) ;

	// 최단거리 출발 지점 재정의
	foreach( $aCityData as $k => $v )
	{
		if( !isset($aCityContinue[$k]) && $v[1] < $num )
		{
			$city = $k ;
			$num  = $aCityData[$k][1] ; 
		}
	}

	$thisCity = $city ;
	if( $endCity == $city ) 
		break ;
}

$print_city = $endCity ;
$s = array() ;
foreach( $aCityData as $k => $v )
{
	$a = '	<li>'.$print_city ;
	if( isset( $aCityData[$print_city][1] ) ) 
		$a .= '-'.$aCityData[$print_city][1] ;
	$s[] = $a ;
	if( !isset($aCityData[$print_city][0]) ) 
		break ;

	$print_city = $aCityData[$print_city][0] ;
	
}

krsort($s) ;
?>

<h3>12.<?php echo getSubTitle() ; ?>(Dijkstra algorithm) : 차량 항법 시스템의 기본원리</h3>

<div style="float:left;width:700px;">
	<div style="float:right;width:680px;">
		<ul>
			<li><img src="graph.php" />

			<li>부산에서 서울까지의 최단거리 구하기
				<ol>
					<?php
						echo implode(chr(13),$s) ;

					?>
				</ol>
				
		</ul>		
	</div>	

	
	<h1>code</h1>
	<? highlight_file( __FILE__ ) ;?>

</div>
