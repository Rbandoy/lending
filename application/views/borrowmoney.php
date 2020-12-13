<?php $this->load->view('component/top');?>

        <!-- Begin Page Content -->
        <div class="container-fluid"> 
          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">MAKE PAYMENT</h1>
            <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
          </div> 
          <!-- Content Row -->
          <div class="col-xs-12">
            <span class="errorMessage" id="transpassError"></span>
             <div class="panel panel-primary"> 
            <div style="padding: 5px;padding-left: 10px">
              <div class="form-group">
                  <label for="checkrefno">Check Reference Number:</label>
                  <input type="checkrefno" value='' style="width: 210px" class="form-control" id="checkrefno" placeholder="Enter Reference Number" name="checkrefno">
                  <input type="hidden" class="form-control" id="saverefno" name="saverefno">
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-sm-7">
                    <button type="button" style="padding: 12px 24px;" id="btnCheckRefno" class="btn btn-success">Check Reference Number</button>
                  </div>
                </div>
              </div>
            </div>
            <div class="panel-body" style="height: 600px;overflow-y: scroll;"> 
              <div id="showResponseForCheckRef">

              </div>
             
              <div id="showForm" hidden>
              <div id="receipt"></div>
              
                <div class="form-group">
                  <div class="row">
                    <div id="info" class="col-md-7">
                      <hr>
                    </div>
                  </div>
                </div>

                <div class="card-body pt-10">
                  <div class="table-responsive">
                  <table class="table table-bordered mb-4" id="dataTable" width="100%" cellspacing="0">  
                  <thead>
                    <tr> 
                      <th hidden>ID</th> 
                      <th>Interest Due</th>
                      <th>Principal Due</th>
                      <th>Penalty</th>
                      <th>Total Due</th>
                      <th>Balance</th>
                      <th>Due Date</th>
                      <th>Payment</th>
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
                  <tbody id='data'>  
                         <tr> 
                            <td hidden> </td>
                            <td> </td>
                             <td> </td>
                             <td> </td>  
                             <td> </td>   
                             <td> </td>  
                             <td> </td>
                             <td> </td>  
                             <td> </td>  
                        </tr> 
                  </tbody>
                </table>
              </div>
            </div>

              </div>
          </div>
          

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

<?php $this->load->view('component/bottom');?>

