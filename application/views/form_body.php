<!DOCTYPE html>
<html>
<head>
  <title>CodeIgniter APP</title>
  <link href="<?php echo base_url('assets/css/bootstrap.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
</head>
<body>

<div class="container">
	<h1 class="text-center text-primary">Register New User</h1>

  <?php if (validation_errors()): ?>
  <div class="alert alert-warning alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    <?php echo validation_errors(); ?>
 </div>
<?php endif; ?>


	<div class="pull-right">
   <a class="btn btn-success" href="<?php echo base_url('users/index') ?>"> List of All Users</a> 
  </div>
<br/>  
  <form method="post" action="" class="">
  	
<div class="form-group">
  	<label for="email" class="control-label">Email</label><input type="email" name="email" class="form-control">
  </div>

  <div class="form-group">
  	<label for="username" class="control-label">Username</label><input type="text" name="username" class="form-control">
</div>

<div class="form-group">
  	<label for="password" class="control-label">Password</label><input type="password" name="password" class="form-control">
  </div>
  	<input type="submit" value="Send" class="btn btn-primary">
    <div class="pull-right">
            <a class="btn btn-primary" href="<?php echo base_url('users');?>"> Back</a>
        </div>
  </form>
</div>
</div>
</body>
</html>