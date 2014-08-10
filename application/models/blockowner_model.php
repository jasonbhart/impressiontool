<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Blockowner_model extends CI_Model {

    var $ip_block_owner = '';
    var $status = '';

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function getTable() {
        return 'list_ip_block_owner';
    }

    function issetBlockOwner($ip_block_owner) {
        $query = $this->db->get_where($this->getTable(), array('ip_block_owner' => $ip_block_owner))->result();
        if (count($query) > 0) {
            return $query[0]->id;
        }
        return 0;
    }

    function insert_blockowner($ip_block_owner, $status) {
        $id = '';
        if (!($id = $this->issetBlockOwner($ip_block_owner))) {
            $this->ip_block_owner = $ip_block_owner; // please read the below note
            $this->status = $status;

            $this->db->insert($this->getTable(), $this);
        } else {
            $this->update_blockowner($id, $ip_block_owner, $status);
        }
    }

    function update_blockowner($id, $ip_block_owner, $status) {
        $this->ip_block_owner = $ip_block_owner; // please read the below note
        $this->status = $status;

        $this->db->update($this->getTable(), $this, array('id' => $id));
    }
	
	//get status of a whois
	function getStatus($ip_block_owner) {
		$query = $this->db->get_where($this->getTable(), array('ip_block_owner' => $ip_block_owner))->result();
		if (count($query) > 0) {
			return $query[0]->status;
		}
		return 0;
	}
}
