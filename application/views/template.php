<!doctype html>
<html>
<head>
    <title><?php echo $this->template->title->default("Default title"); ?></title>
    <meta charset="utf-8">
    <meta name="description" content="<?php echo $this->template->description; ?>">
    <meta name="author" content="">
    <?php echo $this->template->meta; ?>
    <?php echo $this->template->stylesheet; ?>
    <?php echo $this->template->javascript; ?>    
    <?php include 'helpers.php' ?>
    <style type="text/css">
      #new-user {
        margin: 10px;
      }
      .delete_me{
        margin-left: 10px;
      }
    </style>
</head>
<body>

<?php 
    // This is an example to show that you can load stuff from inside the template file
    //echo $this->template->widget("navigation", array('title' => 'Project name'));
?>

<div class="container" style="margin-top: 10px;">

  <?php
    // This is the main content partial
    echo $this->template->content;
  ?>

  <hr>

  <footer>
    <p>
        <?php 
            // Show the footer partial, and prepend copyright message
            echo $this->template->footer->prepend("&copy; Copy Rights- ");
        ?>
    </p>
  </footer>

</div>
<script type="text/javascript">
    $(document).ready( function () {
       
    $('#testNotify').on('click',function () {
        $('#testNotify').notify("You have clicked me!. Thanks",{
          type:"default",
          animation: true,
          animationType: "fade",
          position: "right"});
    });
    });
</script>

</body>
</html>