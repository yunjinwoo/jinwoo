<?php

class Layout {
	public $path ;
	public $skin ;
	
	function __construct($varObj = array(),$skin = 'default') {
		$this->path = _PATH_.'/tpl' ;
		$this->skin = $skin ;
		
		$var = new publicVar($varObj);
		extract((array)$var);
		$f = $this->path.'/layout_'.$this->skin.'_head.html' ;
		if( is_file($f))
			require $f ;
	}
	
	function __destruct() {
		echo quizMenu();
		
		$f = $this->path.'/layout_'.$this->skin.'_foot.html' ;
		if( is_file($f))
			require $f ;
	}
	
}
?>
