<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blg_Tag extends CI_Controller {

    public function __construct(){
      parent::__construct();

      $this->load->model('blog/m_tag','tag');
      $this->load->library('form_builder');

      $this->form_builder->init('tag','blg_tag', $this->uri->uri_string);
  }

  public function index() {
    // preparing
    $data_table=$this->tag->get_all();
    // processing
    $this->form_builder->mapping($this->tag->attributes, $data_table);
    // rendering
    $this->load->view($this->form_builder->admin_temp, array(
        'data'=>$this->form_builder->build(),
        // 'debug'=>'template/v_content',
    ));
}

public function create(){
    // processing
    $this->form_builder->mapping($this->tag->attributes, $data_table);
    // rendering
    $this->load->view($this->form_builder->admin_temp, array(
        'data'=>$this->form_builder->build_form(),
    ));
}

public function create_debug(){ //delete later
    // $data=array(
    //     'start'=>microtime(true),
    //     'title'=>'Tag',
    //     'content'=>$this->form_builder->form(),
    //     'sub_content'=>null,
    // );
    // $this->load->view($this->form_builder->admin_temp, $data);
    // $data['start']=microtime(true);
    // $data['debug']='template/v_add';
        // $data['debug']='template/v_content';
        // $x=$this->auto_global->get_session();
        // $x=$this->get_sessionX();
        // echo $x;exit();
    $this->load->view('template/v_admin_layout', array(
        'start'=>microtime(true),
        'title'=>'Create Tag',
        'content'=>$this->form_builder->build(),
        'sub_content'=>null,
        'debug'=>'template/v_add',
    ));

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
