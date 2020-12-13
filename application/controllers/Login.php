<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
  public function __construct() {
    parent::__construct();
    $this->load->model('sp_model');
    $this->user = $this->session->userdata('user');
  }
 
	public function index()
	{   
    $username = $this->input->post('username');
    $password = $this->input->post('password');
    $data['message'] = '';
    if ($this->user) {
      redirect(base_url().'Main');
    }
    if (isset($_POST['btnlogin'])) {
      // print_r($username,$password);exit();
      $res = $this->sp_model->login($username, $password);   
      if (count($res) > 0) {
        $user = $this->session->set_userdata('user',$res);
        // print_r($user);exit();
        $data['message'] = $res;
        redirect(base_url().'Main');
      } else { 
        $data['message'] = 'NO DATA'; 
        $data['s'] = 0; 
      }
    } 
    $this->load->view("login", $data); 
  }

  public function logout() {
    $this->session->sess_destroy();  
    redirect(base_url().'Login');
  }
}
