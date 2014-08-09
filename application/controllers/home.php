<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index() {
		$resultWhois = array();
		if (isset($_POST['ipAddress'])) {
			$ipAddress = $_POST['ipAddress'];
			$ipAddressArray = explode(PHP_EOL, trim($ipAddress));
			if ($ipAddressArray[0] == "") {
				$ipAddressArray[] = $ipAddress;
			}
			$this->load->library('phpwhois');
			$phpwhois = new Phpwhois();
			$tempResultWhois = array();
			$this->load->model('Lookup_model', '', TRUE);
			$this->load->model('Whois_model', '', TRUE);
			$cacheLookups = $this->Lookup_model->getLookupList($ipAddressArray);
			foreach ($ipAddressArray as $ip) {
				$ip = trim($ip);
				if ($phpwhois->whois->checkValidateIp($ip)) {
					if (!isset($cacheLookups[$ip])) {
						$rawWhois = $phpwhois->whois->Getipowner($ip);
						foreach ($rawWhois as $whois) {
							$tempResultWhois['ip'] = $ip;
							$tempResultWhois['ip_block_name'] = $whois['regrinfo']['network']['name'];
							$tempResultWhois['ip_block_range'] = $whois['regrinfo']['network']['inetnum'];
							$tempResultWhois['ip_block_owner'] = $whois['regrinfo']['owner']['organization'];
							//check black list or white list
							$tempResultWhois['whois_status'] = $this->Whois_model->getStatus($tempResultWhois['ip_block_name'], $tempResultWhois['ip_block_range'], $tempResultWhois['ip_block_owner']);

							//insert lookup result
							$this->Lookup_model->insert_lookup($ip, $tempResultWhois['ip_block_name'], $tempResultWhois['ip_block_range'], $tempResultWhois['ip_block_owner']);
							$resultWhois[] = $tempResultWhois;
						}
					} else {
						foreach ($cacheLookups[$ip] as $lookup) {
							$tempResultWhois['ip'] = $lookup->ip;
							$tempResultWhois['ip_block_name'] = $lookup->ip_block_name;
							$tempResultWhois['ip_block_range'] = $lookup->ip_block_range;
							$tempResultWhois['ip_block_owner'] = $lookup->ip_block_owner;
							//check black list or white list
							$tempResultWhois['whois_status'] = $this->Whois_model->getStatus($tempResultWhois['ip_block_name'], $tempResultWhois['ip_block_range'], $tempResultWhois['ip_block_owner']);
							$resultWhois[] = $tempResultWhois;
						}
					}
				}
				else {
				}
			}
		}
		$viewData = array('resultWhois' => $resultWhois);
		$this->load->view('home', $viewData);
	}

	public function ajax() {
		$action = $_REQUEST['action'];
		switch ($action) {
			case 'editWhois':
				$this->load->model('Whois_model', '', TRUE);
				$whois = $_POST['whois'];
				$status = $_POST['status'];
				$this->Whois_model->insert_whois($whois, $status);
				echo 1;
				break;
			default:
				echo 0;
				break;
		}
	}

}
