<?php

function print_r2($a){ echo '<pre>'.print_r($a,true).'</pre>';}

function print_box( $a , $caption = '' )
{
	$s = '<table id="print_box">' ;
	
	if( !empty($caption) )
		$s .= '<caption>'.$caption.'</caption>' ;
	foreach( $a as $k => $v )
	{
		$s .= '<tr>' ;
		foreach( $v as $kk => $vv )
		{
			$s .= '<td>'.$vv.'</td>' ;
		}
		$s .= '</tr>' ;
	}
	$s .= '</table>' ;
	
	return $s ;
}


function box_change( $a )
{
	//print_r2($a);
	$isBreak = false ;
	$size = count($a);
	$new_arr = array() ;
	foreach( $a as $k => $v )
	{
		$key_x = $key_y = '' ;
		foreach( $v as $kk => $vv )
		{
			if( $a[$k][$kk] == null )
			{
				$key_x = $kk ;
				$key_y = $k ;
				
				break 2 ;
			}
		}
	}
/*
	echo '
			$key_x    : '.$key_x.(  $key_x !='' ? '!=' : '숫자' ).'	<br />
			$key_y : '.$key_y.(  $key_y !='' ? '!=' : '숫자' ).' <br />
		' ;
*/


	if( $key_x !=='' && $key_y !=='' )
	{
		
		$s = '<table>
		<tr>
		' ;
		$key_x_1 = $key_x - 1 ;
		$key_x_2 = $key_x + 1 ;
		$key_y_1 = $key_y - 1 ;
		$key_y_2 = $key_y + 1 ;

		if( $key_x_1 < 0 ) $key_x_1 = '' ;
		if( $key_x_2 >= $size ) $key_x_2 = '' ;
		if( $key_y_1 < 0 ) $key_y_1 = '' ;
		if( $key_y_2 >= $size ) $key_y_2 = '' ;
/*	
		echo '
			$size    : '.$size.'	<br />
			$key_x_1 : '.$key_x_1.' <br />
			$key_x_2 : '.$key_x_2.' <br />
			$key_y_1 : '.$key_y_1.' <br />
			$key_y_2 : '.$key_y_2.' <br />
		' ;
*/
		$new_arr = $a ;
		if( $key_y_1 !== '' )
		{
			swap( $new_arr[$key_y_1][$key_x] , $new_arr[$key_y][$key_x] ) ;
			$s .= '<td>'  ;
			$s .= print_box_checker($new_arr) ;
			$s .= '</td>' ;
		}

		$new_arr = $a ;
		if( $key_y_2 !== '' )
		{
			swap( $new_arr[$key_y_2][$key_x] , $new_arr[$key_y][$key_x] ) ;
			$s .= '<td>' ;
			$s .= print_box_checker($new_arr) ;
			$s .= '</td>' ;
		}

		$new_arr = $a ;
		if( $key_x_2 !== '' )
		{
			

			swap( $new_arr[$key_y][$key_x_2] , $new_arr[$key_y][$key_x] ) ;
			$s .= '<td>' ;
			$s .= print_box_checker($new_arr) ;
			$s .= '</td>' ;
		}
		
		$new_arr = $a ;
		if( $key_x_1 !== '' )
		{
			swap( $new_arr[$key_y][$key_x_1] , $new_arr[$key_y][$key_x] ) ;
			$s .= '<td>' ;
			$s .= print_box_checker($new_arr) ;
			$s .= '</td>' ;
		}
		

		return $s.'	
		</tr>
		</table>' ;
	}

}

function swap( &$a , &$b )
{
	$tmp = $a ;
	$a = $b ;
	$b = $tmp ; 
}


define( '_END_CNT_', 9 ) ;
$arr_clean = array(
					array( 1,2,3 )
				,	array( 4,5,6 ) 
				,	array( 7,8,null )
			) ;
$arr_call_data = array(  array(
								array( 4,1,3 )
							,	array( 2,null,6 ) 
							,	array( 7,5,8 )
							) ) ;


$arr_call_data = array(  array(
								array( 4,1,null )
							,	array( 2,5,3 ) 
							,	array( 7,8,6 )
							) ) ;
