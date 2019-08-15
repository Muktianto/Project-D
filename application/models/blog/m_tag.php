<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_tag extends CI_Model {

	public $table='blg_tag';
	public $primary_key;
	public $attributes=array();

	public function __construct(){
		$this->attributes= array(
			'tag_id'=>array(
				'input' => 'hidden',
				'primary_key' => true,
				'label'=>'Tag ID',
				'display'=>true,
				'align'=>'right',
			),
			'tag_name'=>array(
				'input'=>'text',
				'label'=>'Tag Name',
				'validation'=>'required',
				// 'sortable'=> true,
				'display'=>true,
			),
			// 'dummy_1'=>array(
			// 	'input'=>'text',
			// 	'label'=>'dummy_1 Name',
			// 	'validation'=>'required',
			// 	// 'sortable'=> true,
			// 	'display'=>true,
			// 	'group'=>2,
			// ),
			// 'dummy_2'=>array(
			// 	'input'=>'text',
			// 	'label'=>'dummy_2 Name',
			// 	'validation'=>'required',
			// 	// 'sortable'=> true,
			// 	'display'=>true,
			// 	'group'=>2,
			// ),
			// 'dummy_3'=>array(
			// 	'input'=>'text',
			// 	'label'=>'dummy_3 Name',
			// 	'validation'=>'required',
			// 	// 'sortable'=> true,
			// 	'display'=>true,
			// 	'group'=>3,
			// ),
			// 'dummy_4'=>array(
			// 	'input'=>'text',
			// 	'label'=>'dummy_3 Name',
			// 	'validation'=>'required',
			// 	// 'sortable'=> true,
			// 	'display'=>true,
			// 	'group'=>3,
			// ),
			CREATE_BY=>array(
				'value'=>$this->data->get_session('user_id'),
			),
			CREATE_DATE=>array(
				'value'=>date('Y-m-d H:i:s'),
			),
			UPDATE_BY=>array(
				'value'=>$this->data->get_session('user_id'),
			),
			UPDATE_DATE=>array(
				'value'=>date('Y-m-d H:i:s'),
			),
		);
	}

	public function get_all(){
		// debug($this->data->get_session());
		return $this->db->get($this->table)->result_array();
	}

	public function get_by_id($id){
		return $this->data->build($this->table, $id);
	}

	public function save(){
		$post=$this->input->post();
		$this->tag_id=$post['tag_id'];
		$this->tag_name=$post['tag_name'];

		$this->db->insert($this->table,$this);
	}

	public function update(){
		$post=$this->input->post();
		$this->tag_id=$post['tag_id'];
		$this->tag_name=$post['tag_name'];

		$this->db->update($this->table, $this, array('product_id'=>$post['tag_id']));
	}

	public function delete($id){
		return $this->db->delete($this->table, array('product_id'=>$post['tag_id']));
	}
}
