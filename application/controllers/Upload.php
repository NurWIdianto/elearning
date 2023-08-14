<?php
/**
 * 
 */
class Upload extends CI_Controller{
	public $model;
	public function __construct(){
		parent::__construct();
		$this->load->helper(['url','html']);
		$this->load->library('session');
		$this->load->database();
		$this->load->model('Upload_model');
		$this->model = $this->Upload_model;
	}

	
}