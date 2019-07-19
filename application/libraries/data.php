<?php 

defined('BASEPATH') OR exit('No direct script access allowed');
// Global function abot data flow

class Data 
{
	function get_session() {
		// sementara
		return 'system';
	}

	public function debug($data, $exit = true) {
		if (empty($data) && $exit)
			print_error('Data is empty');
		echo '<div style="background-color: #191d21; border-radius: .50rem; color: #fff; border: none; padding: 0px 20px; font-weight: 600;display: inline-block"><pre>';
		if (is_object($data)) {
			var_dump($data);
		} else if (is_array($data)) {
			print_r($data);
		} else {
			echo !empty($data) ? $data : '<span style="color: #d4c820">Empty</span>';
		}
		echo '</pre></div><br><br>';
		if ($exit)
			exit();
	}
}


?>