
var img = '';
  $('#search').hide();
  function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("search");
  filter = input.value.toUpperCase();
  table = document.getElementById("example");
  if (table) {
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
};
}


  function msg(x, id){
            // alert(x);
            $('#accountName').val(x);
            $('#accountId').val(id);
    } 
   $('.loading').modal('hide');
function navigate(action){
// alert(action);
$('.loading').modal('show');
$('#con').load('<?php echo base_url()."satisfood/";?>'+action);
// $("#loading").hide();
}
$(document).on('click',function(){
  $('#collapseTwo').collapse('hide');
})

function collapseEdit(){
  $('.collapse').collapse('hide');
}

function readURL(input) {
  // alert(input);
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
      // alert(e.target.result);
        // $image = imagecreatefrompng(e.target.result);
        // imagejpeg($image, 'image.jpg', 70); // 0 = worst / smaller file, 100 = better / bigger file 
        // imagedestroy($image);
        // console.log(e.target.result);
        $('#changeProfile').attr('src', e.target.result);
        img = e.target.result;
        // alert(img);
    }

    reader.readAsDataURL(input.files[0]);
}
$("#updateprofilepictoast").toast('hide');
  $('#uploadProfileImage').modal('show');
  
}

function saveProfilepic() {
  $.ajax({
    type: 'POST',
    url: '/satisfood/uploadImage',
    data: {
      img:  img
    },
    beforeSend: function(){
      $('.loading').modal('show');
    },
    success: function(resp) {
      // alert(resp);
      if (resp) {
        $('.loading').modal('hide');
        $('.collapse').collapse('hide');
        $("#updateprofilepictoast").toast({ delay: 3000});
        $('#toastMessage').text("Profile picture updated");
        $('#alertUpload').append('<div class="alert alert-success"><strong>Success!</strong> Profile Picture Uploaded</div>');
      } else {
        $('.loading').modal('hide');
        $('.collapse').collapse('hide');
        $("#updateprofilepictoast").toast({ delay: 3000});
        $('#toastMessage').text("Internal server error");
        $("#updateprofilepictoast").toast('show');
        $('#alertUpload').append('<div class="alert alert-success"><strong>Success!</strong>Internal server error</div>');
      }
    }
  });
};

function update(params){ 
  $('.loading').modal('show');
  var data = {};
  if (params == 'email') {
    data = {
      target: params,
      email: $("#inputProfileEmail").val()
    }
  }
  
  if (params == 'profilename') {
    data = {
      target: params,
      mname: $('#pmname').val(),
      lname: $('#plname').val(),
      fname: $('#pfname').val()
    }
  }

  if (params == 'contactno') {
    data = {
      target: params,
      contactno: $('#inputProfileContactNo').val(),
    }
  }

  if (params == 'gender') {
    var isMale = $('#isMale').is(':checked');
    var isFemale = $('#isFemale').is(':checked');

    if (isMale) {
      data = {
        target: params,
        gender: 'male',
      }
    }else if (isFemale){
      data = {
        target: params,
        gender: 'female',
      }
    }
  }
// alert(data);
  $.ajax({
    type: 'POST',
    url: '/satisfood/update',
    data: { data },
    success: function(resp) { 
      if (resp == '1') {
        $('.loading').modal('hide');
        $('.collapse').collapse('hide');
        $("#myToast").toast({ delay: 3000});
        $('#toastMessage').text(params+ " updated");
        $("#myToast").toast('show');
      } else {
        alert(resp)
      }
    }
  });
}