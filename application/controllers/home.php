<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index() {
		$this->load->library('phpwhois');
		
		$phpwhois = new Phpwhois();
		$domain = '76.102.19.35';

		$result = $phpwhois->whois->Lookup($domain);
		echo json_encode($result);die;
		$data = array('result' => $result);
		$this->load->view('home', $data);
	}

}
