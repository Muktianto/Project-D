<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Blg_Tag extends CI_Controller
{
    private $module_page = '';
    public function __construct()
    {
        parent::__construct();

        $this->load->model('blog/m_tag', 'tag');
        $this->load->library('form_builder');

        // hardcode or using segment
        $this->module_page = $this->uri->segment(1) . '/' . $this->uri->segment(2) . '/';
        $this->form_builder->init('tag', 'blg_tag', $this->module_page);
    }

    public function index()
    {
        // $x = $this->session->flashdata();
        // debug($x);
        // preparing
        $data_table = $this->tag->get_data();
        // processing
        $this->form_builder->mapping($this->tag->attributes, $data_table);
        // rendering
        // debug(array(
        //     'data' => $this->form_builder->build(),
        //     'flash_data' => $this->session->flashdata(),
        // ));
        $this->load->view($this->form_builder->admin_temp, array(
            'data' => $this->form_builder->build(),
            'flash_data' => $this->session->flashdata(),
        ));
    }

    public function create()
    {
        $post = $this->input->post();
        if (!empty($post)) {
            $this->tag->save($post);
            redirect($this->module_page);
        }
        // preparing & processing
        $this->form_builder->form($this->tag->attributes);
        // rendering
        $this->load->view($this->form_builder->admin_temp, array(
            'data' => $this->form_builder->build_form(),
        ));
    }

    public function delete($id = null)
    {
        $this->tag->delete($id);
        redirect($this->module_page);
    }

    public function update($id = null)
    {
        // preparing data
        $data = $this->tag->get_by_id($id);
        if (!$data) {
            // empty data
            redirect($this->module_page);
        }
        debug($data);
        $post = $this->input->post();
        if (!empty($post)) {
            $this->tag->update($post);
            redirect($this->module_page);
        }
        // processing
        $this->form_builder->form($this->tag->attributes);
        // rendering
        $this->load->view($this->form_builder->admin_temp, array(
            'data' => $this->form_builder->build_form(),
        ));
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
            array(
                'title' => 'Meh..',
                'message' => 'Saving Failed',
                'status' => 'error',
            ),
            array(
                'title' => 'Meh..',
                'message' => 'Saving Failed',
                'status' => 'error',
            ),
        );
        $this->session->set_flashdata(array('notif' => $notif));

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
