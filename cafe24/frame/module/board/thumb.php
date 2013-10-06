<?php
load('board');

define('_THUMB_NEWS_MAX_', 2);
define('_THUMB_EVENT_MAX_', 2);

function thumb($idx, $type, $webpath, $options = array() )
{
	$BoardFile = new boardFile('thumb_'.$type, $idx);
	$row = $BoardFile->find();

	//if( is_file($_SERVER['DOCUMENT_ROOT'].$row['file_path']) )
	//	return $row['file_path'];
	
	$to_webpath			= _WEB_PATH_DATA_.'/thumb/'.$type.$idx.'.jpg' ;	
	$to_webpath			= _WEB_PATH_DATA_.'/thumb/'.basename($webpath);
	if( is_file($_SERVER['DOCUMENT_ROOT'].$to_webpath) )
		return $to_webpath;
	
	// maximum thumb side size
	$max_x = A::number($options, 'max_x', 98);
	$max_y = A::number($options, 'max_y', 62);
	
	// cut image before resizing. Set to 0 to skip this.
	$cut_x = A::number($options, 'cut_x', 0);
	$cut_y = A::number($options, 'cut_y', 0);
	
	// Quality for JPEG and PNG.
	// 0 (worst quality, smaller file) to 100 (best quality, bigger file)
	// Note: PNG quality is only supported starting PHP 5.1.2
	$image_quality = A::number($options, 'image_quality', 100);
	
	
	// resulting image type (1 = GIF, 2 = JPG, 3 = PNG)
	// enter code of the image type if you want override it
	// or set it to -1 to determine automatically
	//$image_type		= $options['image_type'] >= 1 && $options['image_type'] < 4 ? $options['image_type'] : -1 ;
	$image_type		= -1 ;
	
	require_once _PATH_lib_.'/thumb/image.class.php';
	$img = new Zubrag_image;
	
	$img->max_x        = $max_x;
	$img->max_y        = $max_y;
	$img->cut_x        = $cut_x;
	$img->cut_y        = $cut_y;

	$img->quality      = $image_quality;
	$img->save_to_file = true;	// save to file (true) or output to browser (false)
	$img->image_type   = $image_type;
	
	$images_from_path	= _PATH_.$webpath ;
	$images_to_path		= $_SERVER['DOCUMENT_ROOT'].$to_webpath ;
	
	$img->GenerateThumbFile($images_from_path, $images_to_path);
	
	// 추가 작업해야함
	// $BoardFile->insertThumb($images_from_path, $images_to_webpath, $options);
			
	return $to_webpath;	
}