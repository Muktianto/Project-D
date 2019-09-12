<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Validate
{
    public function __construct()
    {
        $this->CI = &get_instance();
    }

    public function delete($attributes, $id)
    {
        $id = explode('@', decode($id));
        // check action
        if ($id[0] != 'DEL') {
            $this->CI->session->set_flashdata(short_response('What are you trying to do anyway..?', 'error', 'Terminated! (ಠ_ಠ)'));
            return false;
        }
        return true;
    }

    public function update($attributes, $id_param, $table)
    {
        $id_param = explode('@', decode($id_param));
        // check action
        if ($id_param[0] != 'UPD') {
            $this->CI->session->set_flashdata(short_response('What are you trying to do anyway..?', 'error', 'Terminated! (ಠ_ಠ)'));
            return false;
        }
        return true;
    }

    public function check_exist($keys, $id, $table)
    {
        if (is_array($keys)) {
            $where = '';
            $select = '';
            $id_vals = explode('|', $id);
            foreach ($keys as $key => $value) {
                // keys and id_vals, should be have same len and map key 
                $where .= empty($where) ? "$value='" . $id_vals['$key'] . "'" : " AND $value='" . $id_vals['$key'] . "'";
                $select .= empty($select) ? $value : ', ' . $value;
            }
        } else {
            $where = "$keys='" . $id . "'";
            $select = $keys;
        }

        $check_exist =  $this->CI->db->select($select)
            ->from($table)
            ->where($where)
            ->get()->row_array();

        return empty($check_exist) ? false : true;
    }
}
