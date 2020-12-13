<?php $this->load->view('component/top');?>
 
       <div class="container-fluid">  
          <!-- DataTales Example -->
          <div class="card shadow mb-12">
            <div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
              <h1 class="h3 mb-0 text-gray-800">GENERAL REPORT</h1>
              <!-- <a href="#"  data-toggle="modal" data-target="#createBorrower"  class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Add Payment</a> -->
            </div> 
            <div class="card-body pt-10">
              <div class="table-responsive">
                <table class="table table-bordered mb-4" id="dataTable" width="100%" cellspacing="0"> 
                <?php $countofarray = count($borrowerTransaction);?>
                  <thead>
                    <tr> 
                      <th hidden>ID</th>
                      <th>fullname</th>
                      <th>transNo</th>
                      <th>interestDue</th>
                      <th>principalDue</th>
                      <th>penalty</th>
                      <th>Total Due</th>
                      <th>Balance</th>
                      <th>dueDate</th>
                    </tr>
                  </thead>
                  <!-- <tfoot>
                    <tr>
                      <th>Action</th>
                      <th>Fullname</th>
                      <th>Address</th>
                      <th>Age</th>
                      <th>Gender</th>
                      <th>Source Of Income</th>
                      <th>Occupation</th>
                    </tr>
                  </tfoot> -->
                  <tbody> 
                  <?php for($x = 0; $x < $countofarray; $x++){ ?>
                         <tr> 
                            <td hidden><?php echo $borrowerTransaction[$x]['borrowerId']; ?></td>
                            <td><?php echo $borrowerTransaction[$x]['fullname']; ?></td>
                             <td><?php echo $borrowerTransaction[$x]['transNo']; ?></td>
                             <td><?php echo $borrowerTransaction[$x]['interestDue']; ?></td>  
                             <td><?php echo $borrowerTransaction[$x]['principalDue']; ?></td>   
                             <td><?php echo $borrowerTransaction[$x]['penalty']; ?></td>  
                             <td><?php echo $borrowerTransaction[$x]['totalDue']; ?></td>
                             <td><?php echo $borrowerTransaction[$x]['Balance']; ?></td>  
                             <td><?php echo $borrowerTransaction[$x]['dueDate']; ?></td>  
                        </tr>
                       <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

<?php $this->load->view('component/bottom');?>


 <!-- Page level plugins -->

 <!-- Page level plugins -->
 <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>
 