<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Data
{

    public function __construct()
    {
        $this->CI = &get_instance();
    }

    public function get_form_fields($attributes)
    {
        $select = '';
        foreach ($attributes as $model_key => $model_value) {
            if (!array_key_exists('show_form', $model_value) or $model_value['show_form']) {
                $select .= !empty($select) ? ', ' . $model_key : $model_key;
            }
        }
        return $select;
    }

    public function get_by_id($attributes, $id_param, $table)
    {
        $id = explode('@', decode($id_param));
        $select = $this->get_form_fields($attributes);
        $where = where_statement($attributes, $id[1]);
        $result = $this->CI->db->select($select)
            ->from($table)
            ->where($where)
            ->get()->row_array();
        if (empty($result)) {
            $this->CI->session->set_flashdata(short_response('No record found.', 'error', 'Something is wrong! (ಠ_ಠ)'));
            return false;
        }
        return $result;
    }
}
