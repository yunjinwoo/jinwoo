<?php

$search_date = G::post('search_date') ;
$date_cnt = G::post('date_cnt') ;
$start_limit = G::post('start_limit') ;
$list_size = G::post('list_size') ;


if( !is_numeric(str_replace(':','',str_replace(' ','',str_replace('-','',$search_date)))) )
	$search_date = date('Y-m-d H:i:s') ;

if( !is_numeric($date_cnt) ) $date_cnt = 10 ;
if( !is_numeric($start_limit) ) $start_limit = 0 ;
if( !is_numeric($list_size) ) $list_size = 30 ;

$start_date = strtotime( '-'.$date_cnt.'day' , strtotime($search_date)) ;

$q = '
	SELECT * from add_log 
	WHERE time between '.$start_date.' AND '.strtotime($search_date).'
	ORDER BY time DESC LIMIT '.$start_limit.','.$list_size ;
//echo $q ;
$r = str_query($q);
$aList = array() ;
while( $a = fetch_assoc($r) )
{
	$a['date'] = date('m-d H:i:s', $a['time']) ;
	$aList[$a['idx']] = $a ;
}

if( count($aList) >= 1 )
{
	$q = '
		SELECT a.idx, a.log_idx, a.page, a.time, a.stay_time , 
				b.domain, b.refer, b.time as refer_time
		FROM add_log_page a LEFT JOIN add_log_refer b
		ON a.log_idx = b.log_idx AND a.idx = b.page_idx
		WHERE a.log_idx IN ( '.implode(',',array_keys($aList)).') 
		ORDER BY a.log_idx DESC, a.idx ASC' ;
//	echo $q ;
	$r = str_query($q) ;
	while( $a = fetch_assoc($r) )
	{
		$aList[$a['log_idx']]['refer_to_page'][$a['idx']] = $a ;
	}
}
//printArray( $aList ) ;
//domain 	refer 	time

//	$a['page'] = date('m-d H:i:s', $a['time']) ;
?>
<form method="post" action="">
	기준날짜<input type="text" name="search_date" value="<?php echo $search_date?>"/><br />
	<!-- 작업-출력기간(일)<input type="text" name="date_cnt" value="<?php echo $date_cnt?>"/><br /> -->
	
	시간<input type="text" name="start_limit" value="<?php echo $start_limit?>"/>부터 
	<input type="text" name="list_size" value="<?php echo $list_size?>"/>개
	
	<input type="submit" value="search">	
</form>

<table class="list_a1" summary="방문번호, 방문시간, IP, 페이지, 이동페이지">
<caption>목록</caption>
<colgroup>
<col width="60"/>	
<col width="60"/>
<col width="100"/>
<col width="100"/>
<col width=""/>
</colgroup>
<thead>
<tr>
	<th>방문번호</th>
	<th>호스트</th>
	<th>방문시간</th>
	<th>IP</th>
	<th>페이지</th>
</tr>
</thead>

<?php foreach( $aList as $k => $v ) : ?>
<tr>
	<td><?php echo $v['idx']?></td>
	<td><?php echo $v['site_host']?></td>
	<td><?php echo $v['date']?></td>
	<td style="text-align:left;"><?php echo $v['ip']?></td>
	<td><ul>
		<?php foreach($v['refer_to_page'] as $kk => $vv): ?>
					<li style="text-align:left;">
					<?php if( !empty($vv['refer']) ) : ?>
						<strong><a href="#" title="<?php echo urldecode($vv['refer'])?>" onclick="alert(this.title);return false;"><?php echo $vv['domain']?></a></strong> =>
					<?php endif ;?>
						<?php echo date('H:m:i',$vv['time']).'('.$vv['stay_time'].')'.urldecode($vv['page'])?>
					</li>
		<?php endforeach; ?>
		</ul>
	</td>
</tr>
<?php endforeach;?>
</table>


<br /><br /><br /><br /><br />