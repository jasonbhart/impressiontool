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
    
    function insert_blockname($ip_block_name, $status) {
        $this->ip_block_name = $ip_block_name; // please read the below note
        $this->status = $status;

        $this->db->insert($this->getTable(), $this);
    }

    function update_blockname($id, $ip_block_name, $status) {
        $this->ip_block_name = $ip_block_name; // please read the below note
        $this->status = $status;

        $this->db->update($this->getTable(), $this, array('id' => $id));
    }

}