<script>
  $("#btnCheckRefno").click(function(){
    $("#transpassError").hide();
    $("#TransPass").val("");

    $("#btnCheckRefno").html('Searching..');
    $("#btnCheckRefno").append('<i id="loadingcheckRef" style="color: yellow" class="fa fa-circle-o-notch fa-spin"></i>');

    let refno = $("#checkrefno").val();
  
          var form = new FormData();
            form.append("refno", refno); 

            var settings = {
            "url": "http://127.0.0.1:8888/Api/CheckRef",
            "method": "POST",
            "timeout": 0, 
            "processData": false,
            "mimeType": "multipart/form-data",
            "contentType": false,
            "data": form, 
            error: function(result){
                  alert("Internal Server Error Please Contact Administrator");  
            }
            };

            $.ajax(settings).done(function (response) { 
              let datum = JSON.parse(response);
              console.log(datum['result']);
              $('#data').empty();
              $('#info').empty();
              $('#receipt').empty();
              
              let message = ``;
              let td = ``;

              if(datum['result'].length == 0){
                message = `Invalid Reference Number`; 
                $("#loadingcheckRef").hide();
                $("#btnCheckRefno").html('Check Reference Number'); 
                $("#showResponseForCheckRef").html("<span style='color: red;'>* <b>"+message+"</b></span>");
                $("#showResponseForCheckRef").show(); 
                $('#showForm').attr('hidden', true);
                return;
              } else {
                
                $('#showForm').attr('hidden', false);
                $("#loadingcheckRef").hide();  
                $("#showResponseForCheckRef").hide(); 
                $("#btnCheckRefno").html('Check Reference Number');
                $("#receipt").append(`<a target="_blank" href="http://localhost:9999/portal/lending_receipt/`+refno+`" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Print Receipt</a>`);
                $("#info").append('Fullname: <b><strong>'+datum['result'][0]['fullname']+'</strong></b>');  
                let fullpayment = 'fullpayment';
                let partial = 'partial';
                for (let x = 0; x <datum['result'].length; x++) {
                  if (x==0) {
                    $('#data').append(`
                    <tr style="background-color:yellow">  
                    <td>`+datum['result'][x]['interestDue']+`</td>
                    <td>`+datum['result'][x]['principalDue']+`</td>
                    <td>`+datum['result'][x]['penalty']+`</td>
                    <td>`+datum['result'][x]['totalDue']+`</td>
                    <td>`+datum['result'][x]['Balance']+`</td>
                    <td>`+datum['result'][x]['dueDate']+`</td>
                    <td>DATE POSTED</td>
                    </tr>
                    `); 
                  } else {
                    if (datum['result'][x]['status'] == 0) {
                      if (datum['result'][x]['Balance'] == 0) {
                        $('#data').append(`
                        <tr>  
                        <td>`+datum['result'][x]['interestDue']+`</td>
                        <td>`+datum['result'][x]['principalDue']+`</td>
                        <td>`+datum['result'][x]['penalty']+`</td>
                        <td>`+datum['result'][x]['totalDue']+`</td>
                        <td>`+datum['result'][x]['Balance']+`</td>
                        <td>`+datum['result'][x]['dueDate']+`</td>
                        <td>  
                              <a href='#' onclick='assignBorrowEntry(`+datum['result'][x]['id']+","+datum['result'][x]['interestDue']+","+datum['result'][x]['principalDue']+","+datum['result'][x]['totalDue']+","+datum['result'][x]['Balance']+`)'  data-toggle="modal" data-target="#makepaymentModal" class="d-none d-sm-inline-block btn btn-l btn-primary shadow-sm"><i class="fas fa-money fa-sm text-white-50">Full Payment</i></a>
                        </td>
                        </tr>
                        `); 
                      } else { 
                        $('#data').append(`
                        <tr>  
                        <td>`+datum['result'][x]['interestDue']+`</td>
                        <td>`+datum['result'][x]['principalDue']+`</td>
                        <td>`+datum['result'][x]['penalty']+`</td>
                        <td>`+datum['result'][x]['totalDue']+`</td>
                        <td>`+datum['result'][x]['Balance']+`</td>
                        <td>`+datum['result'][x]['dueDate']+`</td>
                        <td>  
                              <a href='#' onclick='assignBorrowEntry(`+datum['result'][x]['id']+","+datum['result'][x]['interestDue']+","+datum['result'][x]['principalDue']+","+datum['result'][x]['totalDue']+","+datum['result'][x]['Balance']+`)'  data-toggle="modal" data-target="#makepaymentModal" class="d-none d-sm-inline-block btn btn-l btn-primary shadow-sm"><i class="fas fa-money fa-sm text-white-50">Make Payment</i></a>
                              <a href='#' onclick='addPenalty(`+datum['result'][x]['id']+","+datum['result'][x]['interestDue']+","+datum['result'][x]['principalDue']+","+datum['result'][x]['totalDue']+","+datum['result'][x]['Balance']+`)'  data-toggle="modal" data-target="#makepaymentModal" class="d-none d-sm-inline-block btn btn-l btn-primary shadow-sm"><i class="fas fa-money fa-sm text-white-50">PARTIAL PAYMENT</i></a>                      
                        </td>
                        </tr>
                        `); 
                      }
                    } else if(datum['result'][x]['status'] == 1) {
                      $('#data').append(`
                      <tr style="background-color:yellow">  
                      <td>`+datum['result'][x]['interestDue']+`</td>
                      <td>`+datum['result'][x]['principalDue']+`</td>
                      <td>`+datum['result'][x]['penalty']+`</td>
                      <td>`+datum['result'][x]['totalDue']+`</td>
                      <td>`+datum['result'][x]['Balance']+`</td>
                      <td>`+datum['result'][x]['dueDate']+`</td>
                      <td>`+datum['result'][x]['payment']+` PAID</td>
                      </tr>
                      `); 
                    } else if(datum['result'][x]['status'] == 3) {
                      $('#data').append(`
                      <tr style="background-color:pink">  
                      <td>`+datum['result'][x]['interestDue']+`</td>
                      <td>`+datum['result'][x]['principalDue']+`</td>
                      <td>`+datum['result'][x]['penalty']+`</td>
                      <td>`+datum['result'][x]['totalDue']+`</td>
                      <td>`+datum['result'][x]['Balance']+`</td>
                      <td>`+datum['result'][x]['dueDate']+`</td>
                      <td>`+datum['result'][x]['payment']+`</td>
                      </tr>
                      `); 
                    }
                  }
                } 
              }
            });
  });
</script>