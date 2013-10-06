<?php
/**
 * Description of upload
 *
 * @author Administrator
 */
class Upload {
	private $aUploadType = array() ; // image or ....
	private $uploadPath = '' ; // upload path 
	private $uploadName = '' ; // upload file name 
	
	function __construct($type = '', $path = '' , $name = '' )
	{
		if( !empty($type) )
			$this->aUploadType[] = $type ; 
		if( !empty($path) )
			$this->uploadPath = $path ; 
		if( !empty($name) )
			$this->uploadName = $name ; 
	}
	
	/**
	 * 2013-08-07
	 * 지정된 이름과 경로로 파일이동후 결과 클래스 반환
	 * @param array $_FILES
	 * [@param string]
	 * [@param string]
	 * @return object UploadResult
	 */
	function move( $aFile , $path = '' , $name = '' )
	{
		$result = new UploadResult ;
		
		if( !empty($path) ) $this->uploadPath = $path ; 
		if( !empty($name) ) $this->uploadName = $name ; 
		
		if( empty($this->uploadPath) ) return $result->error('$this->uploadPath 미설정' ) ;
		if( empty($this->uploadName) ) return $result->error('$this->uploadName 미설정' ) ;
		
		$a = explode('/',$aFile['type']) ;
		$uploadType = $a[0] ;
		$uploadExp = $a[1] ;		
		$uloadFileName = $this->uploadPath.'/'.$this->uploadName.'.'.$uploadExp ;
		
		
		$result->name = $this->uploadName.'.'.$uploadExp ;
		$result->path = $this->uploadPath ;
		$result->size = $aFile['size'] ;
		$result->type = $uploadType ;
		
		$isMove = false ;
		if( count($this->aUploadType) == 0 )
			$isMove = true ;
		
		foreach($this->aUploadType as $v )
			if( $v == $result->type ) {
				$isMove = true ;
				break ;
			}
		
		if( $isMove ) {
			if( @move_uploaded_file( $aFile['tmp_name'], $result->path.'/'.$result->name ) )
				$result->isUploaded = true ;
			else return $result->error ('알수없는 에러[move_uploaded_file]');
					
		} else return $result->error('허용안되는 확장자' ) ;
		
		
		return $result ; 
	}
}

class UploadResult
{
	public $name ;
	public $path ;
	public $size ;
	public $type ;
	
	public $isUploaded ;
	public $log ;
	
	function __construct($name = '',$path = '',$size = '',$type = '') {
		$this->name = $name ;
		$this->path = $path ;
		$this->size = $size ;
		$this->type = $type ;
	}
	
	function error( $log )
	{
		$this->isUploaded = false ;
		$this->log = $log ;
		return $this ;
	}
}