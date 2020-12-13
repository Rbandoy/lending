<?php $this->load->view('component/top');?>

<div class="container-fluid">
         
         </div><!-- row -->
   
         <div class="col-xs-12 ">
               
           <div class="container-fluid">
             <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Admin</h1> 
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
          </div> 
               <div class="panel-body" style="height: 600px;overflow-y: scroll;">
   
                 <table id="example" class="table table-striped table-bordered" style="width:100%;height: 600;overflow-y: scroll;">
                 <?php $countofarray = count($admin); echo 'Count: '.count($admin);?>
                     <thead>
                         <tr>
                             <th>Action</th>
                             <th>Name</th>
                             <th>Address</th>
                             <th>Gender</th>
                             <th>Username</th>
                             <th>Password</th>
                         </tr>
                     </thead>
                     <tbody>
                       <?php for($x = 0; $x < $countofarray; $x++){ ?>
                         <tr>
                             <td>
                              <a href='#' onclick='action("<?php echo $admin[$x]["id"];?>")'  data-toggle="modal" data-target="#deactivateAccount" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i>Action</a>
                             </td>
                             <td><?php echo $admin[$x]['lname'].''.$admin[$x]['name']." ".$admin[$x]['mi']; ?></td>
                             <td><?php echo $admin[$x]['address']; ?></td>
                             <td><?php echo $admin[$x]['gender']; ?></td>
                             <td><?php echo $admin[$x]['username']; ?></td>
                             <td><?php echo $admin[$x]['password']; ?></td>  
                        </tr>
                       <?php } ?>
                     </tbody>
                     <tfoot>
                         <tr>
                            <th>Action</th>
                             <th>Name</th>
                             <th>Address</th>
                             <th>Gender</th>
                             <th>Username</th>
                             <th>Password</th>
                         </tr>
                     </tfoot>
                 </table>
   
               </div>
           </div>
   
         </div>
   
       </div><!-- contentpanel -->  

<?php $this->load->view('component/bottom');?>


