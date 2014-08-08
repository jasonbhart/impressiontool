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

    function issetBlockRange($ip_block_range) {
        $query = $this->db->get_where($this->getTable(), array('ip_block_range' => $ip_block_range))->result();
        if (count($query) > 0) {
            return $query[0]->id;
        }
        return 0;
    }

    function insert_blockrange($ip_block_range, $status) {
        $id = '';
        if (!($id = $this->issetBlockRange($ip_block_range))) {
            $this->ip_block_range = $ip_block_range; // please read the below note
            $this->status = $status;

            $this->db->insert($this->getTable(), $this);
        } else {
            $this->update_blockrange($id, $ip_block_range, $status);
        }
    }

    function update_blockrange($id, $ip_block_range, $status) {
        $this->ip_block_range = $ip_block_range; // please read the below note
        $this->status = $status;

        $this->db->update($this->getTable(), $this, array('id' => $id));
    }

}
