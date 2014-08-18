<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index() {
		$message = $this->session->flashdata('message');
		$viewData = array('message' => $message);
		$this->load->view('login', $viewData);
	}
	
	public function check() {
		$username = $_POST['username'];
		$password = $_POST['password'];
		$this->load->model('User_model', '', TRUE);
		if (!($id = $this->User_model->issetAccount($username, $password))) {
			$this->session->set_flashdata('message', 'Have not this account!');
			redirect(base_url('index.php/login'));
		}
		else {
			$this->session->set_userdata('admin', '1');
			redirect(base_url('/index.php/admin'));
		}
	}

}
