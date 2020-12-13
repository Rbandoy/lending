<!DOCTYPE html>
<html lang="en">

<head> 
  <?php $this->load->view('component/header');?>
  <?php $this->load->view('component/modal');?> 
  <?php $this->load->view('component/script');?> 
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <?php $this->load->view('component/sidebar');?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content"> 
          <?php $user=$this->session->userdata('user'); $this->load->view('component/topbar', $user[0]);?> 
 