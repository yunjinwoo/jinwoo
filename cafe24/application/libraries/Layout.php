<?php
/*
 * 
 * 질문 : http://www.cikorea.net/qna/view/9946/page/1/q/include
 * 
 * 
 * https://github.com/EllisLab/CodeIgniter/wiki/layout-library
 * 
 * Loading the library
 *
 * You can use it in two ways. First and obvious is to place the following line in the controller's constructor function.
 * 
 * $this->load->library('layout', 'layout_main');
 * The second is by enabling codeIgniter to autoload the library by editing /application/config/autoload.php
 * php $autoload['libraries'] = array('layout');
 * $this->layout->view('/shop/view_cart', $data);
 * 
 * 수정 : view 할때마다 내용을 가져오므로 전체적으로 쓰기는 불편한다.
 */
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Layout
{
    
    private $obj;
	
    public $preppend = "";
    public $append = "";
    public $layout = "";
    
    function Layout($layout = "layout") {
        $this->obj =& get_instance();
		$this->layout = $layout ;
    }
	
	function setLayout($layout){ $this->layout = $layout ; }

	function view_append($view, $data=null, $return=false){	$this->append .= $this->obj->load->view($view,$data,true) ;	}
	function view_preppend($view, $data=null, $return=false){ $this->preppend .= $this->obj->load->view($view,$data,true) ; }
    function view($view, $data=null, $return=false)
    {
		$loadedData = array();
        $loadedData['contents_data'] = $this->preppend.$this->obj->load->view($view,$data,true).$this->append;
        $loadedData['footer_menu'] = $this->_footer_menu($data,true);
		
		$this->header() ;
        $this->_contents($loadedData);
		$this->_footer() ;

    }
	
	function header($data=null){ $this->_header(); }	
	function footer($data=null){ $this->_footer_menu();  $this->_footer(); }
	
	private function _view($path , $data, $ret){ return $this->obj->load->view($path,$data, $ret); }	
	function _header($data=null,$ret=false){ return $this->_view($this->layout."/layout_head.html", $data, $ret) ; }	
	function _footer($data=null,$ret=false){ return $this->_view($this->layout."/layout_foot.html", $data, $ret) ; }	
	function _footer_menu($data=null,$ret=false){ return $this->_view($this->layout."/layout_foot_menu.html", $data, $ret) ; }	
	function _contents($data=null,$ret=false){ return $this->_view($this->layout."/layout_contents.html", $data, $ret) ; }
	
	/* 아직 안씀 */
	function _head_title($data=null,$ret=false){ return $this->_view($this->layout."/layout_head_title.html", $data, $ret) ; }	
	
	
}
?>
