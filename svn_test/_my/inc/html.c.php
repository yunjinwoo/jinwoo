<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of html
 *
 * @author Administrator
 */

function h1( $s ){
	return heading($s,1) ;
}
function h2( $s ){
	return heading($s,2) ;
}
function h3( $s ){
	return heading($s,3) ;
}
function h4( $s ){
	return heading($s,4) ;
}
function h5( $s ){
	return heading($s,5) ;
}
function heading($s,$num='1'){
	return '<h'.$num.'>'.$s.'</h'.$num.'>'.newline();
}
function a( $h,$s,$t="" ){
	if( !empty($t) ) $t = ' target="'.$t.'" ' ;
	return '<a href="'.$h.'" '.$t.'>'.$s.'</a>'."\n" ;
}
function hr(){
	return "<hr />".newline() ;
}

function ul($class=""){
	return new ul($class) ;
}

class ul{
	protected $tag = '';
	
	function __construct($class="") {
		if( !empty($class) )
			$class = ' class="'.$class.'"' ;
		$this->tag = '<ul '.$class.'>'.newline() ;
	}
	function li($s){
		$this->tag .= tab()."<li>".$s."</li>".newline() ;
		return $this ;
	}
	function end()
	{
		$this->tag .= '</ul>'.newline() ;
		return $this->tag ;
	}
}
class ol extends ul{
	function __construct($class="") {
		if( !empty($class) )
			$class = ' class="'.$class.'"' ;
		$this->tag = '<ol '.$class.'>'.newline() ;
	}
	function end()
	{
		$this->tag .= '</ol>'.newline() ;
		return $this->tag ;
	}
}