<?php

/**
 * Description of publicVar
 *
 * @author jinwoo
 */
class publicVar {

	public $title ;
	public $script;
	function __construct($varObj) {
		foreach($varObj as $k => $v )
			$this->$k = $v ;
	}
}
