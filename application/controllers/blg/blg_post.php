<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Blg_Post extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('blog/m_post', 'post');
        $this->load->library('form_builder');

        // hardcode or using segment
        $module_page = $this->uri->segment(1) . '/' . $this->uri->segment(2) . '/';
        $this->form_builder->init('post', 'blg_post', $module_page);

        // optional group
        $this->form_builder->form_structure = array(
            1 => array(
                'label' => 'Group 1',
                'color' => 'danger',
                'col_len' => '6',
            ),
            2 => array(
                // 'label' => 'Grasasoup 2',
                'color' => 'success',
                'col_len' => '6',
            ),
            3 => array(
                'label' => 'Grasasoup 2',
            ),
        );
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
        $post = $this->input->post();
        if (!empty($post))
            $this->post->save($post);
        // preparing & processing
        $this->form_builder->form($this->post->attributes);
        // rendering
        $this->load->view($this->form_builder->admin_temp, array(
            'data' => $this->form_builder->build_form(),
        ));
    }
}
