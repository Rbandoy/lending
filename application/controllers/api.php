<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Api extends CI_Controller {

	public function __construct() {
    parent::__construct();
    $this->load->model('sp_model'); 
    $this->load->helper(array('dompdf', 'file'));
    $this->load->helper('url');
  } 

	function GeneratePdf(){
		$DATA['C_TYPE'] = 'asdasd';
		$DATA['User'] = 'asdas'; 
		$this->load->helper('url');
		$text = $this->load->view('receipt', $DATA,true);
		pdf_create($text, 'ECASHPAY_CASHOUT_'.$DATA['C_TYPE']); 
  }
  
	public function borrowMoney() {
		$bId = $this->input->post('bId');
		$bAmount =  $this->input->post('bAmount');
		$selectRate =  $this->input->post('selectRate');
		$bDate =  $this->input->post('bDate');
		$bTotalAmount =  $this->input->post('bTotalAmount');
		$bDueDate =  $this->input->post('bDueDate');
		$bMonths =  $this->input->post('bMonths');
		$res = $this->sp_model->borrowMoney($bId,$bAmount,$selectRate,$bDate,$bTotalAmount,$bDueDate,$bMonths);  
		echo json_encode($res);
	}
	
	public function CheckRef() {
		$refno = $this->input->post('refno');
		// $refno = '3213';
		$res['result'] = $this->sp_model->checkRefno($refno);  
		echo json_encode($res, true);
	}
	
	public function getPaymentHistory() {
		$id = $this->input->post('id');
		// $id = '321220201210164800';
		$res = $this->sp_model->checkPaymentHistory($id);  
		echo json_encode($res, true);
	}
	public function postPartialPayment() {
		$id = $this->input->post('id');
		$penalty = $this->input->post('penalty');
		$partial = $this->input->post('partialAmount');
		// $id = '1331,0,533.33';c
		// $id = 1331;
		// $partial = 100;
		// $penalty = 90;
		$res = $this->sp_model->postPartialPayment($id, $penalty, $partial);  
		echo json_encode($res, true);
	}

	public function fullPayment() {
		$id = $this->input->post('id');
		$amount = $this->input->post('amount'); 
		// $id = '1331,0,533.33';c
		// $id = 1331;
		// $partial = 100;
		// $penalty = 90;
		$res = $this->sp_model->fullPayment($id, $amount);  
		echo json_encode($res, true);
	}

	public function monthlyPayment() {
		$id = $this->input->post('id');
		$amount = $this->input->post('amount'); 
		// $id = '1331,0,533.33';c
		// $id = 1331;
		// $partial = 100;
		// $penalty = 90;
		$res = $this->sp_model->monthlyPayment($id, $amount);  
		echo json_encode($res, true);
	}

	public function getShare() {
		$id = $this->input->post('id'); 
		$res = $this->sp_model->getShare($id);  
		echo json_encode($res, true);
	}

	public function getShareHistory() {
		$id = $this->input->post('id'); 
		$res = $this->sp_model->getShareHistory($id);  
		echo json_encode($res, true);
	}
	
	public function buyShare() {
		$id = $this->input->post('id');
		$amount = $this->input->post('amount');  
		$res = $this->sp_model->buyShare($id, $amount);  
		echo json_encode($res, true);
	}

	public function withdrawShare() {
		$id = $this->input->post('id');
		$amount = $this->input->post('amount');  
		$res = $this->sp_model->withdrawShare($id, $amount);  
		echo json_encode($res, true);
	}
}
