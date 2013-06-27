<?php
// index.php 87 mainBoardSkinTopImg( 'b_7' , $defaultFileImg = '/ind_img/left_story-3x1.gif' )<!-- ################## 연수 이야기 -->
// index.php 91 mainBoardSkinTopImg( 'b_2_1' , $defaultFileImg = '/ind_img/left_story-6x1.gif' )<!-- ################## 유학 이야기 -->
## public
function mainBoardSkinTopImg( $bo_table , $defaultFileImg = '/ind_img/left_story-3x1.gif' )
{
	$sql = " select wr_id, wr_subject, wr_content from g4_write_".$bo_table." where wr_is_comment = 0 order by wr_num limit 0, 1 ";
    //explain($sql);
    $result = sql_query($sql);
    $subject		= '' ;
	$content		= '게시물이 없습니다.' ;
	$href = '#' ;
   if( $row = sql_fetch_array($result) )
   {
		$subject		= conv_subject($row['wr_subject'], 12, "…");
		$content		= conv_subject(strip_tags($row['wr_content']), 160, "…");
		$wr_id			= $row['wr_id'] ;
		$href = './bbs/board.php?bo_table='.$bo_table.'&wr_id='.$wr_id ;

		$sql = "select bf_file from g4_board_file  where bo_table='".$bo_table."' and wr_id = ".$wr_id." limit 0, 1 ";
		$result = sql_query($sql);
		$files = sql_fetch_array($result) ;
   }	
	$fileName = empty($files['bf_file'])? $defaultFileImg : '/gnu/data/file/'.$bo_table.'/'.$files['bf_file'] ;
?>
						<IMG NAME="LEFT_STORY4" SRC="<?php echo $fileName?>" WIDTH=107 HEIGHT=105 BORDER=0 ></TD>
					<TD WIDTH=176 HEIGHT=105 COLSPAN=1 ROWSPAN=1 valign="top" class="pro_s_txt1" style="padding-top:9;padding-right:10">
						<TABLE WIDTH="100%" HEIGHT="100%" cellpadding=0 cellspacing=0 style="table-layout:fixed">
						<TR>
							<TD><A HREF="<?php echo $href?>"  style="color: #990000"><span style="font-weight: bold"><?php echo $subject?></span><?php echo $content?></A></TD>
						</TR>
						</TABLE>
<?php
} // function mainBoardSkin END

//index.php 51 mainBoardSkinText( 'b_2_2' , 1 ); ################## 유학뉴스
//index.php 133 mainBoardSkinText( 'b_0_0' , 2 )	################## notice&news
## public
function mainBoardSkinText( $bo_table , $type = 1)
{	
	$sql = " select wr_id, wr_subject, wr_datetime from g4_write_".$bo_table." where wr_is_comment = 0 order by wr_num limit 0, 5 ";
    //explain($sql);
    $result = sql_query($sql);
    for ($i=0; $row = sql_fetch_array($result); $i++) 
	{
		$subject		= conv_subject($row['wr_subject'], 36, "…");
		$wr_datetime	= substr($row['wr_datetime'], 2, 8);
		$wr_id			= $row['wr_id'] ;
		
		switch( $type )
		{
			case 1 : 
?>
		  <tr>
			<td width="5%" height="23">&nbsp;</td>
			<td width="76%" height="23" class="txt_s1"><a href="./bbs/board.php?bo_table=<?php echo $bo_table?>&wr_id=<?php echo $wr_id?>"><?php echo $subject?></a></td>
			<td width="19%" height="23" class="txt_s1"><?php echo $wr_datetime?></td>
		  </tr>
<?php	
			break ; // case 1 END
			case 2 : 
?>
		  <tr>
			<td width="5%" height="22" valign="middle" class="txt_a_s">&nbsp;</td>
			<td width="76%" height="22" valign="middle" onMouseOver=this.style.backgroundColor="#246790" onMouseOut=this.style.backgroundColor=""><a href="./bbs/board.php?bo_table=<?php echo $bo_table?>&wr_id=<?php echo $wr_id?>" style="font-size: 12px; color: #88C9E8"><?php echo $subject?></a></td>
			<td width="19%" height="22" valign="middle"><span style="font-size: 12px; color: #88C9E8"><?php echo $wr_datetime?></span></td>
			</tr>
<?php	
			break ; // case 2 END
		}// switch( $type ) END
	}// for ($i=0; $row = sql_fetch_array($result); $i++)  END
}// function mainBoardSkinText END


