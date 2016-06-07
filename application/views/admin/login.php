<!DOCTYPE html>
<html lang="en-US">
<head>
  <title>CodeIgniter Admin Sample Project</title>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>static/css/bootstrap.min.css"/>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>static/css/admin/styles.css"/>
  <script src="<?php echo base_url(); ?>static/js/jquery-2.2.4.min.js"></script>
  <script src="<?php echo base_url(); ?>static/js/jquery.validate.min.js"></script>
  <script src="<?php echo base_url(); ?>static/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url(); ?>static/js/admin/main.js"></script>
</head>
<body>
<div class="container login">
  <?php
  $attributes = array('class' => 'form-signin');
  echo form_open('admin/login/validate_credentials', $attributes);
  echo '<h2 class="form-signin-heading">Login</h2>';
  echo form_input('adminname', '', 'placeholder="Admin"');
  echo form_password('password', '', 'placeholder="Password"');
  if (isset($message_error) && $message_error) {
    echo '<div class="alert alert-error">';
    echo '<a class="close" data-dismiss="alert">×</a>';
    echo '<strong>Oh snap!</strong> Change a few things up and try submitting again.';
    echo '</div>';
  }
  echo "<br />";
  echo anchor('admin/signup', 'Signup!');
  echo "<br />";
  echo "<br />";
  echo form_submit('submit', 'Login', 'class="btn btn-large btn-primary"');
  echo form_close();
  ?>
</div>
<!--container-->
</body>
</html>
