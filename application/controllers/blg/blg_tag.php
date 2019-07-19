<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blg_Tag extends CI_Controller {

    private $attributes;

    public function __construct(){
      parent::__construct();

      $this->load->model('blog/m_tag','tag');
      $this->load->library('form_builder');

      $this->form_builder->init('tag','blg_tag',$this->uri->uri_string);
  }

  public function index(){
    $data=array(
        'start'=>microtime(true),
        'title'=>'Tag',
        'data'=>$this->tag->get_all(),
        'content'=>null,
        'sub_content'=>null,
    );
    $this->form_builder->datatable($data);
    $this->debug($data);
		// $this->load->view("template/v_admin_layout", $data);
}

public function add(){
    $this->form_validation->set_rules($this->m_tag->rules());

    if ($this->form_validation->run()) {
        $this->m_tag->save();
        $this->session->set_flashdata('success', 'Berhasil disimpan');
    }

    $this->load->view("admin/tag/new_form");
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

    $this->load->view("admin/tag/edit_form", $data);
}

public function delete($id=null)
{
    if (!isset($id)) show_404();

    if ($this->m_tag->delete($id)) {
        redirect(site_url('admin/tag/list'));
    }
}

}
