<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function index() {
		if($this->session->userdata('admin') != 1){
			redirect(base_url('/index.php/login'));
		}
		$viewData = array();
		$this->load->view('admin', $viewData);
	}

	function lookup() {
		if($this->session->userdata('admin') != 1){
			redirect(base_url('/index.php/login'));
		}
		$ipAddress = $_POST['ipAddress'];
		$ipAddressArray = explode(PHP_EOL, trim($ipAddress));
		if ($ipAddressArray[0] == "") {
			$ipAddressArray[] = $ipAddress;
		}
		$this->load->library('phpwhois');
		$phpwhois = new Phpwhois();
		$tempResultWhois = array();
		$this->load->model('Lookup_model', '', TRUE);
		$this->load->model('Blockname_model', '', TRUE);
		$this->load->model('Blockrange_model', '', TRUE);
		$this->load->model('Blockowner_model', '', TRUE);
		$cacheLookups = $this->Lookup_model->getLookupList($ipAddressArray);
		foreach ($ipAddressArray as $ip) {
			$ip = trim($ip);
			if ($phpwhois->whois->checkValidateIp($ip)) { // check ip is validate or not
				if (!isset($cacheLookups[$ip])) { // if this ip have not in database so we will use arin to lookup
					$rawWhois = $phpwhois->whois->Getipowner($ip); // lookup the ip
					foreach ($rawWhois as $whois) {
						$tempResultWhois['ip'] = $ip;
						$tempResultWhois['ip_block_name'] = '';
						$tempResultWhois['ip_block_range'] = '';
						$tempResultWhois['ip_block_owner'] = '';
						if (isset($whois['regrinfo']['network']['name']))
							$tempResultWhois['ip_block_name'] = $whois['regrinfo']['network']['name'];
						if (isset($whois['regrinfo']['network']['inetnum']))
							$tempResultWhois['ip_block_range'] = $whois['regrinfo']['network']['inetnum'];
						if (isset($whois['regrinfo']['owner']['organization']))
							$tempResultWhois['ip_block_owner'] = $whois['regrinfo']['owner']['organization'];

						//check with three owner
						if (isset($whois['regrinfo']['network'][0]['name']))
							$tempResultWhois['ip_block_name'] = $whois['regrinfo']['network'][0]['name'];
						if (isset($whois['regrinfo']['network'][0]['inetnum']))
							$tempResultWhois['ip_block_range'] = $whois['regrinfo']['network'][0]['inetnum'];
						if (isset($whois['regrinfo']['owner'][0]))
							$tempResultWhois['ip_block_owner'] = $whois['regrinfo']['owner'][0]['organization'];
						//check black list or white list from owner, name, range
						$checkStatus = -1;
						$listOwner = $this->Blockowner_model->getAllList(); // list of black and white owner
						$tempResultWhois['whois_status'] = $this->Blockowner_model->getStatus($tempResultWhois['ip_block_owner'], $listOwner);
						if ($tempResultWhois['whois_status'] != 0) { //owner is not white
							if ($tempResultWhois['whois_status'] == 1) {
								$checkStatus = 1;
							}
							$tempResultWhois['whois_status'] = $this->Blockrange_model->getStatus($tempResultWhois['ip_block_range']);
							if ($tempResultWhois['whois_status'] != 0) { //range is not white
								if ($tempResultWhois['whois_status'] == 1) {
									$checkStatus = 1;
								}
								$listName = $this->Blockname_model->getAllList(); // list of black and white name
								$tempResultWhois['whois_status'] = $this->Blockname_model->getStatus($tempResultWhois['ip_block_name'], $listName);
								if ($tempResultWhois['whois_status'] == -1) {
									$tempResultWhois['whois_status'] = $checkStatus;
								}
							}
						}
						//insert lookup result
						$this->Lookup_model->insert_lookup($ip, $tempResultWhois['ip_block_name'], $tempResultWhois['ip_block_range'], $tempResultWhois['ip_block_owner']);
						$resultWhois[] = $tempResultWhois;
					}
				} else {
					foreach ($cacheLookups[$ip] as $lookup) { // ip is in database
						$tempResultWhois['ip'] = $lookup->ip;
						$tempResultWhois['ip_block_name'] = $lookup->ip_block_name;
						$tempResultWhois['ip_block_range'] = $lookup->ip_block_range;
						$tempResultWhois['ip_block_owner'] = $lookup->ip_block_owner;
						//check black list or white list from owner, name, range
						$checkStatus = -1;
						$listOwner = $this->Blockowner_model->getAllList();
						$tempResultWhois['whois_status'] = $this->Blockowner_model->getStatus($tempResultWhois['ip_block_owner'], $listOwner);
						if ($tempResultWhois['whois_status'] != 0) { //owner is white
							if ($tempResultWhois['whois_status'] == 1) {
								$checkStatus = 1;
							}
							$tempResultWhois['whois_status'] = $this->Blockrange_model->getStatus($tempResultWhois['ip_block_range']);
							if ($tempResultWhois['whois_status'] != 0) { //owner is white
								if ($tempResultWhois['whois_status'] == 1) {
									$checkStatus = 1;
								}
								$listName = $this->Blockname_model->getAllList();
								$tempResultWhois['whois_status'] = $this->Blockname_model->getStatus($tempResultWhois['ip_block_name'], $listName);
								if ($tempResultWhois['whois_status'] == -1) {
									$tempResultWhois['whois_status'] = $checkStatus;
								}
							}
						}
						$resultWhois[] = $tempResultWhois;
					}
				}
			}
		}
		$viewData = array('resultWhois' => $resultWhois);
		return $this->load->view('ajax/lookup', $viewData);
	}

	public function ajax() {
		$action = $_REQUEST['action'];
		switch ($action) {
			case 'getLookup':
				echo $this->lookup();
				break;
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
			case 'addExportJob':
				$this->load->model('Userexport_model', '', TRUE);
				$email = $_POST['email'];
				$ips = $_POST['ips'];
				$this->Userexport_model->insert_userexport($email, $ips);
				echo 1;
				break;
			default:
				echo 0;
				break;
		}
	}

}
