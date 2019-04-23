<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function index()
	{
		$data['start']=microtime(true);
		$this->load->view('template/v_admin_temp',$data);
	}
}
