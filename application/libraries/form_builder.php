<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Form_builder
{
	public $attributes = array();

	// default table
	private $access_table = 'sso_access';
	private $application_table = 'sso_application';
	private $module_table = 'sso_module';
	private $group_table = 'sso_group';
	private $group_access_table = 'sso_group';
	private $menu_table = 'sso_menu';
	private $user_table = 'sso_user';
	private $user_application_table = 'sso_user_application';
	private $user_group_table = 'sso_user_group';

	public $admin_temp = 'template/v_admin_layout';
	public $module_page = '';
	public $module_name = '';
	public $list_view = '';
	public $form_view = '';

	public $primary_key = array();
	public $current_primary_key = array();
	public $current_primary_key_str = '';

	public $starter = array();
	public $config = array(
		'front_action' => false,
		'create_buton' => false,
		'addition_button' => '',
	);

	public $header_map = array();
	public $data_map = array();
	public $bulk_input = false;

	public $html = '';

	// made bricks and bricks_form to show the differences of them
	public $bricks = array(
		'breadcrum_bar' => '',
		'header_content' => '',
		'card' => '',
		'table_header' => '',
		'table_body' => '',
		'card_end' => '',
		'subcontent' => '',
		'header_content_end' => '',
	);

	public $bricks_form = array(
		'breadcrum_bar' => '',
		'section' => '',
		'form' => '',
		'content' => '',
		'form_end' => '',
		'section_end' => '',
	);



	// map structure prediction
	public $group = array();
	public $form_structure = array();
	// 
	public $form_structure2 = array(
		'group_id_1' => array(
			'label' => 'Group 1',
			'color' => 'primary', // default primary
			'col_len' => 6, // default 12
			'col_total' => 1, // default null/1
			'data' => array(
				'col_1' => array(
					'A_key_1' => array(
						'label' => 'Key 1',
						'input' => 'text',
						'value' => 'VALLLLLLLLLL',
						'validation' => array(),
						'column' => 1,
						'warning_label' => 'eh isi cuk',
					),
					'A_key_2' => array(
						'label' => 'Key 2',
						'input' => 'textarea',
						'value' => null,
						'validation' => array(),
						'column' => 1,
						'warning_label' => 'ini juga',
					),
				),
			),
		),
		'group_id_2' => array(
			// 'label'=>'Group 2',
			'color' => 'success', // default primary
			'col_len' => 5, // default 12
			'col_total' => 1, // default null/1
			'data' => array(
				'col_1' => array(
					'B_key_1' => array(
						'label' => 'Key 1',
						'input' => 'text',
						'value' => null,
						'validation' => array('required', ''),
					),
					'B_key_2' => array(
						'label' => 'Key 2',
						'input' => 'textarea',
						'value' => null,
						'validation' => array(),
					),
				),
			),
		),
		'group_id_3' => array(
			'label' => 'Group 3',
			'color' => 'danger', // default primary
			'last_group' => true, // default false
			'col_len' => 10, // default 12
			'col_total' => 2, // default null/1
			'form_col_len_ea' => 6, //floor(12/2), // default null/1
			'data' => array(
				'col_1' => array(
					'C_key_1' => array(
						// 'label'=>'Key 1',
						'input' => 'text',
						'value' => null,
						'validation' => array(''),
					),
					'C_key_2' => array(
						'label' => 'Key 2',
						'input' => 'textarea',
						'value' => null,
						'validation' => array(),
					),
				),
				'col_2' => array(
					'C_key_3' => array(
						'label' => 'Key 3',
						'input' => 'text',
						'value' => null,
						'validation' => array('required', ''),
					),
					'C_key_4' => array(
						'label' => 'Key 5',
						'input' => 'textarea',
						'value' => null,
						'validation' => array(),
					),
				),
			),
		),
	);

	public function init($model, $controller_id, $uri_string)
	{
		$this->module_page = $uri_string;
		$this->module_name = '-MODNAME-';
		$this->starter = array(
			'start' => microtime(true),
			'title' => $this->module_name,
		);
		// $this->list_view=$uri_string.'/'.$model.'/list_view';
		// $this->form_view=$uri_string.'/'.$model.'/form_view';


		return true;
	}

	// generate rows-map from model's attributes and its data
	public function mapping($attributes, $data_table, $subcontent = '', $auto_build_mapping = true)
	{
		$this->data_map = $data_table;
		// table header
		// map fields to show in datatable
		foreach ($attributes as $model_key => $model_value) {
			if (array_key_exists('show_datatable', $model_value) and $model_value['show_datatable']) {
				$this->header_map[$model_key] = $model_value;
			}
			if (array_key_exists('primary_key', $model_value) and $model_value['primary_key']) {
				$this->primary_key[] = $model_key;
			}
		}

		// action column location, first column or last
		$action_col = array(
			'data' => $this->primary_key,
			'label' => 'Action',
			'width' => 100,
		);
		if ($this->config['front_action']) {
			$header_map['action'] = $action_col;
			$this->header_map = array_merge($header_map, $this->header_map);
		} else {
			$this->header_map['action'] = $action_col;
		}
		// end of action column location
		// end of table header

		// list data
		foreach ($data_table as $data_key => $data_value) {
			// prepare PK to build action button
			$this->current_primary_key_str = '';
			foreach ($this->primary_key as $pk_key) {
				$this->current_primary_key_str .= empty($this->current_primary_key_str) ? $data_value[$pk_key] : '|' . $data_value[$pk_key];
			}

			$action_buttons = $this->update_link() . $this->delete_link();

			// action column location, first column or last
			if ($this->config['front_action']) {
				$header_map_token['action'] = $action_buttons;
				$data_table[$data_key] = array_merge($header_map_token, $data_table[$data_key]);
			} else {
				$data_table[$data_key]['action'] = $action_buttons;
			}
		}
		$this->data_map = $data_table;

		$this->bricks['subcontent'] = $subcontent;

		// build datatable
		if ($auto_build_mapping) {
			$this->datatable();
		}

		return true;
	}

	public function update_link($key = '', $label = 'View', $color = 'info', $icon = 'edit', $icon_loc = 'left')
	{
		$key = empty($key) ? $this->current_primary_key_str : $key;
		return ' <a href="' . site_url($this->module_page . 'update/') . encode('UPD@' . $key) . '" class="btn btn-sm btn-icon icon-' . $icon_loc . ' btn-outline-' . $color . '"><i class="fas fa-' . $icon . '"></i> ' . $label . '</a>';
	}

	public function delete_link($key = '')
	{
		$key = empty($key) ? $this->current_primary_key_str : $key;
		$link = site_url($this->module_page . 'delete/') . encode('DEL@' . $key);
		return ' <a href="" class="btn btn-sm btn-icon icon-left btn-outline-danger" data-confirm="Realy?|Do you want to continue?" data-confirm-yes="' . "window.location = '$link';" . '"><i class="fas fa-trash"></i> Delete</a>';
	}

	public function breadcrum($name, $button = '')
	{
		return '<div class="section-header">
		<h1 class="section-title">' . $name . '</h1>' . $button . '
		<div class="section-header-breadcrumb">
		<div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
		<div class="breadcrumb-item"><a href="#">Modules</a></div>
		<div class="breadcrumb-item">DataTables</div>
		&nbsp;&nbsp;&nbsp;&nbsp;<a href="' .  site_url($this->module_page) . '"><span class="badge badge-primary"><i class="fa fa-sync-alt"></i></span></a>
		</div>
		</div>';
	}

	public function datatable()
	{
		// breadcrum bar
		$add_button = '&nbsp&nbsp&nbsp<a href="' .  site_url($this->module_page . 'create/') . '" class="btn btn-icon icon-left btn-primary"><i class="fa fa-plus" style="font-size: smaller;"></i> Create</a>';
		$this->bricks['breadcrum_bar'] .= $this->breadcrum($this->module_name, $add_button);

		// header content
		$this->bricks['header_content'] .= '<div class="section-body">
		<div class="row">
		<div class="col-12">
		<div class="card  card-primary">
		<div class="card-body">';

		// card, sub content is placed inside this card
		$this->bricks['card'] .= '<div class="table-responsive">
		<table class="table table-striped" id="table-2" style="white-space: nowrap">';

		// table header
		$this->bricks['table_header'] .= '<thead><tr>';

		if ($this->bulk_input) {
			$this->bricks['table_header'] .= '<th class="text-center">
			<div class="custom-checkbox custom-control">
			<input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad" class="custom-control-input" id="checkbox-all">
			<label for="checkbox-all" class="custom-control-label">&nbsp;</label>
			</div>
			</th>';
		}

		$this->bricks['table_header'] .= '<th style="display:none;">X</th><th style="display:none;">X</th><th style="display:none;">X</th><th style="display:none;">X</th>';  // BUG.. datatable wont sort 1,3,4 column

		// column header
		foreach ($this->header_map as $header_val) {
			$width = !empty($header_val['width']) ? ' width="' . $header_val['width'] . '"' : '';
			$this->bricks['table_header'] .= '<th' . $width . '>' . $header_val['label'] . '</th>';
		}
		// end of table header
		$this->bricks['table_header'] .= '</tr></thead>';

		// table body
		$this->bricks['table_body'] .= '<tbody>';

		// row body
		foreach ($this->data_map as $data_key => $data_value) {
			$this->bricks['table_body'] .= '<tr>';
			if ($this->bulk_input) {
				$this->bricks['table_body'] .= '<td  class="text-center">
				<div class="custom-checkbox custom-control">
				<input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="checkbox-1">
				<label for="checkbox-1" class="custom-control-label">&nbsp;</label>
				</div>
				</td>';
			}

			$this->bricks['table_body'] .= '<td style="display:none;"></td><td style="display:none;"></td><td style="display:none;"></td><td style="display:none;"></td>'; // BUG.. datatable wont sort 1,3,4 column
			foreach ($this->header_map as $header_key => $header_val) {
				// DEBUG
				$align = !empty($header_val['align']) ? ' align="' . $header_val['align'] . '"' : '';
				$this->bricks['table_body'] .= '<td' . $align . '>' . (empty($data_value[$header_key]) ? $header_key : $data_value[$header_key]) . '</td>';
			}
			$this->bricks['table_body'] .= '</tr>';
		}

		// end of table body
		$this->bricks['table_body'] .= ' </tbody>';

		// end of card
		$this->bricks['card_end'] .= '</table></div>';

		// $this->bricks['subcontent'].='';

		// end of header content
		$this->bricks['header_content_end'] .= '</div></div></div></div></div>';

		return $this->bricks;
	}

	// main_build / build / build_form => opttional, either using diff fucntion or using main build + param,
	public function main_build($datatable = true)
	{
		$the_bricks = $datatable ? $this->bricks : $this->bricks_form;
		foreach ($the_bricks as $bricks_val) {
			$this->html .= $bricks_val;
		}
		return array(
			'content' => $this->html,
			'title' => $this->starter['title'],
			'start' => $this->starter['start'], // elapsed time
		);
	}

	public function build()
	{
		return $this->main_build(true);
	}

	public function build_form()
	{
		return $this->main_build(false);
	}

	public function develop_form_structure($attributes, $data = null)
	{
		$column_count = array();
		foreach ($attributes as $att_key => $att_value) {
			if (!array_key_exists('show_form', $att_value) or $att_value['show_form']) {
				$data_group = !empty($att_value['group']) ? $att_value['group'] : 1;
				$data_column = !empty($att_value['column']) ? $att_value['column'] : 1;

				$label = !empty($att_value['label']) ? $att_value['label'] : $att_key;
				$validation = !empty($att_value['validation']) ? $att_value['validation'] : array();
				$this->form_structure[$data_group]['data'][$data_column][$att_key] = array(
					'label' => $label,
					'input' => !empty($att_value['input']) ? $att_value['input'] : null,
					'value' => !empty($att_value['value']) ? $att_value['value'] : null,
					'validation' => $validation,
					'warning_label' => !in_array('required', $validation) ? null : (!empty($att_value['warning_label']) ? $att_value['warning_label'] : "Empty $label!"),
				);

				// override value if exist, update function
				if (!empty($data[$att_key])) {
					$this->form_structure[$data_group]['data'][$data_column][$att_key]['value'] = $data[$att_key];
				}
				$column_count[$data_group][$data_column] = empty($column_count[$data_group][$data_column]) ? 1 : $column_count[$data_group][$data_column] + 1;
			}
		}

		// mark the last group for placing action button
		$count_group = count($this->form_structure);
		$no_group = 1;
		foreach ($this->form_structure as $token_key => $token_val) {
			if ($no_group == $count_group) {
				$this->form_structure[$token_key]['last_group'] = true;
			}
			$no_group++;
		}

		// add column information total column and col len
		foreach ($column_count as $col_key => $col_value) {
			$this->form_structure[$col_key]['col_total'] = count($col_value);
			$this->form_structure[$col_key]['form_col_len_ea'] = floor(12 / count($col_value));
		}
	}

	public function form($attributes = null, $data = null)
	{
		$update = empty($data) ? false : true;
		// developing structure
		// empty attributes means u should prepare $this->form_structure by urself
		if (!empty($attributes)) {
			$this->develop_form_structure($attributes, $data);
		}

		// breadcrum bar
		$this->bricks_form['breadcrum_bar'] .= $this->breadcrum('Create ' . $this->module_name);
		// header section
		$this->bricks_form['section'] .= '<div class="section-body">';
		// header form
		$form_function = $update ? 'update' : 'create';
		$this->bricks_form['form'] .= ' <form action="' . base_url($this->module_page . $form_function) . '" method="post" enctype="multipart/form-data" class="needs-validation" novalidate=""><div class="row">';

		// content
		$content = '';
		// group head level
		// debug($this->form_structure, false);
		// debug($data);
		foreach ($this->form_structure as $fs_key => $fs_value) {
			$label_group = !empty($fs_value['label']) ? '<div class="card-header"><h4>' . $fs_value['label'] . '</h4></div>' : '';
			$col_len = !empty($fs_value['col_len']) ? $fs_value['col_len'] : 12;
			$color = !empty($fs_value['color']) ? $fs_value['color'] : 'primary';

			// group level
			$content .= '<div class="col-12 col-md-' . $col_len . '"><div class="card card-' . $color . '">' . $label_group . '<div class="card-body">';

			$col_row = '';
			$end_col_row = '';
			// distinguish which using rows or cols and simple forms, without rows and cols, empty =normal
			if (!empty($fs_value['col_total']) and $fs_value['col_total'] > 1) {
				$col_row = '<div class="row">';
				$end_col_row = '</div>';
			}
			$content .= $col_row;
			$forms_field = '';

			// column level
			foreach ($fs_value['data'] as $data_key => $data_value) {
				$col_class = '';
				$end_col_class = '';
				// distinguish which using rows or cols and simple forms, without rows and cols
				// empty =normal
				if (!empty($fs_value['col_total']) and $fs_value['col_total'] > 1) {
					$col_class = '<div class="col-12 col-md-' . $fs_value['form_col_len_ea'] . '">';
					$end_col_class = '</div>';
				}
				$forms_field .= $col_class;

				// form level
				foreach ($data_value as $data_form_key => $data_form_value) {
					$label = !empty($data_form_value['label']) ? $data_form_value['label'] : '- No Label -';
					$value = !empty($data_form_value['value']) ? $data_form_value['value'] : null;
					$validation = '';
					if (!empty($data_form_value['validation'])) {
						foreach ($data_form_value['validation'] as $validation_val) {
							$validation .= ' ' . $validation_val;
						}
					}
					//OLD delete after make sure it was unnecessary
					// $warning_label_val = empty($data_form_value['warning_label']) ? 'Empty ' . $label : $data_form_value['warning_label'];
					// $warning_label = '<div class="invalid-feedback">' . $warning_label_val . '</div>';
					$warning_label = empty($data_form_value['warning_label']) ? null : '<div class="invalid-feedback">' . $data_form_value['warning_label'] . '</div>';

					// starting form
					// hidden doesnt need form tag, it would give it a little blank space
					$forms_field .= $data_form_value['input'] == 'hidden' ? '' : '<div class="form-group">';
					// form core
					switch ($data_form_value['input']) {
						case 'hidden':
							$forms_field .= '<input type="hidden" value="' . $value . '" name="' . $data_form_key . '" class="form-control">';
							break;
						case 'text':
							$forms_field .= '<label>' . $label . '</label><input type="text" value="' . $value . '" name="' . $data_form_key . '" class="form-control" ' . $validation . '>' . $warning_label;
							break;
						case 'textarea':
							$forms_field .= '<label>' . $label . '</label><textarea name="' . $data_form_key . '" class="form-control" ' . $validation . '>' . $value . '</textarea>' . $warning_label;
							break;

						default:
							$forms_field .= '<label>' . $label . '</label><input type="text" class="form-control" disabled value="- Invalid or Unknown Input Type -">';
							break;
					}
					// end form
					$forms_field .= $data_form_value['input'] == 'hidden' ? '' : '</div>';
				}

				$forms_field .= $end_col_class;
			}
			$content .= $forms_field . $end_col_row;

			// button if last group
			if (!empty($fs_value['last_group']) and $fs_value['last_group']) {
				// site_url($this->module_page.'/create/')
				$action_button = $update ? ' <button type="submit" class="btn btn-info"><i class="fa fa-save"></i> Update</button>' : '<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>';
				$content .= '<div class="card-footer text-right">
				<a href="' . 'back_page' . '" class="btn btn-icon icon-left btn-light"><i class="fa fa-chevron-left"></i> Cancel</a>' . $action_button;
			}

			// end of group head
			$content .= '</div></div></div>';
		}
		$this->bricks_form['content'] = $content;

		// end of form
		$this->bricks_form['form_end'] .= '</div></form>';
		// end of section
		$this->bricks_form['section_end'] .= '</div>';
	}
}
