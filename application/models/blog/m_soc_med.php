<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_soc_med extends CI_Model
{
    public $table = 'blg_soc_med';
    public $primary_key;
    public $attributes = array();

    public function __construct()
    {
        $this->attributes = array(
            'soc_med_id' => array(
                'input' => 'hidden',
                'primary_key' => true,
                'label' => 'Soc Med ID',
                'align' => 'right',
                'show_datatable' => true,
                'auto_increment' => true,
                'group' => 1,
            ),
            'soc_med_name' => array(
                'input' => 'text',
                'label' => 'Soc Med',
                'validation' => array('required'),
                'show_datatable' => true,
                'group' => 2,
                'column' => 1,
            ),
            'link' => array(
                'input' => 'text',
                'label' => 'Link',
                'validation' => array('required'),
                'show_datatable' => true,
                'group' => 3,
            ),
            'fa_icon' => array(
                'input' => 'text',
                'label' => 'Fa Icon',
                'validation' => array('required'),
                'show_datatable' => true,
                'group' => 1,
            ),
            'status' => array(
                'input' => 'text',
                'label' => 'Status',
                'validation' => array('required'),
                'show_datatable' => true,
                'group' => 2,
                'column' => 2,
            ),
            CREATE_BY => array(
                'value' => null, // $this->data->get_session('user_id'),
                'show_form' => false,
            ),
            CREATE_DATE => array(
                'value' => date('Y-m-d H:i:s'),
                'show_form' => false,
            ),
            UPDATE_BY => array(
                'value' => null, // $this->data->get_session('user_id'),
                'show_form' => false,
            ),
            UPDATE_DATE => array(
                'value' => date('Y-m-d H:i:s'),
                'show_form' => false,
            ),
        );
    }

    public function get_data()
    {
        return $this->db->get($this->table)->result_array();
    }

    public function save($data)
    {
        // save_array, update_array generate mapped array between attributes and data
        $this->db->insert($this->table, save_array($this->attributes, $data));
        // check_save, check_update, check_delte generate toast message
        $this->session->set_flashdata(check_save($this->db->affected_rows()));
    }

    public function get_by_id($id_param)
    {
        // validate if it has correct action prefix and exit in table
        $valid = $this->validate->update($this->attributes, $id_param, $this->table);
        if (!$valid) {
            return false;
        }
        // get data
        return $this->data->get_by_id($this->attributes, $id_param, $this->table);
    }

    public function update($data)
    {
        // ---------- PENDING !!!!!!! write validate to update here, waiting user-role-action module
        // save_array, update_array generate mapped array between attributes and data
        $this->db->update($this->table, $data, update_array($this->attributes, $data));
        // check_save, check_update, check_delte generate toast message
        $this->session->set_flashdata(check_update($this->db->affected_rows()));
    }

    public function delete($id_param)
    {
        // validate if it has correct action prefix
        $valid = $this->validate->delete($this->attributes, $id_param);
        if ($valid) {
            // delete_array provide the 'where' statement
            $this->db->delete($this->table, delete_array($this->attributes, $id_param));
            // check_save, check_update, check_delte generate toast message
            $this->session->set_flashdata(check_delete($this->db->affected_rows()));
        }
    }
}
