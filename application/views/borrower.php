<?php $this->load->view('component/top');?>
 
       <div class="container-fluid">  
          <!-- DataTales Example -->
          <div class="card shadow mb-12">
         
            <div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
              <h1 class="h3 mb-0 text-gray-800">Borrower</h1>
              <a href="#"  data-toggle="modal" data-target="#createBorrower"  class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Add Borrower</a>
         
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0"> 
                <?php $countofarray = count($borrower);?>
                  <thead>
                    <tr>
                      <th>Action </th> 
                      <th>Fullname</th>
                      <th>Address</th>
                      <th>Age</th>
                      <th>Gender</th>
                      <th>Source Of Income</th>
                      <th>Occupation</th>
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
                              <td>
                                <a href='#' onclick='assignBorrowerShare("<?php echo $borrower[$x]["id"];?>","<?php echo $borrower[$x]["lname"].", ".$borrower[$x]["fname"]." ".$borrower[$x]["mname"]; ?>")'  data-toggle="modal" data-target="#shareModal" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-list fa-sm text-white-50">View Share</i></a>
                                <a href='#' onclick='assignBorrowerId("<?php echo $borrower[$x]["id"];?>")'  data-toggle="modal" data-target="#borrowerModal" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-archive fa-sm text-white-50"> Manage</i></a>
                              <?php if ($borrower[$x]['hasloan'] == 1) { ?>
                                <a  href='http://127.0.0.1:8888/Borrowersloan'   class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm mt-1"><i class="fas fa-search fa-sm text-white-50"> View Loan</i></a>
                              <?php } else { ?>
                                <a href='#' onclick='borrowMoney("<?php echo $borrower[$x]["id"];?>", "<?php echo $borrower[$x]["fname"];?>","<?php echo $borrower[$x]["lname"];?>", "<?php echo $borrower[$x]["mname"];?>")'  data-toggle="modal" data-target="#borrowMoneyModal" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm mt-1"><i class="fas fa-plus fa-sm text-white-50"> Borrow</i></a>
                              <?php }?>
                              </td>
                             <td><?php echo $borrower[$x]['lname'].', '.$borrower[$x]['fname']." ".$borrower[$x]['mname']; ?></td>
                             <td><?php echo $borrower[$x]['street'].' '.$borrower[$x]['muni'].' '.$borrower[$x]['city'].' '.$borrower[$x]['country']; ?></td>
                             <td><?php echo $borrower[$x]['age']; ?></td>
                             <td><?php echo $borrower[$x]['gender']; ?></td>
                             <td><?php echo $borrower[$x]['sourceofincome']; ?></td>  
                             <td><?php echo $borrower[$x]['occupation']; ?></td>  
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
 