<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Whois_model extends CI_Model {

	var $whois = '';
	var $status = '';

	function __construct() {
		// Call the Model constructor
		parent::__construct();
	}

	function getTable() {
		return 'whois';
	}

	function issetBlockRange($whois) {
		$query = $this->db->get_where($this->getTable(), array('whois' => $whois))->result();
		if (count($query) > 0) {
			return $query[0]->id;
		}
		return 0;
	}

	function insert_whois($whois, $status) {
		$id = '';
		if (!($id = $this->issetBlockRange($whois))) {
			$this->whois = $whois; // please read the below note
			$this->status = $status;

			$this->db->insert($this->getTable(), $this);
		} else {
			$this->update_whois($id, $whois, $status);
		}
	}

	function update_whois($id, $whois, $status) {
		$this->whois = $whois; // please read the below note
		$this->status = $status;

		$this->db->update($this->getTable(), $this, array('id' => $id));
	}

	//get status of a whois
	function getStatus($ip_block_name, $ip_block_range, $ip_block_owner) {
		$whois = $ip_block_name . ';' . $ip_block_range . ';' . $ip_block_owner;
		$query = $this->db->get_where($this->getTable(), array('whois' => $whois))->result();
		if (count($query) > 0) {
			return $query[0]->status;
		}
		return -1;
	}

}
