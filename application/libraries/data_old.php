<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Data_old
{

	public function __construct()
	{
		$this->CI = &get_instance();
	}

	private $login_page = 'admin/login/index/';
	private $application_table = 'application';
	private $module_table = 'module';
	private $variable_table = 'variable';
	private $role_module_table = 'role_module';

	public function save($table, $data)
	{ //feel ur ur life is useless? see these short functions
		$this->CI->db->insert($table, $data);
	}

	public function save_batch($table, $data_batch)
	{
		$this->CI->db->insert_batch($table, $data_batch);
	}

	public function read($table, $field = NULL, $where = NULL, $order = NULL)
	{
		$field = (empty($field)) ? '*' : $field;
		$where = (empty($where)) ? '' : $where;
		$order = (empty($order)) ? '' : $order;

		$this->CI->db->select("$field")
			->from($table);

		if (!empty($order)) {
			$this->CI->db->order_by($order);
		}

		return $this->CI->db->where($where)
			->get()->result_array();
	}

	public function build($table, $id)
	{
		$this->CI->db->select('*')
			->from($table)
			->where($where);
		return $this->CI->db->get()->row_array();
	}

	public function update($table, $data, $where)
	{
		$this->CI->db->update($table, $data, $where);
	}

	public function delete($table, $data)
	{
		$data = array(
			'flag_del' => 1,
			'modi_by' => $this->get_session('user_id'),
			'modi_time' => date('Ymdhis')
		);

		$this->CI->db->where($table . '_id', $id)
			->update($table, $data);
	}

	public function remove($table, $filter)
	{
		// [MINOR]
		// use remove function after master data without cascade delete
		// module which use this function such as user_role_module
		$this->CI->db->where($filter)
			->delete($table);
	}

	public function generate_id($prefix, $table, $len)
	{
		//        echo "$prefix, $table, $len";
		//        exit();
		$id = $this->CI->db->query('SELECT MAX(' . $table . '_id) as id FROM ' . $table)->row()->id;
		$new_id = $prefix;
		if (empty($id)) {
			for ($i = 1; $i < $len; $i++) {
				$new_id .= '0';
			}
			$new_id .= '1';
		} else {
			$init = explode($prefix, $id);
			$num_id = $init[1] + 1;
			for ($i = 1; $i <= ($len - strlen($num_id)); $i++) {
				$new_id .= '0';
			}
			$new_id .= $num_id;
		}
		return $new_id;
	}

	public function generate_option($table, $value, $label, $where = '')
	{
		$where = (empty($where) ? 'flag_del=0' : 'flag_del=0 AND ' . $where);
		return $this->CI->db->select("$value, $label")
			->from($table)
			->where($where)
			->order_by($value)
			->get()->result_array();
	}

	public function master_message($message)
	{
		switch ($message) {
			case CREATED:
				return $this->alert('Data is successfully created', 'success');
			case UPDATED:
				return $this->alert('Data is successfully updated', 'success');
			case DELETED:
				return $this->alert('Data is successfully deleted', 'danger');
			case FAIL:
				return $this->alert('Invalid method', 'danger');
			default:
				return NULL;
		}
	}

	// END MASTER DATA
	// 
	// START VALIDATIONS

	public function filter_validation($id)
	{
		$type = substr($id, 0, 1);
		$prefix = $this->read($this->variable_table, 'value', "name='Prefix_Table'");
		$value = explode(',', $prefix[0]['value']);
		$array = array();
		foreach ($value as $val) {

			$temp = explode(':', $val);
			$temp_array = array(
				'prefix' => $temp[0],
				'value' => $temp[1]
			);
			array_push($array, $temp_array);
		}
		foreach ($array as $check) {
			if ($type == $check['prefix']) {
				return ($this->if_exist($id, $check['value'])) ? TRUE : FALSE;
			}
		}
		return FALSE;
	}

	public function if_exist($id, $table)
	{
		$this->CI->db->select($table . '_id')
			->from($table)
			->where('flag_del', 0)
			->where($table . '_id', $id);
		return ($this->CI->db->get()->num_rows() != 0) ? TRUE : FALSE;
	}

	public function authentication()
	{
		// [MINOR]
		// havent use any user-modul/function
		if (!array_key_exists('user_id', $this->get_session())) {
			redirect($this->login_page . FORBIDDEN);
		}

		//        var_dump(site_url(uri_string()));
		//        var_dump($this->CI->uri->segment(1));
		//        var_dump($this->CI->router->fetch_class());
		//        var_dump($this->CI->router->fetch_method());
		//        exit();
		//
		//        $filter = '';
		//        $this->CI->db->select('rm.module_id')
		//                ->from($this->role_module_table . ' rm')
		//                ->join($this->module_table . ' m', 'm.module_id=rm.module_id')
		//                ->where('m.module_id')
		//                ->get()->row();
	}

	public function get_user_application($where)
	{
		return $this->CI->db->distinct()->select('a.application_id,'
			. ' a.name, a.controller, a.icon')
			->from($this->application_table . ' a')
			->join($this->module_table . ' m', 'm.application_id=a.application_id')
			->join($this->role_module_table . ' rm', 'rm.module_id=m.module_id')
			->where($where)
			->order_by('a.name')
			->get()->result_array();
	}

	public function get_user_module($where)
	{
		return $this->CI->db->select('m.module_id, m.application_id, m.parent_id,'
			. ' m.name, m.controller, m.icon')
			->from($this->module_table . ' m')
			->join($this->role_module_table . ' rm', 'rm.module_id=m.module_id')
			->where($where)
			->order_by('m.name')
			->get()->result_array();
	}

	public function get_user_sub_module($module)
	{
		$where = '';
		foreach ($module as $parent) {
			$where .= (empty($where)) ? 'parent_id=' . "'" . $parent['module_id'] . "'" : 'OR parent_id=' . "'" . $parent['module_id'] . "'";
		}
		return $this->CI->db->select('module_id, parent_id,'
			. 'name, controller, icon')
			->from($this->module_table)
			->where($where)
			->order_by('name')
			->get()->result_array();
	}

	public function get_user_menu($id = '', $table = '', $redirect_page = '')
	{
		$this->authentication();
		if (!empty($id) && !empty($table) && !empty($redirect_page)) {
			(!$this->if_exist($id, $table)) ? redirect($redirect_page . FAIL) : NULL;
		}
		// [MINOR]
		// validation : on module, if controller='' : parent
		// make sure validation work, javascript on master module
		$where = '';
		foreach ($this->get_session('role') as $role) {
			$where .= (empty($where)) ? 'rm.role_id=' . "'" . $role['role_id'] . "'" : 'OR rm.role_id=' . "'" . $role['role_id'] . "'";
		}
		$module = $this->get_user_module($where);
		return array(
			'application' => $this->get_user_application($where),
			'module' => $module,
			'sub_module' => $this->get_user_sub_module($module)
		);
	}

	// END VALIDATION
	// 
	// START SNIPPETS
	public function get_session($key = '')
	{
		$session = $this->CI->session->all_userdata();
		if (!empty($key)) {
			return (isset($session[$key])) ? $session[$key] : NULL;
		}
		return $session;
	}

	public function alert($message, $type = 'info', $dismiss = TRUE)
	{
		$dismiss_btn = ($dismiss) ? '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>' : '';
		return '<p><div class="alert alert-' . $type . ' text-center alert-dismissable">'
			. $dismiss_btn . $message .
			'</div>';
	}

	public function encrypt($data)
	{
		return strrev(str_replace('=', '_', base64_encode('immi2012' . $data)));
	}

	public function decrypt($data)
	{
		$decrypted = explode('immi2012', base64_decode(str_replace('_', '=', strrev($data))));
		return $decrypted[1];
	}

	public function random_str($len = 5)
	{
		return substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $len);
	}

	// END SNIPPETS
}
