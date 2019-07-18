<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {


	public function index()
	{
		echo 'index';exit();

		$data['start']=microtime(true);
		$x=$this->auto_global->get_session();
		echo $x;exit();
		$this->load->view('template/v_admin_temp',$data);


	}
}
