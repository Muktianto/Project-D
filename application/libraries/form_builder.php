<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Form_builder 
{
	public $attributes=array();

	// default table
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

	public $primary_key=array();
	public $current_primary_key=array();
	public $current_primary_key_str='';

	public $front_action=false;
	public $header_map=array();
	public $data_map=array();
	public $bulk_input=false;

	public $html='';

	// made bricks and bricks_form to show the differences of them
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
		'content'=>'',
		'header_content_end'=>'',
	);

	

	public function init($model, $controller_id, $uri_string) {
		$this->module_page=$uri_string;
		// $this->list_view=$uri_string.'/'.$model.'/list_view';
		// $this->form_view=$uri_string.'/'.$model.'/form_view';

		return true;
	}

	

	// generate rows-map from model's attributes and its data
	public function mapping($attributes, $data_table, $auto_build_mapping=true){
		$this->data_map=$data_table;
		// table header
		foreach ($attributes as $model_key => $model_value) {
			if(array_key_exists('display', $model_value) AND $model_value['display']){
				$this->header_map[$model_key]= $model_value;
				// $this->header_map[$model_key]=array(
				// 	// 'data'=>$model_key,
				// 	'label'=>$model_value['label'],

				// 	// 'sortable'=>array_key_exists('sortable', $model_value)? $model_value['sortable'] : false,
				// 	// 'alias'=>''
				// );
			}
			if(array_key_exists('primary_key', $model_value) AND $model_value['primary_key']){
				$this->primary_key[]=$model_key;
			}


		}

		// action column location
		$action_col=array(
			'data'=>$this->primary_key,
			'label'=>'Action',
			'width'=>100,
		);
		if($this->front_action){
			$header_map['action']=$action_col;
			$this->header_map=array_merge($header_map,$this->header_map);
		}else{
			$this->header_map['action']=$action_col;
		}
		// end of action column location
		// end of table header


		// list data
		foreach ($data_table as $data_key => $data_value) {
			$this->current_primary_key_str='';
			unset($data_table[$data_key][CREATE_BY]);
			unset($data_table[$data_key][CREATE_DATE]);
			unset($data_table[$data_key][UPDATE_BY]);
			unset($data_table[$data_key][UPDATE_DATE]);

			foreach ($this->primary_key as $pk_key) {
				// $this->current_primary_key[$pk_key]=$data_value[$pk_key];
				$this->current_primary_key_str .= empty($this->current_primary_key_str) ? $data_value[$pk_key] : '|'.$data_value[$pk_key];

			}

			// $data_table[$data_key]['action']='<a href="#" class="btn btn-secondary btn-sm btn-info">Detail</a>';
			// $data_table[$data_key]['action']=$this->update_link().' '.$this->delete_link();
			$action_buttons=$this->update_link().$this->delete_link();
			// $data_table[$data_key]['action']=$this->update_link().$this->delete_link();

			if($this->front_action){
				$header_map_token['action']=$action_buttons;
				$data_table[$data_key]=array_merge($header_map_token,$data_table[$data_key]);
			}else{
				$data_table[$data_key]['action']=$action_buttons;
			}
		}

		$this->data_map=$data_table;


		
		// debug($this->header_map);

		if($auto_build_mapping){
			$this->datatable();
		}

		return true;
	}

	public function update_link($key='', $label='View', $color='info', $icon='edit', $icon_loc='left'){
		$key=empty($key)?$this->current_primary_key_str:$key;
		return ' <a href="'.site_url($this->module_page.'/update/') . encode('UPD|'.$key) .'" class="btn btn-sm btn-icon icon-'.$icon_loc.' btn-outline-'.$color.'"><i class="fas fa-'.$icon.'"></i> '.$label.'</a>';

		// return '<a href="'.site_url('admin/module/view') . '/' . '$isi[]' .'" class="label label-'.$color.'" data-placement="left" data-toggle="tooltip" title="'.$label.'">ssssssssss<span class="fa fa-'.$icon.'"></span></a>';
	}

	public function delete_link($key=''){
		$key=empty($key)?$this->current_primary_key_str:$key;
		return ' <a href="'.site_url($this->module_page.'/delete/') . encode('DEL|'.$key) .'" class="btn btn-sm btn-icon icon-left btn-outline-danger"><i class="fas fa-trash"></i> Delete</a>';
	}

	public function breadcrum($name, $button=''){
		$this->bricks['breadcrum_bar'].='<div class="section-header">
		<h1 class="section-title">'.$name.'</h1>'.$button.'
		<div class="section-header-breadcrumb">
		<div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
		<div class="breadcrumb-item"><a href="#">Modules</a></div>
		<div class="breadcrumb-item">DataTables</div>
		&nbsp;&nbsp;&nbsp;&nbsp;<a href="'.  site_url($this->module_page).'"><span class="badge badge-primary"><i class="fa fa-sync-alt"></i></span></a>
		</div>
		</div>';
	}

	public function datatable(){
		// breadcrum bar
		$add_button='&nbsp&nbsp&nbsp<a href="'.  site_url($this->module_page.'/create/').'" class="btn btn-icon icon-left btn-primary"><i class="fa fa-plus" style="font-size: smaller;"></i> Create</a>';
		$this->breadcrum('MODULE NAME',$add_button);

		// header content
		$this->bricks['header_content'].='<div class="section-body">
		<div class="row">
		<div class="col-12">
		<div class="card  card-primary">
		<div class="card-body">
		<div class="table-responsive">
		<table class="table table-striped" id="table-2" style="white-space: nowrap">';

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

		$this->bricks['table_header'].='<th style="display:none;">X</th><th style="display:none;">X</th><th style="display:none;">X</th><th style="display:none;">X</th>';  // BUG.. datatable wont sort 1,3,4 column

		// column header
		foreach ($this->header_map as $header_val) {
			$width=!empty($header_val['width'])?' width="'.$header_val['width'].'"' : '';
			$this->bricks['table_header'].='<th'.$width.'>'.$header_val['label'].'</th>';
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

			$this->bricks['table_body'].='<td style="display:none;"></td><td style="display:none;"></td><td style="display:none;"></td><td style="display:none;"></td>'; // BUG.. datatable wont sort 1,3,4 column

			foreach ($this->header_map as $header_key => $header_val) {
				// DEBUG
				$align=!empty($header_val['align'])?' align="'.$header_val['align'].'"':'';
				$this->bricks['table_body'].='<td'.$align.'>'.(empty($data_value[$header_key]) ? $header_key :$data_value[$header_key]).'</td>';
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

	public function build($form=false){
		foreach ($this->bricks as $bricks_val) {
			$this->html.=$bricks_val;
		}
		return $this->html;
	}

	public function form($data=null){
		// breadcrum bar
		$this->breadcrum('Create MODULE NAME');

		// header content
		$this->bricks_form['header_content'].='<div class="section-body"><form class="needs-validation" novalidate=""><div class="row">';

		// content
		$this->bricks_form['content']='';

		// end of header content
		$this->bricks_form['header_content_end'].='</div></form></div>';

	}


}


?>