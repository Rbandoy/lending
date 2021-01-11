<script>
 

      var now = new Date();
      var today = now.getDate()  + '/' + (now.getMonth() + 1) + '/' + now.getFullYear(); 
      $('#bDueDate').val(today);
      function borrowMoneyEntry() {
            // alert('asdsd');
            $(".loading").attr('fa-spinner fa-spin');
            let id = $("#borrowMoneyId").val();
            let amount = $("#bAmount").val();
            let rate = $("#selectRate").val();
            let date = $("#bDate").val();
            let months = $("#bMonths").val(); 
            if (id == '' || amount == '' || rate == '' || date == '' || months == "" || months == null) {
                  alert('Please Input Required Field!');
                  return;
            }
            var form = new FormData();
            form.append("bId", id);
            form.append("bAmount", amount);
            form.append("selectRate", rate);
            form.append("bDate",  date); 
            form.append("bMonths", months);

            var settings = {
            "url": "http://127.0.0.1:8888/Api/borrowMoney",
            "method": "POST",
            "timeout": 0,
            "headers": {
            "Cookie": "ci_session=1mvmq74ecqg48q71ner7egusp01pputi"
            },
            "processData": false,
            "mimeType": "multipart/form-data",
            "contentType": false,
            "data": form, 
            error: function(result){
                  $("#transNo").append("<strong>Internal Server Error Please Contact Administrator</strong>"); 
                  $("#borrowMoney").attr("disabled", true);
            }
            };

            $.ajax(settings).done(function (response) { 
                  let res = JSON.parse(response); 
                  if (res[0].S == 1) {
                        $("#transNo").append("RECEIPT: " +"<a target='_blank' href='http://127.0.0.1:9999/portal/lending_receipt/"+res[0].transNo+"'><strong>"+res[0].transNo+"</strong></a>"); 
                        $("#transNo").append("<br>VOUCHER: " +"<a target='_blank' href='http://127.0.0.1:9999/portal/voucher/"+res[0].transNo+"'><strong>"+res[0].transNo+"</strong></a>"); 
                        $("#borrowMoney").attr("disabled", true);
                  } else if(res[0].S == 0) {
                        $("#transNo").append("<strong>" +"<strong>"+res[0].M+"</strong>"); 
                        $("#borrowMoney").attr("disabled", true);
                  }else {
                        $("#transNo").append("<strong>Internal Server Error Please Contact Administrator</strong>"); 
                        $("#borrowMoney").attr("disabled", true);
                  } 
            });
      }

     function action(id) {
           $("#adminId").val(id);
     } 
      function handler(e){  
            let fDate = new Date(new Date(Date.parse(new Date(e.target.value))).setMonth(new Date(Date.parse(new Date(e.target.value))).getMonth() + 1));
            $("#bDueDate").val((fDate.getMonth()+1)+"-"+fDate.getDate()+"-"+fDate.getFullYear()); 
      }

     function assignBorrowerId(id) {
           $("#borrowerId").val(id);
     }

     function assignBorrowerShare(id, fname) {
           
            $("#Sharefname").val(fname);
            $("#dataShare").empty();
            $("#shareId").val(id); 
            $("#shareReceipt").empty();
           
            $.ajax({
                        type: 'POST',
                        url: '/api/getShare',
                        data: {
                              id,
                        },
                        success: function(resp) {
                              let res = JSON.parse(resp);
                              if (res.length > 0) {
                                    $("#sharePurchase").val(res[0].sharePurchase);
                                    $("#sharePurchaseValue").val(res[0].sharePurchase * 100);
                                    $("#shareWithdraw").val(res[0].shareWithdraw);
                                    $("#shareWithdrawValue").val(res[0].shareWithdraw * 100); 
                                    $("#shareBalance").val(res[0].sharePurchase - res[0].shareWithdraw); 
                                    $("#shareBalanceValue").val(((res[0].sharePurchase - res[0].shareWithdraw) * 100));
                                    $("#shareReceipt").append(`
                                          <a target="_blank" href="http://localhost:9999/portal/share/`+id+`" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Download Report</a>
                                    `);
                              } else {
                                    $("#sharePurchase").val("");
                                    $("#sharePurchaseValue").val("");
                                    $("#shareWithdraw").val("");
                                    $("#shareWithdrawValue").val("");  
                                    $("#shareBalance").val(""); 
                                    alert('No Available Share Allocation');  
                              }
                              
                        },
                        
            });

            $.ajax({
                                    type: 'POST',
                                    url: '/api/getShareHistory',
                                    data: {
                                          id,
                                    },
                                    success: function(history) {
                                          let historyRes = JSON.parse(history); 
                                          if (historyRes.length > 0) {
                                                let total = 0;
                                                for (let x = 0; x <historyRes.length; x++) { 
                                                      $("#dataShare").append(` 
                                                            <tr>  
                                                                  <td>`+historyRes[x].date+`</td>
                                                                  <td>`+historyRes[x].Action+`</td>
                                                                  <td>`+historyRes[x].amount+`</td> 
                                                                  <td>`+historyRes[x].balance+`</td> 
                                                            </tr> 
                                                      `); 
                                                }
                                          } else {
                                                $("#dataShare").append(` 
                                                       NO DATA AVAILABLE  
                                                `); 
                                          } 
                                    }
                              });
     }

     function assignBorrowEntry(id,interestDue,principalDue,totalDue,Balance,dueDate) { 
            $.ajax({
                  type: 'POST',
                  url: '/api/getPaymentHistory',
                  data: {
                        id,
                  },
                  success: function(resp) {
                        let res = JSON.parse(resp);
                        $("#entryId").val(id); 
                        $("#interestDue").val(interestDue);
                        $("#principalDue").val(principalDue);
                        $("#totalDue").val(totalDue);
                        $("#monthlyBalance").val(Balance);
                        $("#Balance").val(res[0].fullpayment);  
                        $("#totalpayment").val(res[0].amountPaid); 
                        $("#penalty").val(res[0].penalty); 
                        $("#totalDuewpartial").val(res[0].totalDue);  
                        
                        
                        $("#addpenaltyDiv").empty();
                        $("#penaltyDiv").empty();
                        $("#fullpaymentDiv").empty();
                        $("#paymonthlyDiv").empty();
                        $("#postAmountDiv").empty();    
                              $("#postAmountDiv").append(`<label for="postAmount">Amount:</label>
                                    <input type="text" class="form-control form-control-user" id="postAmount">`);
                        
                        $("#fullpaymentDiv").append(`<button type="button" id='fullPayment' onclick='fullPayment()' class="btn btn-primary form-control m-2">Full Payment</button>`);
                        if (Balance > 0) {
                              $("#paymonthlyDiv").append(`<button type="button" id='deactivate' onclick='monthlyPayment()'  class="btn btn-primary form-control m-2">Pay Monthly Due</button>`);
                        } 
                  },
                  error: (data) => {
                        alert('INTERNAL SERVER ERROR');
                  }
                  });
     }

     function addPenalty(id,interestDue,principalDue,totalDue,Balance,dueDate) { 
            $.ajax({
                  type: 'POST',
                  url: '/api/getPaymentHistory',
                  data: {
                        id,
                  },
                  success: function(resp) {
                        let res = JSON.parse(resp);
                        $("#entryId").val(id); 
                        $("#interestDue").val(interestDue);
                        $("#principalDue").val(principalDue);
                        $("#totalDue").val(totalDue);
                        $("#monthlyBalance").val(Balance);
                        $("#Balance").val(res[0].fullpayment);  
                        $("#totalpayment").val(res[0].amountPaid); 
                        $("#penalty").val(res[0].penalty); 
                        $("#totalDuewpartial").val(res[0].totalDue); 
                        $("#addpenaltyDiv").empty();
                        $("#penaltyDiv").empty();
                        $("#fullpaymentDiv").empty(); 
                        $("#paymonthlyDiv").empty();
                        $("#postAmountDiv").empty(); 
                        $("#postAmountDiv").append(`<div class="col-sm-4"> 
                      <label for="penalty">Penalty:</label>
                      <input type="text" class="form-control form-control-user"  required id="inputPenalty">
                      </div>
                      <div class="col-sm-4"> 
                      <label for="penalty">Partial Amount:</label>
                      <input type="text" class="form-control form-control-user" required id="inputPartialAmount">
                      </div>
                      `);
           $("#addpenaltyDiv").append(`<button type="button" class="btn btn-secondary form-control m-2" onclick='partialPayment()' >Add Partial</button>`);
                  },
                  error: (data) => {
                        alert('INTERNAL SERVER ERROR');
                  }
                  }); 
     }

     function borrowMoney(id, fname, lname, mname) {
           $("#borrowMoneyId").val(id);
           $("#bFname").val(fname);
           $("#bLname").val(lname);
           $("#bMname").val(mname); 
           $("#bAmount").val(''); 
           $("#bDate").val('');
           $("#bDate").val('');
           $("#bMonths").val(''); 
           $("#transNo").empty(); 
           $("#borrowMoney").attr("disabled", false);
     }      
     function getTotalAmountDue() {
           var months = $("#bMonths").val();
           if (months > 12) {
            
           }
     } 

     function createAccount() {
            var fname = $("#fname").val();
            var mname = $("#mname").val();
            var lname = $("#lname").val();
            var age = $("#age").val();
            var gender = $("#gender").val();
            var bdate = $("#bdate").val();
            var street = $("#street").val();
            var muni = $("#muni").val();
            var city = $("#city").val();
            var country = $("#country").val();
            var sourceofincome = $("#sourceofincome").val();
            var occupation = $("#occupation").val();
            if (fname && mname &&  lname &&  age && gender && bdate && street && muni && city && country && sourceofincome && occupation){
     
                  $.ajax({
                        type: 'POST',
                        url: '/Borrower/createBorrower',
                        data: {
                              fname,
                              mname,
                              lname,
                              age,
                              gender,
                              bdate,
                              street,
                              muni,
                              city,
                              country,
                              sourceofincome,
                              occupation
                        },
                        success: function(resp) {
                              let res = JSON.parse(resp);
                                    if (res[0].S == 1) {
                                          alert("Borrower successfuly inserted");
                                          window.location = "<?php echo base_url().'Borrower';?>";
                                    } else if (res[0].S == 0) {
                                          alert(res[0].M);
                                    } else {
                                          alert("an error occured");
                                    }
                        }
                  });
            } else {
                  alert("Please Input All Required Field!");
            }
      }
      $(document).ready(function() {
            $('#dataTable').DataTable();
      });

      function partialPayment() {
           let id = $("#entryId").val();
           let penalty = $("#inputPenalty").val();
           let partialAmount = $("#inputPartialAmount").val();
           if (penalty == '' && partialAmount == '') {
                  alert("Please Input Penalty/Partial Amount");
                  return;
           }

           $.ajax({
                  type: 'POST',
                  url: '/api/postPartialPayment',
                  data: {
                         id,
                         penalty,
                         partialAmount
                  },
                  success: function(resp) {
                        let res = JSON.parse(resp);
                              if (res[0].s == 1) {
                                    alert(res[0].M);
                                    $("#btnCheckRefno").click();
                                     
                              } else if (res[0].s == 0) {
                                    alert(res[0].M);
                              } else {
                                    alert("an error occured");
                              }
                        $("#inputPenalty").val('');
                        $("#inputPartialAmount").val('');
                  }
            }); 
      }

      function fullPayment() {
           let id = $("#entryId").val();
           let amount = $("#postAmount").val(); 
           if (id == '' && amount == '') {
                  alert("Please Input Penalty/Partial Amount");
                  return;
           }

           $.ajax({
                  type: 'POST',
                  url: '/api/fullPayment',
                  data: {
                         id,
                         amount
                  },
                  success: function(resp) {
                        let res = JSON.parse(resp);
                              if (res[0].s == 1) {
                                    alert(res[0].M);
                                    $("#btnCheckRefno").click(); 
                              } else if (res[0].s == 0) {
                                    alert(res[0].M);
                              } else {
                                    alert("an error occured");
                              }
                        $("#inputPenalty").val('');
                        $("#inputPartialAmount").val('');
                  }
            }); 
      }

      function monthlyPayment() {
           let id = $("#entryId").val();
           let amount = $("#postAmount").val(); 
           if (id == '' && amount == '') {
                  alert("Please Input Penalty/Partial Amount");
                  return;
           }

           $.ajax({
                  type: 'POST',
                  url: '/api/monthlyPayment',
                  data: {
                         id,
                         amount
                  },
                  success: function(resp) {
                        let res = JSON.parse(resp);
                              if (res[0].s == 1) {
                                    alert(res[0].M);
                                    $("#btnCheckRefno").click(); 
                              } else if (res[0].s == 0) {
                                    alert(res[0].M);
                              } else {
                                    alert("an error occured");
                              }
                        $("#inputPenalty").val('');
                        $("#inputPartialAmount").val('');
                  }
            }); 
      }

      function buyShare() {
            let id = $("#shareId").val();
           let amount = $("#inputBuyShare").val();  
           if (id == '' || amount == '') {
                  alert("Please Input Share Amount");
                  return;
           }
           $.ajax({
                  type: 'POST',
                  url: '/api/buyShare',
                  data: {
                         id,
                         amount
                  },
                  success: function(resp) {
                        let res = JSON.parse(resp);
                              if (res[0].S == 1) {
                                    alert(res[0].M); 
                                    assignBorrowerShare(id, $("#Sharefname").val());
                                    $("#showActionShare").empty();
                              } else if (res[0].S == 0) {
                                    $("#showActionShare").empty();
                                    alert(res[0].M);
                              } else {
                                    $("#showActionShare").empty();
                                    alert("an error occured");
                              }
                  }
            });
      }  

      function withdrawShare() {
            let id = $("#shareId").val();
           let amount = $("#inputWithdrawShare").val();  
           if (id == '' || amount == '') {
                  alert("Please Input Share Amount");
                  return;
           }
           $.ajax({
                  type: 'POST',
                  url: '/api/withdrawShare',
                  data: {
                         id,
                         amount
                  },
                  success: function(resp) {
                        let res = JSON.parse(resp);
                              if (res[0].S == 1) { 
                                    alert(res[0].M);
                                    assignBorrowerShare(id, $("#Sharefname").val());
                                    $("#showActionShare").empty();
                              } else if (res[0].S == 0) {
                                    $("#showActionShare").empty();
                                    alert(res[0].M);
                              } else {
                                    $("#showActionShare").empty();
                                    alert("an error occured");
                              }
                  }
            });
      }  
</script>
 