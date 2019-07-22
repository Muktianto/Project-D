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

	public $html='';
	public $breadcrum='';


	public function init($model, $controller_id, $uri_string) {
		$this->module_page=$uri_string;
		$this->list_view=$uri_string.'/'.$model.'/list_view';
		$this->form_view=$uri_string.'/'.$model.'/form_view';

		return true;
	}

	public function datatable($data_table, $model_rules, $datagrid_fields=array()){
		// breadcrum bar
		$this->html.='<div class="section-header">
		<h1>DataTables</h1>&nbsp&nbsp&nbsp
		<a href="#" class="btn btn-icon icon-left btn-success"><i class="fa fa-plus" style="font-size: smaller;"></i> Add</a>
		<div class="section-header-breadcrumb">
		<div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
		<div class="breadcrumb-item"><a href="#">Modules</a></div>
		<div class="breadcrumb-item">DataTables</div>
		</div>
		</div>';

		// header content
		$this->html.='<div class="section-body">
		<div class="row">
		<div class="col-12">
		<div class="card">
		<!-- <div class="card-header">
		<h4>Advanced Table</h4>
		<a href="#" class="btn btn-icon icon-left btn-success"><i class="fa fa-plus" style="font-size: smaller;"></i> Add</a>
		</div> -->
		<div class="card-body">
		<div class="table-responsive">
		<table class="table table-striped" id="table-2">';

		// table header
		$this->html.='<thead>
		<tr>
		<th class="text-center">
		<div class="custom-checkbox custom-control">
		<input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad" class="custom-control-input" id="checkbox-all">
		<label for="checkbox-all" class="custom-control-label">&nbsp;</label>
		</div>
		</th>';

		// column header
		if(empty($datagrid_fields)){
			foreach ($model_rules as $rules_val) {
				$column_name=!empty($rules_val['label'])? $rules_val['label'] : '-Empty-';
				$this->html.="<th>$column_name</th>";
			}

		}else{ // PENDING: required fields param to custom view

		}

		// table body
		$this->html.=' <tbody>';

		debug($data_table,false);
		debug($model_rules);
		// row body
		foreach ($data_table as $data_table_value) {
			if() sini
			unset($data_table_value['create_by']);
			unset($data_table_value['create_by']);
			unset($data_table_value['create_by']);
			unset($data_table_value['create_by']);

			$this->html.='<tr>
			<td>
			<div class="custom-checkbox custom-control">
			<input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="checkbox-1">
			<label for="checkbox-1" class="custom-control-label">&nbsp;</label>
			</div>
			</td>';

			fore
			// $this->html.='<td>'.'</td>';

			$this->html.='</tr>';
		}

		// end of table body
		$this->html.=' <tbody>';


		// end of table header
		$this->html.='</tr></thead>';

		// end of header content
		$this->html.='</table></div></div></div></div></div></div>';

		// debug($this->form_view,false);
		// debug($model_rules,false);
		// debug($data);
		// exit('END');
		// $this->load->view("template/v_admin_layout", $data);

		return $this->html;
	}




}


?>