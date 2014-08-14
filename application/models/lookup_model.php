<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Lookup_model extends CI_Model {

	var $ip = '';
	var $ip_block_name = '';
	var $ip_block_range = '';
	var $ip_block_owner = '';

	function __construct() {
		// Call the Model constructor
		parent::__construct();
	}

	function getTable() {
		return 'lookups';
	}

	function issetLookup($ip) {
		$query = $this->db->get_where($this->getTable(), array('ip' => $ip))->result();
		if (count($query) > 0) {
			return $query[0]->id;
		}
		return 0;
	}
	
	//get look up list from database
	function getLookupList($listIps = array()) {
		$result = array();
		$this->db->where_in('ip', $listIps);
		$query = $this->db->get($this->getTable())->result();
		if (count($query) > 0) {
			foreach ($query as $lookup) {
				$result[$lookup->ip][] = $lookup;
			}
			return $result;
		}
		return array();
	}

	function insert_lookup($ip, $ip_block_name, $ip_block_range, $ip_block_owner) {
		$this->ip_block_name = $ip_block_name;
		$this->ip_block_range = $ip_block_range;
		$this->ip_block_owner = $ip_block_owner;
		$this->ip = $ip;
		$this->db->insert($this->getTable(), $this);
	}

}
