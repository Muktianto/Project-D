<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Blg_Post extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('blog/m_post', 'post');
        $this->load->library('form_builder');

        $this->form_builder->init('post', 'blg_post', $this->uri->uri_string);
    }

    public function index()
    {
        // preparing
        $data_table = $this->post->get_data();
        // processing
        $this->form_builder->mapping($this->post->attributes, $data_table);
        // rendering
        $this->load->view($this->form_builder->admin_temp, array(
            'data' => $this->form_builder->build(),
        ));
    }

    public function create()
    {
        // // preparing attributes
        // $this->form_builder->dev_structure($this->tag->attributes);

        // processing
        $this->form_builder->form($this->post->attributes);
        // rendering
        $this->load->view($this->form_builder->admin_temp, array(
            'data' => $this->form_builder->build_form(),
        ));
    }
}