$arr_call_data_index = 1 ;
$max = 1 ;
$use_call_index = array() ;
$aStatus = array() ;
function print_box_checker( $a )
{
	GLOBAL $arr_clean , $arr_call_data , $arr_call_data_index , $aStatus, $max;
	foreach( $arr_call_data as $k => $arr )
	{
		$n1 = array_diff_assoc ( $arr[0] , $a[0] ) ;
		$n2 = array_diff_assoc ( $arr[1] , $a[1] ) ;
		$n3 = array_diff_assoc ( $arr[2] , $a[2] ) ;
		
		if( count($n1) == 0 && count($n2) == 0 && count($n3) == 0 )
		{
			/*
			echo '
				<table>
				<caption> 같다. </caption>
				<tr>
					<td><pre>'.print_r($arr,true).'</pre></td>
					<td><pre>'.print_r($a,true).'</pre></td>
				</tr>
				</table>
			' ;
			*/
			return '' ;
		}
		
	}

	$arr_call_data_index++ ;	
	$cnt = 0 ;
	foreach( $arr_clean as $k => $v )
	{
		foreach( $v as $kk => $vv )
		{
			if( $arr_clean[$k][$kk] == $a[$k][$kk] )
			{
				$cnt++ ;
				$aStatus[$arr_call_data_index] = $cnt ;
				$arr_call_data[$arr_call_data_index] = $a ;
			}
				
		}
	}
	
	return print_box( $a, '상태:'.$arr_call_data_index.' <= 이전 '.$max.'(함수값:'.$cnt.')') ;
}

function box_checker_start($a)
{
	GLOBAL $aStatus, $arr_call_data, $use_call_index,$max;
	

	echo '
		<ol>
	';
			$back_max = $max ;
	for($i=0;$i<50;$i++)
	{
		$max_value = 1 ;
		foreach( $aStatus as $k => $v )
		{
			$back_max = $max ;
			if( $max_value < $v )
			{
/*
				echo '<h1>
					$max::'.$max.'<br />
					$max_value::'.$max_value.'<br />
					$k::'.$k.'<br />
					$v::'.$v.'<br />
				</h1>' ;
*/
				if( isset($use_call_index[$k]) ) 
					continue ;

				$max = $k ;
				$max_value = $v ;
				$a = $arr_call_data[$max] ;

			}
			
			if( $v == _END_CNT_ )
			{
				$use_call_index[$max] = $back_max ;
				break 2 ;
			}
			
		}

		
		$use_call_index[$max] = $back_max ;
/*		
		echo '<h1>$use_call_index</h1>' ;
		print_r2($use_call_index);

		echo $max ;
		echo '<h1>$aStatus</h1>' ;
		print_r2($aStatus);
		echo '<h1>max:'.$max.'</h1>' ;
		print_r2($arr_call_data[$max]);
*/
		echo '<li>'. box_change($a) ;
	}
		print_r2($use_call_index);
	echo '
		</ol>
	';
}
?>
<style type="text/css">
	#print_box td{ padding:10px; border:1px solid #000000; }
	#print_box caption{ font-size:10pt; }
</style>

<h3>22.<?php echo getSubTitle() ; ?> : 컴퓨터가 체스 챔피언을 이긴 비결은 인공지능 탐색</h3>

<div style="float:left;width:700px;">
	<div style="float:right;width:680px;">
		<div style="border:1px solid #ff0099; padding:5px; width:500px;">
			1977년 세계 체스 챔피언인 가리 카스파로프와 딥 블루라는 <br />
			이름의 컴퓨터와 체스 대결을 벌여 카스파로프가 패했다.<br />
			2002년에는 블라디미르 크람니크와 딥 프리츠라는 이름의 컴퓨터와 체스 대결을 벌여 크람니크가 승리했다.<br />
			그 후 2006년 에는 블라디미르 크람니크와 딥 프리츠가 대결을 벌여 크람니크가 완패했다.<br />
		</div>

		<ul>
			<li>최고 우선 탐색(best-first search)
				<dl>
					<dt>임의의 상태에서 목표 상태에 도달하기 위해 어떤 상태를 <br />
						탐색하는 것이 지름길인지 추측하는 방식
					<dd>상태의 가치를 추정하기 위해 사용하는 함수를 평가 함수라 하는데 <br />
						평가 함수값이 최대인 상태를 선택해서 탐색해간다.
				</dl>
			<li>테스트
				<?php
					$arr = array(
								array( 4,1,3 )
							,	array( 2,null,6 ) 
							,	array( 7,5,8 )
							) ;
					$arr = $arr_call_data[0] ;
					echo print_box( $arr, '시작') ;
					echo box_checker_start($arr);
				?>
				
		</ul>		
	</div>	
</div>