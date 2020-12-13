<!-- deactivate account -->
<!-- Modal -->
<div class="modal  bd-example-modal-lg fade" id="deactivateAccount" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md-6" role="document">
    <div class="modal-content col-md-12">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Action</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?php echo base_url().'Admin/deactivate';?>" method='post'> 
            <div class="form-group"> 
              <div class='row'> 
                  <input type="text" id='adminId' name='adminId' value='' hidden/>
                  <div class='col-md-6'>   
                    <button type="submit" id='deactivate' class="btn btn-primary form-control m-2">Deactivate</button>
                  </div>
                  <div class='col-md-6'>   
                    <button type="button" class="btn btn-secondary form-control m-2" data-dismiss="modal">Close</button>
                  </div>
              </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>
<!-- end deactivate account -->

<!-- deactivate account -->
<!-- Modal -->
<div class="modal  bd-example-modal-lg fade" id="borrowerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md-6" role="document">
    <div class="modal-content col-md-12">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Action</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?php echo base_url().'borrower/archiveBorrower';?>" method='post'> 
            <div class="form-group"> 
              <div class='row'>
                  <input type="text" id='borrowerId' name='borrowerId' value=''hidden/>
                  <p><i>NOTE:</i> Archiving borrower can loss loan data!<p>
                  <div class='col-md-6'>   
                    <button type="submit" id='deactivate' class="btn btn-primary form-control m-2">Archive</button>
                  </div>
                  <div class='col-md-6'>   
                    <button type="button" class="btn btn-secondary form-control m-2" data-dismiss="modal">Close</button>
                  </div>
              </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>
<!-- end deactivate account -->

<!-- borrow money Modal -->
<div class="modal  bd-example-modal-lg fade" id="borrowMoneyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg-12" role="document">
    <div class="modal-content col-lg-12">
      <div class="modal-header"> 
      <h5 class="modal-title" id="exampleModalLabel">Borrow Money</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <h5 class="modal-title" id="transNo"></h5>
      <div class="modal-body">
        <!-- <form action="<?php echo base_url().'borrower/borrowMoney';?>" method='post'>  -->
            <div class="form-group"> 
              <div class='row'>
                  <input required type="text" id='borrowMoneyId' name='bId' value='' hidden/>
                  <div class="form-group row">
                    <div class="col-sm-4 mb-2 mb-sm-0">
                    <label for="bLname">Last Name:</label>
                      <input type="text" class="form-control form-control-user" id="bLname" readonly>
                    </div>
                    <div class="col-sm-4">
                      <label for="bFname">First Name:</label>
                      <input type="text" class="form-control form-control-user" id="bFname" readonly>
                    </div>
                    <div class="col-sm-4"> 
                      <label for="bMname">MI:</label>
                      <input type="text" class="form-control form-control-user" id="bMname" readonly>
                    </div>
                  </div>
                  <div class="form-group row"> 
                    <div class="col-sm-4  mb-3 mb-sm-0">
                      <label for="bAmount">Amount Borrow:</label>
                      <input type="text" class="form-control form-control-user" name='bAmount'  id="bAmount" placeholder="AMOUNT">
                    </div>
                    <div class="col-sm-4">
                      <label for="selectRate">Interest: </label>
                      <select required name="selectRate" class="form-control form-control-user" id="selectRate">
                          <?php $countofarray = count($rates);?>
                          <?php for($x = 0; $x < $countofarray; $x++){ ?> 
                                <option value="<?php echo $rates[$x]['percent'];?>"><?php echo $rates[$x]['percent'].'%';?></option>
                          <?php } ?>
                      </select>
                    </div>
                    <div class="col-sm-4">
                      <label for="bdate">Borrow Date:</label>
                      <input required type="date" class="form-control form-control-user" id="bDate" name='bDate' placeholder="Borrow Date" onchange="handler(event);">
                    </div>
                    <div class="col-sm-4">
                      <label    for="bMonths">Month to Pay:</label>
                      <select required name="bMonths" class="form-control form-control-user" id="bMonths"> 
                          <?php for($x = 6; $x < 13; $x++){ ?> 
                                <option selected value="<?php echo $x;?>"><?php echo $x;?></option>
                          <?php } ?>
                      </select>
                    </div>
                  </div>

                   
                   
                  <div class="form-group row mr-3 ml-3">
                    <div class='col-sm-6  mb-3 mb-sm-0'>   
                      <button onclick="borrowMoneyEntry()" type="button" id='borrowMoney' name='borrowMoney' class="btn btn-primary form-control m-2">Borrow</button>
                    </div>
                    <div class='col-sm-6'>   
                      <button type="button" class="btn btn-secondary form-control m-2" data-dismiss="modal">Close</button>
                    </div>
                  </div> 
              </div>
            </div>
        <!-- </form> -->
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>
<!-- end deactivate account -->

