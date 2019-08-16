<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller{


	public function index()
	{

		$data['start']=microtime(true);
		// $data['debug']='template/v_add';
		$data['debug']='template/v_content';
		// $x=$this->auto_global->get_session();
		// $x=$this->get_sessionX();
		// echo $x;exit();
		$this->load->view('template/v_admin_layout',$data);


	}
}