// index.php 145 mainBoardSkinGallery() ############## gallery
// index.php 145 mainBoardSkinGallery() ############## gallery
## public
function mainBoardSkinGallery()
{	
	$_gallery = array() ;
	$_b_9 = getDbMainGalleryArray( 'b_9' , 9 , 'wr_id, wr_subject, wr_datetime' ) ;
	$_b_2_3 = getDbMainGalleryArray( 'b_2_3' , 9 , 'wr_id, wr_subject, wr_datetime' ) ;
	
	$_gallery = array_merge( $_b_9 , $_b_2_3) ;
	$sGalleryTag = '' ;
	
	$count = 0 ;
	if( count($_gallery) > 1 )
	{
		rsort($_gallery['wr_datetime']) ;
		for( $i = 0 ; $i < 9 ; $i++ )
		{
			$wr_id		= $_gallery['wr_id'][$i] ;
			$bo_table	= $_gallery['bo_table'][$i] ;
			if( !empty( $bo_table ) )
			{
				$_file = sqlToArray( 'select bf_file from g4_board_file where bo_table=\''.$bo_table.'\' and wr_id='.$wr_id.' limit 1' ) ;
			
				foreach ( $_file['bf_file'] as $key_file => $value_file )
				{
					$fileName = empty($value_file) ? '/ind_img/mid_news-4x2.gif' : '/gnu/data/file/'.$bo_table.'/'.$value_file ;
					$sGalleryScriptTag .= 'divData['.$count++.'] =\'<A HREF="'.$_gallery['href'][$i].'"><img vspace=3 hspace=3 src="'.$fileName.'" border=0 height=300></A>\';'.chr(13).chr(10) ;
				}
			}
			
					$sGalleryTag .= '<tr><td width="76%" height="22" valign="middle" style="color: #CCCCCC" onMouseOver=this.style.backgroundColor="#246790" onMouseOut=this.style.backgroundColor=""> ' ;
					$sGalleryTag .= '<a href=" '.$_gallery['href'][$i].'" style="font-size: 11px; color: #999999">' ;
					$sGalleryTag .=	$_gallery['subject'][$i] ;
					$sGalleryTag .= '</a></td></tr>' ;
		
		
		}// for( $i = 0 ; $i < 9 ; $i++ ) END
			?>
		<script language="javascript" type="text/javascript" src="/js/scrollFun.js"></script>
		<script language="javascript" type="text/javascript">

		var heightPx = 306 ; //높이
		// 스크롤될 라인
		var divName = new Array(
				<?php
					echo '"scrollArea0'.$count--.'"' ;
					while( $count-- > 0 )
					{
						echo ', "scrollArea0'.$count.'"' ;
					}
				?>
					) ;
		var totalSize = divName.length ;
		// 스크롤되는 내용 
		var divData = new Array( totalSize ) ;
		// 스크롤되는 라인의 갯수 divName의 크기
		var movingDiv = new Array() ;
		var timeOutVar = 50 ;

		<?php
			#########PRINT 
			echo $sGalleryScriptTag ;
		?>

		</script>
				<div align="center">
					<div style="width:194;height:205;overflow:hidden;"><script  language="javascript" type="text/javascript">
					makeDiv(); startScrollArea();
					</script></div>
				</div></TD>
					<TD WIDTH=125 HEIGHT=205 COLSPAN=1 ROWSPAN=1 valign="top" background="/ind_img/mid_news-4x3.gif" style="padding-left:5;padding-right:5;padding-top:1"><table width="89%" border="0" cellspacing="0" cellpadding="0">	
		<?php							
					echo  $sGalleryTag ;
	}else{
		?>
				<div align="center"><img SRC="/ind_img/mid_news-4x2.gif" width="194" height="205"></div></TD>
						<TD WIDTH=125 HEIGHT=205 COLSPAN=1 ROWSPAN=1 valign="top" background="/ind_img/mid_news-4x3.gif" style="padding-left:5;padding-right:5;padding-top:1"><table width="89%" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td width="76%" height="22" valign="middle" style="color: #CCCCCC" onMouseOver=this.style.backgroundColor="#246790" onMouseOut=this.style.backgroundColor=""><a href="#" style="font-size: 11px; color: #999999"></a></td>
						</tr>

			<?php
	}
}// function mainBoardSkinGallery END
## public  예전것.... 혹시나 해서 백업
function mainBoardSkinGallery222222()
{
	$_gallery = array() ;
	$_b_9 = getDbMainGalleryArray( 'b_9' , 9 , 'wr_id, wr_subject, wr_datetime' ) ;
	$_b_2_3 = getDbMainGalleryArray( 'b_2_3' , 9 , 'wr_id, wr_subject, wr_datetime' ) ;
	
	$_gallery = array_merge( $_b_9 , $_b_2_3) ;

	if( count($_gallery) > 1 )
	{
		rsort($_gallery['wr_datetime']) ;
		for( $i = 0 ; $i < 9 ; $i++ )
		{
			if( $i == 0 )
			{
				$wr_id		= $_gallery['wr_id'][$i] ;
				$bo_table	= $_gallery['bo_table'][$i] ;
				//echo  'select bf_file from g4_board_file where bo_table=\''.$bo_table.'\' and wr_id='.$wr_id.' limit 1' ;
				$_file = sqlToArray( 'select bf_file from g4_board_file where bo_table=\''.$bo_table.'\' and wr_id='.$wr_id.' limit 1' ) ;
				$fileName = empty($_file['bf_file'][0]) ? '/ind_img/mid_news-4x2.gif' : '/gnu/data/file/'.$bo_table.'/'.$_file['bf_file'][0] ;
				
				?>
					<div align="center"><img SRC="<?php echo $fileName?>" width="194" height="205"></div></TD>
						<TD WIDTH=125 HEIGHT=205 COLSPAN=1 ROWSPAN=1 valign="top" background="/ind_img/mid_news-4x3.gif" style="padding-left:5;padding-right:5;padding-top:1"><table width="89%" border="0" cellspacing="0" cellpadding="0">		
				<?php			
			}
			?>
						<tr>
							<td width="76%" height="22" valign="middle" style="color: #CCCCCC" onMouseOver=this.style.backgroundColor="#246790" onMouseOut=this.style.backgroundColor=""><a href="<?php echo $_gallery['href'][$i]?>" style="font-size: 11px; color: #999999"><?php echo $_gallery['subject'][$i]?></a></td>
						</tr>

			<?php
		}// for( $i = 0 ; $i < 9 ; $i++ ) END
	}else{
		?>
				<div align="center"><img SRC="/ind_img/mid_news-4x2.gif" width="194" height="205"></div></TD>
						<TD WIDTH=125 HEIGHT=205 COLSPAN=1 ROWSPAN=1 valign="top" background="/ind_img/mid_news-4x3.gif" style="padding-left:5;padding-right:5;padding-top:1"><table width="89%" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td width="76%" height="22" valign="middle" style="color: #CCCCCC" onMouseOver=this.style.backgroundColor="#246790" onMouseOut=this.style.backgroundColor=""><a href="#" style="font-size: 11px; color: #999999"></a></td>
						</tr>

			<?php
	}
}// function mainBoardSkinGallery END

## public
function sqlToArray( $sql )
{
	$result = sql_query($sql);

	$data = array() ;
	while( $row = sql_fetch_array($result) )
	{		
		foreach( $row  as $key => $value )
		{
			$data[$key][] = $value ;
		}
   }
   return $data ;
}



## private
function getDbMainGalleryArray( $bo_table , $limit , $field)
{
	$sql = " select ".$field." from g4_write_".$bo_table." where wr_is_comment = 0 order by wr_num limit 0,".$limit ;
	$result = sql_query($sql);

	$data = array() ;
	while( $row = sql_fetch_array($result) )
	{		
		$data['subject'][]		= conv_subject($row['wr_subject'], 16, "…");
		$data['wr_id'][]		= $row['wr_id'] ;
		$data['href'][]			= './bbs/board.php?bo_table='.$bo_table.'&wr_id='.$row['wr_id'] ;
		$data['wr_datetime'][]	= $row['wr_datetime'] ;
		$data['bo_table'][]		= $bo_table ;
   }
   return $data ;
}

?>
