<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class User_model extends CI_Model {

	var $username = '';
	var $password = '';

	function __construct() {
		// Call the Model constructor
		parent::__construct();
	}

	function getTable() {
		return 'users';
	}

	function issetAccount($username, $password) {
		$query = $this->db->get_where($this->getTable(), array('username' => $username, 'password' => md5($password)))->result();
		if (count($query) > 0) {
			return $query[0]->id;
		}
		return 0;
	}

}
