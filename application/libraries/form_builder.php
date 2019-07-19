<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Form_builder 
{
	public $attributes=array();

	private $access_table='sso_access';
	private $application_table='sso_application';
	private $module_table='sso_module';
	private $group_table='sso_group';
	private $group_access_table='sso_group';
	private $menu_table='sso_menu';
	private $user_table='sso_user';
	private $user_application_table='sso_user_application';
	private $user_group_table='sso_user_group';

	public $admin_temp='template/v_admin_layout';
	public $module_page='';
	public $list_view='';
	public $form_view='';

	public function init($model, $controller_id, $uri_string) {
		$this->module_page=$uri_string;
		$this->list_view=$uri_string.'/'.$model.'/list_view';
		$this->form_view=$uri_string.'/'.$model.'/form_view';

		return true;
	}

	public function datatable($data){
		// echo $this->tag->table;
		exit('END');
		// $this->load->view("template/v_admin_layout", $data);
	}
}


?>