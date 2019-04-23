<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tag extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('sso/m_tag');
	}

	public function index(){
		$data['tag']=$this->m_tag->get_all();
		$this->load->view("admin/blog/list", $data);
	}

	public function add(){
        $this->form_validation->set_rules($this->m_tag->rules());

        if ($this->form_validation->run()) {
            $this->m_tag->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

        $this->load->view("admin/blog/new_form");
	}

	public function update($id=null){

        if (!isset($id)) redirect('tag');
       
        $this->form_validation->set_rules($this->m_tag->rules());

        if ($this->form_validation->run()) {
            $this->m_tag->update();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

        $data["tag"] = $this->m_tag->getById($id);
        if (!$data["tag"]) show_404();
        
        $this->load->view("admin/blog/edit_form", $data);
	}
}