<!-- Create Borrower -->
<div class="modal  bd-example-modal-lg fade" id="createBorrower" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md-6" role="document">
    <div class="modal-content col-md-12">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Borrower</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?php echo base_url().'Admin/deactivate';?>" method='post'> 
            <div class="form-group"> 
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" id="fname" placeholder="First Name">
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user" id="lname" placeholder="Last Name">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" id="mname" placeholder="Middle Name">
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user" id="age" placeholder="Age">
                  </div>
                </div>
                <div class="form-group row">
                  <div class='col-md-6'>   
                    <label class="gender">Gender:</label>
                    <select class="form-control" id="gender">
                      <option disabled selected>--SELECT--</option>
                      <option pointer value = 'male'>Male</option>
                      <option pointer value = 'female'>Female</option>
                    </select>
                  </div>
                  <div class="col-sm-6">
                  <label for="bdate">Birth Date:</label>
                    <input type="date" class="form-control form-control-user" id="bdate" placeholder="Birth Date">
                  </div>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" id="street" placeholder="Street">
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" id="muni" placeholder="Municipality">
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user" id="city" placeholder="City">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" id="country" placeholder="Country">
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user" id="sourceofincome" placeholder="Source Of Income">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" id="occupation" placeholder="Occupation">
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user" id="providedId" placeholder="ID TYPE">
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user" id="idNo" placeholder="ID NUMBER">
                  </div>
                </div>
                <!-- <?php $this->load->view('component/loading');?> -->
                <a href="#" id="createAccount" onClick="createAccount();" class="btn btn-primary btn-user btn-block">
                  Register Borrower
                </a>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>
<!-- end Create Borrower -->


<!-- Modal make payment -->
<div class="modal  bd-example-modal-lg fade" id="makepaymentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md-6" role="document">
    <div class="modal-content col-md-12">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Action</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body"> 
            <div class="form-group"> 
              <div class='row'>
                  <input type="text" id='entryId' name='entryId' value='' hidden/> 
                  <div id='partialDivForm'>
                    <div class="form-group row">
                      <div class="col-sm-4 mb-2 mb-sm-0"> 
                      <label for="interestDue">Monthly Interest:</label>
                        <input type="text" class="form-control form-control-user" id="interestDue" readonly>
                      </div>
                      <div class="col-sm-4">
                        <label for="principalDue">Monthly Principal:</label>
                        <input type="text" class="form-control form-control-user" id="principalDue" readonly>
                      </div>
                      <div class="col-sm-4"> 
                        <label for="totalDue">Total Monthly Due:</label>
                        <input type="text" class="form-control form-control-user" id="totalDue" readonly>
                      </div>
                      <div class="col-sm-4"> 
                        <label for="monthlyBalance">Total Monthly Balance:</label>
                        <input type="text" class="form-control form-control-user" id="monthlyBalance" readonly>
                      </div>
                    </div>  
                  </div>
                  <div id='fullpaymentDivForm'>
                    <div class="form-group row"> 
                      <div  class="col-sm-4  mb-2 mb-sm-0"> 
                        <label for="totalpayment">Partial Amount:</label>
                        <input type="text" class="form-control form-control-user" id="totalpayment" readonly>
                        <i><p><small>Total amount posted</small><p></i>
                      </div>
                      <div  class="col-sm-4"> 
                        <label for="penalty">Penalty:</label>
                        <input type="text" class="form-control form-control-user" id="penalty" readonly>
                        <i><p><small>Total penalty of all month/s</small><p></i>
                      </div>
                      <div  class="col-sm-4"> 
                        <label for="totalDuewpartial">Total Balance Due:</label>
                        <input type="text" class="form-control form-control-user" id="totalDuewpartial" readonly>
                        <i><p><small>From partial payment</small><p></i>
                      </div>
                      <div class="col-sm-4"> 
                      <label for="Balance">Full Balance: </label> 
                        <input type="text" class="form-control form-control-user" id="Balance" readonly>
                        <i><p><small>with balance on previous month/s</small><p></i>
                      </div>
                       
                    </div> 
                  </div>
                    <div id="postAmountDiv" class="form-group row">  
                      <div  class="col-sm-4  mb-2 mb-sm-0"> 
                      </div>
                      <div  id="penaltyDiv" class="col-sm-4"> 
                      </div>
                    </div>
                    
                    <div  id='fullpaymentDiv' class='col-md-6'>    
                    </div> 
                    <div id='paymonthlyDiv' class='col-md-6'>    
                    </div>
                    <div id='addpenaltyDiv' class='col-md-6'>    
                    </div>
                  <div class="form-group row">
                    <div class="col-sm-4 mb-2 mb-sm-0">  
                    </div>  
                  </div> 
                  <!-- <div class='col-md-6'>   
                    <button type="button" class="btn btn-secondary form-control m-2" data-dismiss="modal">Close</button>
                  </div> -->
              </div>
            </div> 
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>
<!-- end deactivate account -->

