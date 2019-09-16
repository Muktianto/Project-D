<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Blg_soc_med extends CI_Controller
{
    private $module_page = '';
    public function __construct()
    {
        parent::__construct();

        $this->load->model('blog/m_soc_med', 'soc_med');

        // hardcode or using segment
        $this->module_page = $this->uri->segment(1) . '/' . $this->uri->segment(2) . '/';
        $this->form_builder->init('soc_med', 'blg_soc_med', $this->module_page);

        // optional group
        $this->form_builder->form_structure = array(
            1 => array(
                'label' => 'Filed 1',
                'color' => 'danger',
                'col_len' => '4',
            ),
            2 => array(
                // 'label' => 'Grasasoup 2',
                'color' => 'success',
                'col_len' => '6',
            ),
            3 => array(
                'label' => 'Grasasoup 2',
                'col_len' => '9',
            ),
        );
    }

    public function index()
    {
        // preparing
        $data_table = $this->soc_med->get_data();
        // processing
        $this->form_builder->mapping($this->soc_med->attributes, $data_table);
        // rendering
        $this->load->view($this->form_builder->admin_temp, array(
            'data' => $this->form_builder->build(),
            'flash_data' => $this->session->flashdata(),
        ));
    }

    public function create()
    {
        $post = $this->input->post();
        if (!empty($post)) {
            $this->soc_med->save($post);
            redirect($this->module_page);
        }
        // preparing & processing
        $this->form_builder->form($this->soc_med->attributes);
        // rendering
        $this->load->view($this->form_builder->admin_temp, array(
            'data' => $this->form_builder->build_form(),
        ));
    }

    public function update($id = null)
    {
        $post = $this->input->post();
        if (!empty($post)) {
            $this->soc_med->update($post);
            redirect($this->module_page);
        }
        // preparing data
        $data = $this->soc_med->get_by_id($id);
        if (!$data) {
            // empty data
            redirect($this->module_page);
        }
        // processing
        $this->form_builder->form($this->soc_med->attributes, $data);
        // rendering
        $this->load->view($this->form_builder->admin_temp, array(
            'data' => $this->form_builder->build_form(),
        ));
    }

    public function delete($id = null)
    {
        $this->soc_med->delete($id);
        redirect($this->module_page);
    }
}
