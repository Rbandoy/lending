<?php $this->load->view('component/top');?>
 
       <div class="container-fluid">  
          <!-- DataTales Example -->
          <div class="card shadow mb-12">
         
            <div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
              <h1 class="h3 mb-0 text-gray-800">Member's Loan List</h1>
              <a href="#"  data-toggle="modal" data-target="#createBorrower"  class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Add Member</a>
         
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0"> 
                <?php $countofarray = count($borrower);?>
                  <thead>
                    <tr>
                       
                      <th>Fullname</th>
                      <th>Address</th>
                      <th>Age</th>
                      <th>Gender</th>
                      <th>Transaction Number</th> 
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
                             <td><?php echo $borrower[$x]['lname'].', '.$borrower[$x]['fname']." ".$borrower[$x]['mname']; ?></td>
                             <td><?php echo $borrower[$x]['street'].' '.$borrower[$x]['muni'].' '.$borrower[$x]['city'].' '.$borrower[$x]['country']; ?></td>
                             <td><?php echo $borrower[$x]['age']; ?></td>
                             <td><?php echo $borrower[$x]['gender']; ?></td>
                             <td></i><B><?php echo $borrower[$x]['transNo']; ?></B></i></td>   
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
 