<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Blockname_model extends CI_Model {

    var $ip_block_name = '';
    var $status = '';

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function getTable() {
        return 'list_ip_block_name';
    }

    function issetBlockName($ip_block_name) {
        $query = $this->db->get_where($this->getTable(), array('ip_block_name' => $ip_block_name))->result();
        if (count($query) > 0) {
            return $query[0]->id;
        }
        return 0;
    }

    function insert_blockname($ip_block_name, $status) {
        $id = '';
        if (!($id = $this->issetBlockName($ip_block_name))) {
            $this->ip_block_name = $ip_block_name; // please read the below note
            $this->status = $status;
            $this->db->insert($this->getTable(), $this);
        } else {
            $this->update_blockname($id, $ip_block_name, $status);
        }
    }

    function update_blockname($id, $ip_block_name, $status) {
        $this->ip_block_name = $ip_block_name; // please read the below note
        $this->status = $status;

        $this->db->update($this->getTable(), $this, array('id' => $id));
    }
	
	//get status of a whois
	function getStatus($ip_block_name) {
		$query = $this->db->get_where($this->getTable(), array('ip_block_name' => $ip_block_name))->result();
		if (count($query) > 0) {
			return $query[0]->status;
		}
		return 0;
	}

}
