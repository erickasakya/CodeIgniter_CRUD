<!DOCTYPE html>
<html>
<head>
  <title>CodeIgniter APP</title>
  <link href="<?php echo base_url('assets/css/bootstrap.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
</head>
<body>

  <div class="container">

<?phpdefined('BASEPATH') OR exit('No direct script access allowed');?>
<h1 class="text-center text-primary">Update The User's Info</h1>
<?php echo validation_errors(); ?>
<form method="post" action="<?php echo base_url() . "index.php/Users/update_user";?>" class="">
<?php foreach ($users as $user_list): ?>
	<input type="hidden" name="id" value="<?php echo $user_list['ID']; ?>">
  	<div class="form-group">
  		<label class="control-label" for="email">Email</label><input type="email" name="email" value="<?php echo $user_list['email']; ?>" class="form-control">
  	</div>
  	
  	<div class="form-group">
  	<label for="username" class="control-label">Username</label><input type="text" name="username" value="<?php echo $user_list['username']; ?>" class="form-control">
  </div>

  <div class="form-group">
  	<label for="password" class="control-label">Password</label><input type="password" name="password" value="<?php echo $user_list['password']; ?>" class="form-control">
  </div>
  	<input type="submit" value="Update" class="btn btn-success">
  	<div class="pull-right">
            <a class="btn btn-primary" href="<?php echo base_url('users');?>"> Back</a>
        </div>
  <?php endforeach; ?>
  </form>
     </div>
  </body>
</html>
