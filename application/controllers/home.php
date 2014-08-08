<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller {

    public function index() {
        $resultWhois = array();
        if (isset($_POST['ipAddress'])) {
            $ipAddress = $_POST['ipAddress'];
            $ipAddressArray = explode('\n', trim($ipAddress));
            if ($ipAddressArray[0] == "") {
                $ipAddressArray[] = $ipAddress;
            }
            $this->load->library('phpwhois');
            $phpwhois = new Phpwhois();
            $tempResultWhois = array();
            foreach ($ipAddressArray as $ip) {
                $rawWhois = $phpwhois->whois->Getipowner($ip);
                foreach ($rawWhois as $whois) {
                    $tempResultWhois['ip'] = $ip;
                    $tempResultWhois['ip_block_name'] = $whois['regrinfo']['network']['name'];
                    $tempResultWhois['ip_block_range'] = $whois['regrinfo']['network']['inetnum'];
                    $tempResultWhois['ip_block_owner'] = $whois['regrinfo']['owner']['organization'];
                    $resultWhois[] = $tempResultWhois;
                }
            }
        }
        $viewData = array('resultWhois' => $resultWhois);
        $this->load->view('home', $viewData);
    }

    public function ajax() {
        $action = $_REQUEST['action'];
        switch ($action) {
            case 'editBlockName':
                $this->load->model('Blockname_model', '', TRUE);
                $ip_block_name = $_POST['ip_block_name'];
                $status = $_POST['status'];
                $this->Blockname_model->insert_blockname($ip_block_name, $status);
                echo 1;
                break;
            case 'editBlockRange':
                $this->load->model('Blockrange_model', '', TRUE);
                $ip_block_range = $_POST['ip_block_range'];
                $status = $_POST['status'];
                $this->Blockrange_model->insert_blockrange($ip_block_range, $status);
                echo 1;
                break;
            case 'editBlockOwner':
                $this->load->model('Blockowner_model', '', TRUE);
                $ip_block_owner = $_POST['ip_block_owner'];
                $status = $_POST['status'];
                $this->Blockowner_model->insert_blockowner($ip_block_owner, $status);
                echo 1;
                break;
            default:
                echo 0;
                break;
        }
    }

}
