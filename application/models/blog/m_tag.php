<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_tag extends CI_Model {

	public $table='blg_tag';
	public $attributes=array();

	public function rules(){
		return array(
			'tag_id'=>array(
				'input' => 'hidden',
				'primary_key' => true,
				'label'=>'Tag ID',
			),
			'tag_name'=>array(
				'input'=>'text',
				'label'=>'Tag Name',
				'validation'=>'required',
			),
		);
	}

	public function get_all(){
		return $this->db->get($this->table)->result_array();
	}

	public function get_by_id($id){
		return $this->db->get_where($this->table,array("product_id" => $id))->row();
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
