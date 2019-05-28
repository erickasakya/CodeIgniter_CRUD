<div class="row">
<h1 class="text-center text-primary"><?php echo $title;?></h1>

<?php echo $date_diff; ?>
<div class="pull-left">
  <button type="button" class="btn btn-info" id="testNotify">
  Test Notify
</button>
</div>
<div class="pull-right">
  <button type="button" class="btn btn-success" id="new-user" data-toggle="modal" data-target="#Adduser-modal">
  Add New User
</button>
</div>

<br/><br/><br/>

<table class="table table-striped" id="tblUsers" style="width:100%;">
  <thead>
    <tr>
      <th>Actions</th>
      <th>Email</th>
      <th>Username</th>
      <th>Password</th>
      <th>Start Date</th>
      <th>End Date</th>
      <th>Duration</th>
  </tr>
  </thead>
  <tbody>
</tbody> 
<tfoot>
    <tr>
      <th>Actions</th>
      <th>Email</th>
      <th>Username</th>
      <th>Password</th>
      <th>Start Date</th>
      <th>End Date</th>
      <th>Duration</th>
    </tr>
    </tfoot> 
</table>
<!--  Modal for adding new user-->
<div class="modal fade" id="Adduser-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form method="POST" class="formValidate" action="<?php echo site_url('users/create')?>" id="formUsers">
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

            <div class="form-group">
              <label for="start_date" class="control-label">Start Date</label>
                <input type='date' class="form-control" name="start_date" id="start_date" />
            </div>

            <div class="form-group">
              <label for="end_date" class="control-label">End Date</label>
                <input type='date' class="form-control" name="end_date" id="end_date" />
              </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </form>
    </div>
  </div>
</div>
<script type="text/javascript">

//Start of New procedure

var dTable = {};
  $(document).ready( function () {

    var handleDataTableButtons = function() {
      if ($("#tblUsers").length) {
        dTable['tblUsers'] = $('#tblUsers').DataTable( {
          dom: "<\".col-md-5\"B><\".col-md-3\"l><\".col-md-4\"f>rt<\".col-md-7\"i><\".col-md-5\"p>",
          pageLength: 10,
          
          responsive: true,

          "scrollX": true,
          buttons: [
                    { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'CodeIgniter App Excel'},
                    {extend: 'pdf', title: 'CodeIgniter App Pdf'},

                    {extend: 'print',
                     customize: function (win){
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '20px');

                            $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');
                    }
                    }
                ],
          ajax: {
            url:"<?php echo site_url("users/jsonList");?>",
            dataType: 'JSON',
            type: 'POST',
            data: function(d){}
          },
          columns:[
          { data: 'ID', render:function ( data, type, full, meta ) {
            var ret_txt ="<a type='button' href='#Adduser-modal' data-toggle='modal' class='btn btn-sm btn-primary edit_me'>Edit</a>";

            ret_txt += '<a  type="button" class="btn btn-sm btn-danger delete_me" data-toggle="modal" data-target="#deletemodal" href="#">Delete</a>';
            return ret_txt;
          }
          },
          { data: 'email' },
          { data: 'username' },
          { data: 'password' },
          { data: 'start_date', render:function ( data, type, full, meta ) {return data?formatDate(data):'';}  },
          { data: 'end_date', render:function ( data, type, full, meta ) {return data?formatDate(data):'';} },
          { data: 'Duration' }
          ],
          
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
</div>