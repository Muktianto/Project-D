<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Blg_Tag extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('blog/m_tag', 'tag');
        $this->load->library('form_builder');

        // hardcode or using segment
        $module_page = $this->uri->segment(1) . '/' . $this->uri->segment(2) . '/';
        $this->form_builder->init('tag', 'blg_tag', $module_page);
    }

    public function index()
    {
        // preparing
        $data_table = $this->tag->get_data();
        // processing
        $this->form_builder->mapping($this->tag->attributes, $data_table);
        // rendering
        $this->load->view($this->form_builder->admin_temp, array(
            'data' => $this->form_builder->build(),
            'flash_data' => $this->session->flashdata(),
            // 'flash_data' => 'x',
        ));
    }

    public function create()
    {
        $post = $this->input->post();
        if (!empty($post))
            $this->tag->save($post);

        // preparing & processing
        $this->form_builder->form($this->tag->attributes);
        // rendering
        $this->load->view($this->form_builder->admin_temp, array(
            'data' => $this->form_builder->build_form(),
        ));
    }

    public function create_debug()
    {
        $this->load->view('template/v_admin_layout', array(
            'start' => microtime(true),
            'title' => 'Create Tag',
            'content' => $this->form_builder->build(),
            'sub_content' => null,
            'debug' => 'template/v_add',
        ));
    }

    public function update($id = null)
    {

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

    public function delete($id = null)
    {
        if (!isset($id)) show_404();

        if ($this->m_tag->delete($id)) {
            redirect(site_url('admin/tag/list'));
        }
    }


    // -------------------------- TEST 
    public function login()
    {
        $user_session = array(
            'user_id' => '$user_data->user_id',
            'username' => '$user_data->username',
            'fullname' => '$user_data->fullname',
            'image' => '$user_data->image',
            'role' =>  '$this->get_user_role($user_data->user_id)'
        );
        $this->session->set_userdata($user_session);

        $notif = array(
            'a' => array(
                'title' => 'Meh..',
                'message' => 'Saving Failed',
                'status' => 'error',
            ),
            'b' => array(
                'title' => 'Meh..',
                'message' => 'Saving Failed',
                'status' => 'error',
            ),
        );
        $this->session->set_flashdata($notif);

        echo 'login';
    }

    public function cek()
    {
        debug($this->session->all_userdata());
    }

    public function logout()
    {
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('fullname');
        $this->session->unset_userdata('image');
        $this->session->unset_userdata('role');
        // $this->index();
        $x = $this->session->flashdata();
        debug($x);
        echo 'logout';
    }
    // -------------------------- end of TEST 

}
