<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blg_Tag extends CI_Controller {

    private $attributes;

    public function __construct(){
      parent::__construct();

      $this->load->model('blog/m_tag','tag');
      $this->load->library('form_builder');

      $this->form_builder->init('tag','blg_tag', $this->uri->uri_string);
  }

  public function index() {
    $data_table=$this->tag->get_all();
    // debug($data_table);
    $this->form_builder->mapping($this->tag->attributes, $data_table);
    // debug($this->form_builder->build());

    $data=array(
        'start'=>microtime(true),
        'title'=>'Tag',
        'content'=>$this->form_builder->build(),
        'sub_content'=>null,
    );
    $this->load->view($this->form_builder->admin_temp, $data);
}

public function create(){
    $data=array(
        'start'=>microtime(true),
        'title'=>'Tag',
        'content'=>$this->form_builder->form(),
        'sub_content'=>null,
    );
    $this->load->view($this->form_builder->admin_temp, $data);

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


    // -------------------------- TEST 
public function login(){
    $user_session = array(
        'user_id' => '$user_data->user_id',
        'username' => '$user_data->username',
        'fullname' => '$user_data->fullname',
        'image' => '$user_data->image',
        'role'=>  '$this->get_user_role($user_data->user_id)'
    );
    $this->session->set_userdata($user_session);
    echo 'login';
}

public function cek(){
    debug($this->session->all_userdata());
}

public function logout(){
    $this->session->unset_userdata('user_id');
    $this->session->unset_userdata('username');
    $this->session->unset_userdata('fullname');
    $this->session->unset_userdata('image');
    $this->session->unset_userdata('role');
        // $this->index();
    echo 'logout';
}
    // -------------------------- end of TEST 

}
