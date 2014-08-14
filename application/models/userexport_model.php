<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Userexport_model extends CI_Model {

	var $email = '';
	var $ips = '';
	var $status = '';

	function __construct() {
		// Call the Model constructor
		parent::__construct();
	}

	function getTable() {
		return 'user_exports';
	}

	function insert_userexport($email, $ips) {
		$this->email = $email; // please read the below note
		$this->ips = $ips;
		$this->db->insert($this->getTable(), $this);
	}
	
	function getJobs() {
		$query = $this->db->get_where($this->getTable(), array('status' => 0))->result();
		return $query;
	}
	
	function updateJob($id, $status) {
		$this->status = $status;
		$this->db->update($this->getTable(), array('status' => $this->status), array('id' => $id));
	}

}
