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
            $respon = short_response('Invalid Action.', 'danger', 'Terminated!');
            $this->CI->session->set_flashdata($respon);
            return false;
        }
        return true;
    }
}
