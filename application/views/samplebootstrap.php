<link href="<?php echo base_url('assets/css/bootstrap.css');?>" rel="stylesheet">
<link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">

<div class="container">

<?php echo form_open("boots/getBoots",'class="form-inline"'); ?>
</br>
<legend>Enter the data </legend>
</br>

<div style="margin-left:30%;margin-top:20px;" >

<div class="form-group">
<label for="employeeno" class="control-label">Employee No :</label> <input type="text" name="name" class="form-control" />
</div>


</br>

</br>
<div class="form-group">
<label for="age" class="control-label">Age :</label> <input type="text" name="age" class="form-control" />
</div>
</br>
</br>
<input type="submit" name="name" class="btn btn-primary"/>

</div>

<?php echo form_close(); ?>
</div>