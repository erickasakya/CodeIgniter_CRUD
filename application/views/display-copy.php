<!DOCTYPE html>
<html>
<head>
	<title>CodeIgniter APP</title>
    <<link href="<?php echo base_url('assets/css/bootstrap.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/DataTables-1.10.18/css/jquery.dataTables.css'); ?>" rel='stylesheet'>
    <link href="<?php echo base_url('assets/DataTables-1.10.18/css/dataTables.bootstrap4.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/DataTables-1.10.18/css/buttons.bootstrap.min.css'); ?>" rel='stylesheet'>
  	<link href="<?php echo base_url('assets/DataTables-1.10.18/css/buttons.dataTables.min.css'); ?>" rel='stylesheet'>

    <script src="<?php echo base_url('assets/js/jquery-3.3.1.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap_validator.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/DataTables-1.10.18/js/dataTables.min.js'); ?>"></script> 
    <script src="<?php echo base_url('assets/DataTables-1.10.18/js/dataTables.buttons.min.js'); ?>"></script>
  	<script src="<?php echo base_url('assets/DataTables-1.10.18/js/buttons.flash.min.js'); ?>"></script>
  	<script src="<?php echo base_url('assets/DataTables-1.10.18/js/jszip.min.js'); ?>"></script>
  	<script src="<?php echo base_url('assets/DataTables-1.10.18/js/pdfmake.min.js'); ?>"></script>
  	<script src="<?php echo base_url('assets/DataTables-1.10.18/js/vfs_fonts.js'); ?>"></script>
  	<script src="<?php echo base_url('assets/DataTables-1.10.18/js/buttons.html5.min.js'); ?>"></script>
  	<script src="<?php echo base_url('assets/DataTables-1.10.18/js/buttons.print.min.js'); ?>"></script>
   
    <?php include 'helpers.php' ?>

   <style type="text/css">
   	#new-user{
   		margin-bottom: 10px;
   	}
   </style>
</head>
<body>

<div class="container">
<h1 class="text-center text-primary">Users of our system</h1>

<div class="pull-right">
	<button type="button" class="btn btn-success" id="new-user" data-toggle="modal" data-target="#Adduser-modal">
  Add New User
</button>
</div>



<table class="table table-striped" id="tblUsers" style="width:100%;">
	<thead>
		<tr>
      <th>Actions</th>
  		<th>Email</th>
  		<th>Username</th>
  		<th>Password</th>
	</tr>
	</thead>
	<tbody>
</tbody>	
</table>
</div>


<!--  Modal for adding new user-->
<div class="modal fade" id="Adduser-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
  <form method="post" class="formValidate" action="<?php echo site_url('users/create')?>" id="formUsers">
      <div class="modal-header">
        <h3 class="modal-title text-primary text-center" id="exampleModalLabel">User's Form</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

          <input type="hidden" name="ID" id="ID">
			<div class="form-group">
			  	<label for="email" class="control-label">Email</label><input type="email" name="email" id="email" class="form-control" required="required">
			  </div>

			  <div class="form-group">
			  	<label for="username" class="control-label">Username</label><input type="text" name="username" id="username" class="form-control" required="required">
			</div>

			<div class="form-group">
			  	<label for="password" class="control-label">Password</label><input type="password" name="password" id="password" class="form-control" required="required">
			  </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Add User</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
          
        </form>
    </div>
  </div>
</div>
</body>
<script type="text/javascript">

//Start of New procedure

var dTable = {};
  $(document).ready( function () {

    var handleDataTableButtons = function() {
      if ($("#tblUsers").length) {
        dTable['tblUsers'] = $('#tblUsers').DataTable( {
          dom: "<\".col-md-5\"B><\".col-md-3\"l><\".col-md-4\"f>rt<\".col-md-7\"i><\".col-md-5\"p>",
          paging: true,
          ordering: true,
          searching:true,
          ajax: {
            url:"<?php echo site_url("users/jsonList");?>",
            dataType: 'JSON',
            type: 'POST',
            data: function(d){}
          },
          columns:[
          { data: 'ID', render:function ( data, type, full, meta ) {
            var ret_txt = '<a type="button" href="#Adduser-modal" class="btn btn-primary edit_me" data-toggle="modal" >Edit</a>';
            ret_txt += '<a  type="button" class="btn btn-danger delete_me" data-toggle="modal" data-target="#deletemodal" href="#">Delete</a>';
            return ret_txt;
          }
          },
          { data: 'email' },
          { data: 'username' },
          { data: 'password' }
          ],
          buttons: [
          {extend: "copy",className: "btn-sm"},
          {extend: "csv",className: "btn-sm"},
          {extend: "excel",className: "btn-sm"},
          {extend: "pdfHtml5",className: "btn-sm"},
          {extend: "print",className: "btn-sm"}
          ]
          ,
          responsive: true
        });
    }
  };
  TableManageButtons = function() {
    "use strict";
    return {
    init: function() {
      handleDataTableButtons();
    }
    };
  }();
  TableManageButtons.init();
  $('#formUsers').validator().on('submit', saveData);
  } );

</script>
</html>