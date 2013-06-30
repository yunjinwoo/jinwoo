<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Blog extends CI_Controller {

	public function index()
	{
		$this->view();
	}
	
	public function test($a,$a1)
	{
		$this->view();
	}
	
	public function view()
	{
		$this->layout->view('welcome_message');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */