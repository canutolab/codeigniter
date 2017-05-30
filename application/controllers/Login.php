<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	
	public function __construct(){
		parent::__construct();
		$this->load->helper('form');
	}

	public function index(){
		$data['content'] ="home";
		$data['active_menu'] ="home";
		$this->load->view('init', $data);
	}

	
}
