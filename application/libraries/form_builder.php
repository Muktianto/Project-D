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
	public $module_name='';
	public $list_view='';
	public $form_view='';

	public $primary_key=array();
	public $current_primary_key=array();
	public $current_primary_key_str='';

	public $starter=array();
	public $config=array(
		'front_action'=>false,
		'create_buton'=>false,
		'addition_button'=>'',
	);

	public $header_map=array();
	public $data_map=array();
	public $bulk_input=false;

	public $html='';

	// made bricks and bricks_form to show the differences of them
	public $bricks=array(
		'breadcrum_bar'=>'',
		'header_content'=>'',
		'card'=>'',
		'table_header'=>'',
		'table_body'=>'',
		'card_end'=>'',
		'subcontent'=>'',
		'header_content_end'=>'',
	);
	
	public $bricks_form=array(
		'breadcrum_bar'=>'',
		'section'=>'',
		'form'=>'',
		'content'=>'',
		'form_end'=>'',
		'section_end'=>'',
	);

	// map prediction
	public $form_structure=array(
		'group_id_1'=>array(
			'label'=>'Group 1',
			'color'=>'primary', // default primary
			'col_len'=>6, // default 12
			'data'=>array(
				'key_1'=>array(
					'label'=>'Key 1',
					'input'=>'text',
					'value'=>'VALLLLLLLLLL',
					'validation'=>array(),
					'column'=>1,
					'warning_label'=>'eh isi cuk',
				),
				'key_2'=>array(
					'label'=>'Key 2',
					'input'=>'textarea',
					'value'=>null,
					'validation'=>array(),
					'column'=>1,
					'warning_label'=>'ini juga',
				),
			),
		),

		'group_id_2'=>array(
			// 'label'=>'Group 2',
			'color'=>'success', // default primary
			'col_len'=>5, // default 12
			'data'=>array(
				'key_1'=>array(
					'label'=>'Key 1',
					'input'=>'text',
					'value'=>null,
					'validation'=>array('required',''),
				),
				'key_2'=>array(
					'label'=>'Key 2',
					'input'=>'textarea',
					'value'=>null,
					'validation'=>array(),
				),
			),
		),
		'group_id_3'=>array(
			'label'=>'Group 3',
			'color'=>'danger', // default primary
			'data'=>array(
				'key_1'=>array(
					// 'label'=>'Key 1',
					'input'=>'text',
					'value'=>null,
					'validation'=>array('required',''),
				),
				'key_2'=>array(
					'label'=>'Key 2',
					'input'=>'textarea',
					'value'=>null,
					'validation'=>array(),
				),
				'key_3'=>array(
					'label'=>'Key 3',
					'input'=>'text',
					'value'=>null,
					'column'=>2,
					'validation'=>array('required',''),
				),
				'key_4'=>array(
					'label'=>'Key 5',
					'input'=>'textarea',
					'column'=>2,
					'value'=>null,
					'validation'=>array(),
				),
			),
		),
	);

	public function init($model, $controller_id, $uri_string) {
		$this->module_page=$uri_string;
		$this->module_name='Tag';
		$this->starter=array(
			'start'=>microtime(true),
			'title'=>$this->module_name,
		);
		// $this->list_view=$uri_string.'/'.$model.'/list_view';
		// $this->form_view=$uri_string.'/'.$model.'/form_view';


		return true;
	}

	// generate rows-map from model's attributes and its data
	public function mapping($attributes, $data_table, $subcontent='', $auto_build_mapping=true){
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
		if($this->config['front_action']){
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

			if($this->config['front_action']){
				$header_map_token['action']=$action_buttons;
				$data_table[$data_key]=array_merge($header_map_token,$data_table[$data_key]);
			}else{
				$data_table[$data_key]['action']=$action_buttons;
			}
		}

		$this->data_map=$data_table;

		$this->bricks['subcontent']=$subcontent;
		
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
		return '<div class="section-header">
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

		$this->bricks['breadcrum_bar'] .= $this->breadcrum($this->module_name, $add_button);

		// header content
		$this->bricks['header_content'].='<div class="section-body">
		<div class="row">
		<div class="col-12">
		<div class="card  card-primary">
		<div class="card-body">';

		// card, sub content is placed inside this card 
		$this->bricks['card'].='<div class="table-responsive">
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
		$this->bricks['table_body'].=' </tbody>';

		// end of card
		$this->bricks['card_end'].='</table></div>';

		// $this->bricks['subcontent'].='';

		// end of header content
		$this->bricks['header_content_end'].='</div></div></div></div></div>';


		return $this->bricks;
	}

	// main_build / build / build_form => opttional, either using diff fucntion or using main build + param, 
	public function main_build($datatable=true){
		$the_bricks=$datatable ? $this->bricks : $this->bricks_form;
		foreach ($the_bricks as $bricks_val) {
			$this->html.=$bricks_val;
		}
		return array(
			'content'=>$this->html,
			'title'=>$this->starter['title'],
			'start'=>$this->starter['start'],
		);
	}

	public function build(){
		return $this->main_build(true);
	}

	public function build_form(){
		return $this->main_build(false);
	}

	public function form($data=null){

		// breadcrum bar
		$this->bricks_form['breadcrum_bar'] .= $this->breadcrum('Create '.$this->module_name);
		// header section
		$this->bricks_form['section'].='<div class="section-body">';
		// header form
		$this->bricks_form['form'].=' <form class="needs-validation" novalidate=""><div class="row">';

		// content
		// debug($this->form_structure);
		$content='';
		foreach ($this->form_structure as $fs_key => $fs_value) {
			// group head
			$label_group=!empty($fs_value['label'])?'<div class="card-header">'.$fs_value['label'].'</div>':'';
			$col_len=!empty($fs_value['col_len'])?$fs_value['col_len']:12;
			$color=!empty($fs_value['color'])?$fs_value['color']:'primary';

			$content.='<div class="col-12 col-md-'.$col_len.'"><div class="card card-'.$color.'">'.$label_group.'<div class="card-body">';

			// forms in group
			$ea_form='';
			// check column
			$last_group='';
			foreach ($fs_value['data'] as $data_key => $data_value) {
				$last_group=$data_key;
					// ad col disini gan
			}

			// start build form
			foreach ($fs_value['data'] as $data_key => $data_value) {
				// preparation form
				$label=!empty($data_value['label'])?$data_value['label']:'- No Label -';
				$value=!empty($data_value['value'])?$data_value['value']:null;
				$validation='';
				if(!empty($data_value['validation'])){
					foreach ($data_value['validation'] as $validation_val) {
						$validation.=' '.$validation_val;
					}
				}
				$warning_label=!empty($data_value['warning_label'])?'<div class="invalid-feedback">'.$data_value['warning_label'].'</div>':'';

				// starting form
				$ea_form.='<div class="form-group">';
				// form core
				$ea_form.='<label>'.$label.'</label>';
				switch ($data_value['input']) {
					case 'text':
						$ea_form.='<input type="text" class="form-control" '.$validation.'>'.$warning_label;
						break;
					
					default:
						$ea_form.='<input type="text" class="form-control" disabled value="- Invalid or Unknown Input Type -">';
						break;
				}
				// end form
				$ea_form.='</div>';
			}

			$content.=$ea_form;
			// end of group head
			$content.='</div></div></div>';
		}
		$this->bricks_form['content']=$content;

		// end of form
		$this->bricks_form['form_end'].='</div></form>';
		// end of section
		$this->bricks_form['section_end'].='</div>';

	}


}


?>