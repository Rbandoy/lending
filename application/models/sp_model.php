<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
class sp_model extends CI_Model {
  public function login($username, $password) {
    $result = $this->db->query("CALL sp_login('$username', '$password')");
    $result =  $result->result_array(); 
    return $result;  
  }

  public function getAdmin() {
    $result = $this->db->query("select * from admin where status = '1'");
    $result = $result->result_array();
    return $result;
  }

  public function getBorrower() {
    $result = $this->db->query("select * from borrower where status = 1");
    $result = $result->result_array();
    return $result;
  }

  public function getBorrowersLoan() {
    $result = $this->db->query("SELECT borrower.*, `borrowentry`.`transNo` FROM borrower,`borrowentry` WHERE borrower.status = 1 AND `borrowentry`.status = 0 AND `borrower`.id = `borrowentry`.`borrowerId`   GROUP BY `borrower`.id");
    $result = $result->result_array();
    return $result;
  }

  public function checkRefno($checkRefno) {
    $result = $this->db->query("SELECT borrowentry.*,(select concat(fname,', ',lname) from  borrower where id = borrowentry.borrowerId) AS fullname FROM borrowentry where borrowentry.borrowerId in (select id from borrower where status = 1)  and transNo = '$checkRefno'");
    $result = $result->result_array();
    return $result;
  }

  public function checkPaymentHistory($checkRefno) {
    $result = $this->db->query("CALL payment('$checkRefno')");
    $result = $result->result_array();
    return $result;
  }

  public function postPartialPayment($id, $penalty, $partialAmount) {
    $result = $this->db->query("CALL addPartialAmount('$id','$penalty','$partialAmount')");
    $result = $result->result_array();
    return $result;
  }

  public function fullPayment($id, $amount) {
    $result = $this->db->query("CALL addFullpayment('$id','$amount')");
    $result = $result->result_array();
    return $result;
  }

  public function monthlyPayment($id, $amount) {
    $result = $this->db->query("CALL monthlypayment('$id','$amount')");
    $result = $result->result_array();
    return $result;
  }

  public function getRate() {
    $result = $this->db->query("select * from rates");
    $result = $result->result_array();
    return $result;
  }

  public function getDashboardData() {
    $result = $this->db->query("CALL getDashboardData()");
    $result = $result->result_array();
    return $result;
  }

  public function getChartData() {
    $result = $this->db->query("SELECT SUM(payment) as payment, dueDate as dueDate FROM borrowentry where payment is not NULL and dueDate is not NULL GROUP BY dueDate;");
    $result = $result->result_array();
    return $result;
  }

  public function getBorrowerTransaction() {
    $result = $this->db->query("SELECT borrowerTransaction.*,(select concat(fname,', ',lname) from  borrower where id = borrowerTransaction.borrowerId) AS fullname FROM borrowerTransaction where borrowerTransaction.borrowerId in (select id from borrower where status = 1) ");
    $result = $result->result_array();
    return $result;
  }

  public function getBorrowerEntry() {
    $result = $this->db->query("SELECT borrowentry.*,(select concat(fname,', ',lname) from  borrower where id = borrowentry.borrowerId) AS fullname FROM borrowentry where borrowentry.borrowerId in (select id from borrower where status = 1) ");
    $result = $result->result_array();
    // print_r($result);exit();
    return $result;
  }

  public function deactivateAccount($table,$id) {
    $result = $this->db->query("update $table set status='0' where id = '$id'");
    return $result;
  }

  public function createBorrower(
    $fname,
    $mname,
    $lname,
    $age,
    $gender,
    $bdate,
    $street,
    $muni,
    $city,
    $country,
    $sourceofincome,
    $occupation,
    $providedId,
    $idNo
  ) {
    $result = "";

    
      $result = $this->db->query("call sp_createBorrower('$fname',
      '$mname',
      '$lname',
      '$age',
      '$gender',
      '$bdate',
      '$street',
      '$muni',
      '$city',
      '$country',
      '$sourceofincome',
      '$occupation',
      '$providedId',
      '$idNo')");  
      $result = $result->result_array();
      
    return $result; 
  }

  public function borrowMoney($bId,$bAmount,$selectRate,$bDate,$bTotalAmount,$bDueDate,$bMonths) { 
    //  var_dump($bId,$bAmount,$selectRate,$bDate,$bTotalAmount,$bDueDate,$bMonths);exit();
    $result = $this->db->query("Call borrow_entry('$bId','$bAmount','$selectRate','$bDate','$bTotalAmount','$bDueDate','$bMonths')"); 
    $result =  $result->result_array();  
    return $result; 
  }

  public function getShare($bId) { 
    //  var_dump($bId,$bAmount,$selectRate,$bDate,$bTotalAmount,$bDueDate,$bMonths);exit();
    $result = $this->db->query("select * from share where borrowerId = '$bId'"); 
    $result =  $result->result_array();  
    return $result;
  }

  public function getShareHistory($bId) { 
    //  var_dump($bId,$bAmount,$selectRate,$bDate,$bTotalAmount,$bDueDate,$bMonths);exit();
    $result = $this->db->query("select * from sharelogs where borrowerId = '$bId'"); 
    $result =  $result->result_array();  
    return $result;
  }

  public function buyShare($bId, $amount) {  
    $result = $this->db->query("call buyShare('$bId','$amount')"); 
    $result =  $result->result_array();  
    return $result;
  }

  public function withdrawShare($bId, $amount) {  
    $result = $this->db->query("call withdrawShare('$bId','$amount')"); 
    $result =  $result->result_array();  
    return $result;
  }

}