<!-- Create Borrower -->
<div class="modal  bd-example-modal-lg fade" id="shareModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md-6" role="document">
    <div class="modal-content col-md-12">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Borrower's Share</h5>
       
        <button type="button" id="closeShareModal" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        
      </div>
      <div id="shareReceipt"></div>
      <div class="modal-body">
      
        <div class="form-group row"> 
        <input type="text" id='shareId' class="form-control form-control-user" name='shareId' value='' hidden/>  
        
          <input type="text" id='Sharefname' class="form-control form-control-user" name='Sharefname' value='' readonly/>  
            <div class="form-group row"> 
              <table class="table table-bordered mb-4" id="dataTable" width="100%" cellspacing="0">  
                  <tr>
                    <td><label for="principalDue">Total Share Purchase:</label>
                    <input type="text" class="form-control form-control-user" id="sharePurchase" readonly></td>
                    <td><label for="principalDue">Value:</label>
                    <input type="text" class="form-control form-control-user" id="sharePurchaseValue" readonly></td>
                  </tr>
                  <tr>
                    <td><label for="principalDue">Total Share Withdraw:</label>
                    <input type="text" class="form-control form-control-user" id="shareWithdraw" readonly></td>
                    <td><label for="principalDue">Value:</label>
                    <input type="text" class="form-control form-control-user" id="shareWithdrawValue" readonly></td>
                  </tr>
                  <tr>
                    <td><label for="principalDue">Ending Share Balance:</label>
                    <input type="text" class="form-control form-control-user" id="shareBalance" readonly></td>
                    <td><label for="principalDue">Value:</label>
                    <input type="text" class="form-control form-control-user" id="shareBalanceValue" readonly></td>
                  </tr>
                  <tr>
                    <td><button type="button" onClick='showBuyShare()' style="padding: 12px 24px;width:100%" id="btnBuyShare" class="btn btn-success">Buy Share</button></td>
                    <td><button type="button" onCLick="showWithdrawShare()" style="padding: 12px 24px;width:100%" id="btnWithdrawShare" class="btn btn-success">Withdraw Share</button></td>
                  </tr>
                  <tr id="showActionShare"> 
                  </tr>
              </table>   
            </div>   
        </div>
        <div class="form-group row"> 
        <div class="panel-body" style="width:100%;height: 200px;overflow-y: scroll;"> 
        <div class="table-responsive">
        <label for="dataTable">Share History:</label>
          <table class="table table-bordered mb-4" id="dataTable" width="100%" cellspacing="0">  
                  <thead>
                    <tr>  
                      <th>Date</th>
                      <th>Transaction</th>
                      <th>Amount</th> 
                      <th>Balance</th>
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
                  
                  <tbody id='dataShare'>  
                        
                  </tbody>
                </table>
                </div>
                </div>
          </div>
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>
<!-- end Create Borrower -->

<script>
  function showBuyShare() {
    $("#showActionShare").empty();
    $("#showActionShare").append(`
    <td><label for="inputBuyShare">Number Of Share:</label>
                    <input type="text" class="form-control form-control-user" id="inputBuyShare"> 
     <button type="button" style="padding: 12px 24px;margin-top:5px;width:100%;heigth:100%" onClick="buyShare()" id="btnWithdrawShare" class="btn btn-primary">Comfirm Buy Share</button></td>
    `);
  }

  function showWithdrawShare() {
    $("#showActionShare").empty();
    $("#showActionShare").append(`
    <td><label for="inputWithdrawShare">Number Of Share:</label>
                    <input type="text" class="form-control form-control-user" id="inputWithdrawShare"> 
     <button type="button" style="padding: 12px 24px;margin-top:5px;width:100%;heigth:100%" onClick="withdrawShare()" id="btnWithdrawShare" class="btn btn-primary">Comfirm Withdraw Share</button></td>
    `);
  }

</script>