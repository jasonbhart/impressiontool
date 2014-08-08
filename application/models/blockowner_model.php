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
    
    function insert_blockowner($ip_block_owner, $status) {
        $this->ip_block_owner = $ip_block_owner; // please read the below note
        $this->status = $status;

        $this->db->insert($this->getTable(), $this);
    }

    function update_blockowner($id, $ip_block_owner, $status) {
        $this->ip_block_owner = $ip_block_owner; // please read the below note
        $this->status = $status;

        $this->db->update($this->getTable(), $this, array('id' => $id));
    }

}
