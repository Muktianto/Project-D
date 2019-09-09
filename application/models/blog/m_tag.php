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
				// 'sortable'=> true,
			),
			CREATE_BY => array(
				'value' => $this->data->get_session('user_id'),
				'show_form' => false,
			),
			CREATE_DATE => array(
				'value' => date('Y-m-d H:i:s'),
				'show_form' => false,
			),
			UPDATE_BY => array(
				'value' => $this->data->get_session('user_id'),
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
			->get($this->table)->result_array();
	}


	public function save($data)
	{
		$this->db->insert($this->table, save_array($this->attributes, $data));
		if ($this->db->affected_rows() > 0) {
			$notif = array(
				'title' => 'Yay!',
				'message' => $this->db->affected_rows() . ' Record Saved',
				'status' => 'success',
			);
		} else {
			$notif = array(
				'title' => 'Meh..',
				'message' => 'Saving Failed',
				'status' => 'error',
			);
		}

		// $response = array($notif);

		$this->session->set_flashdata(array($notif));
	}

	public function get_by_id($id)
	{
		return $this->data->build($this->table, $id);
	}

	public function save2()
	{
		$post = $this->input->post();
		$this->tag_id = $post['tag_id'];
		$this->tag_name = $post['tag_name'];

		$this->db->insert($this->table, $this);
	}

	public function update()
	{
		$post = $this->input->post();
		$this->tag_id = $post['tag_id'];
		$this->tag_name = $post['tag_name'];

		$this->db->update($this->table, $this, array('product_id' => $post['tag_id']));
	}

	public function delete($id)
	{
		return $this->db->delete($this->table, array('product_id' => $post['tag_id']));
	}
}
