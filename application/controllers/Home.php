<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(HLP."/pkg-default.php");

class Home extends CI_Controller {
	
	private $_is_mobile;
	private $_is_logged_in;
	private $_params;
	private $_Display;
	private $_Login;
	
	public function __construct(){
		parent::__construct();
		$this->_Init();
	}
	
	public function index(){
		$this->_params['head_start'] = $this->_Display->HeadStart();
		$this->_params['body_start'] = $this->_Display->BodyStart();
		if($this->_is_logged_in){ $this->_welcomeNonMember(); }
		else{ $this->_welcomeMember();}
	}
	
	private function _welcomeNonMember(){
		$this->_params['nav_bar'] = $this->_Display->NavBar(true);		
		$this->load->view("Home/WelcomeNonMember".$this->_Display->ext, $this->_params);
	}
	
	private function _welcomeMember(){
		$this->_params['nav_bar'] = $this->_Display->NavBar(true);		
		$this->load->view("Home/WelcomeMember".$this->_Display->ext, $this->_params);
	}
	
	private function _Init(){		
		$this->_Display = new Display(new Html());
		$this->_Login = new Login();		
		$this->_is_logged_in = $this->_Login->is_logged_in;
	}
	
}
