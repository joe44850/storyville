<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(HLP."/pkg-default.php");

class Home extends CI_Controller {
	
	private $is_mobile;
	private $params;
	
	public function __construct(){
		parent::__construct();
		$this->_Init();
	}
	
	public function index(){
		$this->params['head_start'] = $this->Display->HeadStart();
		$this->params['body_start'] = $this->Display->BodyStart();
		$this->load->view("Home/home".$this->ext, $this->params);
	}
	
	private function _Init(){
		$this->is_mobile = isMobile();
		$this->Html = new Html();
		if($this->is_mobile){
			$this->ext = "_mbl";
			$this->Display = new MBL\Display($this->Html);			
		}
		else{	
			$this->ext = "_pc";
			$this->Display = new PC\Display($this->Html);			
		}
		
		
	}
	
}
