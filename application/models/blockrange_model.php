<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Blockrange_model extends CI_Model {

    var $ip_block_range = '';
    var $status = '';

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function getTable() {
        return 'list_ip_block_range';
    }
    
    function insert_blockrange($ip_block_range, $status) {
        $this->ip_block_range = $ip_block_range; // please read the below note
        $this->status = $status;

        $this->db->insert($this->getTable(), $this);
    }

    function update_blockrange($id, $ip_block_range, $status) {
        $this->ip_block_range = $ip_block_range; // please read the below note
        $this->status = $status;

        $this->db->update($this->getTable(), $this, array('id' => $id));
    }

}
