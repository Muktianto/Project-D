<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_post extends CI_Model
{

    public $table = 'blg_post';
    public $primary_key;
    public $attributes = array();

    public function __construct()
    {
        $this->attributes = array(
            'post_id' => array(
                'input' => 'hidden',
                'primary_key' => true,
                'auto_increment' => true,
                'label' => 'Post ID',
                'align' => 'right',
                'show_datatable' => true,
                'group' => 1,
                'column' => 1,
            ),
            'title' => array(
                'input' => 'text',
                'label' => 'Title',
                'validation' => array('required'),
                'show_datatable' => true,
                'group' => 1,
                'column' => 1,
            ),
            'summary_text' => array(
                'input' => 'textarea',
                'label' => 'Summary',
                'group' => 1,
                'column' => 2,
                // 'show_datatable' => true,
            ),
            'tags' => array(
                'input' => 'text',
                'label' => 'Tags',
                'group' => 1,
                'column' => 2,
            ),
            'comment' => array(
                'input' => 'text',
                'label' => 'comment',
                'validation' => array('currency'),
                'show_datatable' => true,
                'group' => 2,
            ),
            'views' => array(
                'input' => 'text',
                'label' => 'views',
                'validation' => array('currency'),
                'show_datatable' => true,
                'group' => 2,
            ),
            'shared' => array(
                'input' => 'text',
                'label' => 'shared',
                'validation' => array('currency'),
                'group' => 2,
            ),
            'star_vote_average' => array(
                'input' => 'text',
                'label' => 'star_vote_average',
                'group' => 3,
                'column' => 1,
            ),
            'star_vote_total' => array(
                'input' => 'text',
                'label' => 'star_vote_total',
                'group' => 3,
                'column' => 2,
            ),
            'editor_choice_rate' => array(
                'input' => 'text',
                'label' => 'editor_choice_rate',
                'group' => 3,
                'column' => 3,
            ),
            'media' => array(
                'input' => 'text',
                'label' => 'media',
                'group' => 3,
                'column' => 1,
            ),
            'media_type' => array(
                'input' => 'text',
                'label' => 'media_type',
                'group' => 3,
                'column' => 2,
            ),
            'status' => array(
                'input' => 'text',
                'label' => 'status',
                'group' => 3,
                'column' => 3,
            ),
            CREATE_BY => array(
                'value' => $this->data->get_session('user_id'),
                'show_form' => false,
            ),
            CREATE_DATE => array(
                'value' => date('Y-m-d H:i:s'),
                'show_form' => false,
            ),
            UPDATE_BY => array(
                'value' => $this->data->get_session('user_id'),
                'show_form' => false,
            ),
            UPDATE_DATE => array(
                'value' => date('Y-m-d H:i:s'),
                'show_form' => false,
            ),
        );
    }

    public function get_data()
    {
        return $this->db->select('post_id, title, comment, views')
            ->get($this->table)->result_array();
    }
}
