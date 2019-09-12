<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_tag extends CI_Model
{
	public $table = 'blg_tag';
	public $primary_key;
	public $attributes = array();

	public function __construct()
	{
		$this->attributes = array(
			'tag_id' => array(
				'input' => 'hidden',
				'primary_key' => true,
				'label' => 'Tag ID',
				'align' => 'right',
				'show_datatable' => true,
				'auto_increment' => true,
			),
			'tag_name' => array(
				'input' => 'text',
				'label' => 'Tag Name',
				'validation' => array('required'),
				'show_datatable' => true,
				// 'value' => 'AAA',
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
		return $this->db->select('tag_id,tag_name')
			->order_by('create_date desc')
			->get($this->table)->result_array();
	}

	public function save($data)
	{
		// save_array, update_array generate mapped array between attributes and data
		$this->db->insert($this->table, save_array($this->attributes, $data));
		// check_save, check_update, check_delte generate toast message
		$this->session->set_flashdata(check_save($this->db->affected_rows()));
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

	public function update()
	{
		$post = $this->input->post();
		$this->tag_id = $post['tag_id'];
		$this->tag_name = $post['tag_name'];

		$this->db->update($this->table, $this, array('product_id' => $post['tag_id']));
	}
}
