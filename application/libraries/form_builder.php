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

	public $header_map=array();
	public $data_map=array();
	public $bulk_input=false;

	public $html='';
	public $bricks=array(
		'breadcrum_bar'=>'',
		'header_content'=>'',
		'table_header'=>'',
		'table_body'=>'',
		'header_content_end'=>'',
	);
	public $bricks_form=array(
		'breadcrum_bar'=>'',
		'header_content'=>'',
		'table_header'=>'',
		'table_body'=>'',
		'header_content_end'=>'',
	);

	

	public function init($model, $controller_id, $uri_string) {
		$this->module_page=$uri_string;
		$this->list_view=$uri_string.'/'.$model.'/list_view';
		$this->form_view=$uri_string.'/'.$model.'/form_view';

		return true;
	}

	public function mapping($attributes, $data_table, $auto_build_mapping=true){
		$this->data_map=$data_table;
		// table header
		$pk='';
		foreach ($attributes as $model_key => $model_value) {
			if(array_key_exists('display', $model_value) AND $model_value['display']){
				$this->header_map[$model_key]=array(
					// 'data'=>$model_key,
					'label'=>$model_value['label'],
					// 'sortable'=>array_key_exists('sortable', $model_value)? $model_value['sortable'] : false,
					// 'alias'=>''
				);
			}
			if(array_key_exists('primary_key', $model_value) AND $model_value['primary_key']){
				$pk.=empty($pk)? $model_key : '|'.$model_key;
			}
		}
		$this->header_map['action']=array(
			'data'=>$pk,
			'label'=>'Action',
			// 'sortable'=>false,
		);


		// list data
		foreach ($data_table as $data_key => $data_value) {
			unset($data_table[$data_key][CREATE_BY]);
			unset($data_table[$data_key][CREATE_DATE]);
			unset($data_table[$data_key][UPDATE_BY]);
			unset($data_table[$data_key][UPDATE_DATE]);

			$data_table[$data_key]['action']='<a href="#" class="btn btn-secondary btn-sm btn-info">Detail</a>';
		}
		$this->data_map=$data_table;

		if($auto_build_mapping){
			$this->datatable();
		}

		return true;
	}

	public function datatable(){
		// breadcrum bar
		$this->bricks['breadcrum_bar'].='<div class="section-header">
		<h1 class="section-title">DataTables</h1>&nbsp&nbsp&nbsp
		<a href="#" class="btn btn-icon icon-left btn-primary"><i class="fa fa-plus" style="font-size: smaller;"></i> Add</a>
		<div class="section-header-breadcrumb">
		<div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
		<div class="breadcrumb-item"><a href="#">Modules</a></div>
		<div class="breadcrumb-item">DataTables</div>
		</div>
		</div>';

		// header content
		$this->bricks['header_content'].='<div class="section-body">
		<div class="row">
		<div class="col-12">
		<div class="card  card-primary">
		<div class="card-body">
		<div class="table-responsive">
		<table class="table table-striped" id="table-2">';

		// table header
		$this->bricks['table_header'].='<thead><tr>';

		if($this->bulk_input){
			$this->bricks['table_header'].='<th class="text-center">
			<div class="custom-checkbox custom-control">
			<input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad" class="custom-control-input" id="checkbox-all">
			<label for="checkbox-all" class="custom-control-label">&nbsp;</label>
			</div>
			</th>';	
		}

		$this->bricks['table_header'].='<th style="display:none;">X</th><th style="display:none;">X</th><th style="display:none;">X</th><th style="display:none;">X</th>';  // bugs.. datatable wont sort 1,3,4 column

		// column header
		foreach ($this->header_map as $header_val) {
			$this->bricks['table_header'].='<th>'.$header_val['label'].'</th>';
		}
		// end of table header
		$this->bricks['table_header'].='</tr></thead>';

		// table body
		$this->bricks['table_body'].='<tbody>';

		// row body
		foreach ($this->data_map as $data_key => $data_value) {
			$this->bricks['table_body'].='<tr>';
			if($this->bulk_input){
				$this->bricks['table_body'].='<td  class="text-center">
				<div class="custom-checkbox custom-control">
				<input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="checkbox-1">
				<label for="checkbox-1" class="custom-control-label">&nbsp;</label>
				</div>
				</td>';
			}

			$this->bricks['table_body'].='<td style="display:none;"></td><td style="display:none;"></td><td style="display:none;"></td><td style="display:none;"></td>'; // bugs.. datatable wont sort 1,3,4 column

			foreach ($this->header_map as $header_key => $header_val) {
				$this->bricks['table_body'].='<td>'.$data_value[$header_key].'</td>';
			}
			$this->bricks['table_body'].='</tr>';
		}
		

		// end of table body
		$this->bricks['table_body'].=' <tbody>';

		// end of header content
		$this->bricks['header_content_end'].='</table></div></div>
		</div></div></div></div>';

		return $this->bricks;
	}

	public function build(){
		foreach ($this->bricks as $bricks_val) {
			$this->html.=$bricks_val;
		}
		return $this->html;
	}

	public function form(){

	}


}


?>