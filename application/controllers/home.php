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

}
