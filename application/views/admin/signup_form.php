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
<?php
//form validation
echo validation_errors();
?>
<div class="container login">
  <?php
  $attributes = array('class' => 'form-signin');
  echo form_open('admin/create_member', $attributes);
  echo '<h2 class="form-signin-heading">Create an account</h2>';
  echo form_input('email_address', set_value('email_address'), 'placeholder="Email"');
  echo form_input('adminname', set_value('adminname'), 'placeholder="Admin"');
  echo form_password('password', '', 'placeholder="Password"');
  echo form_password('password2', '', 'placeholder="Password confirm"');

  echo form_submit('submit', 'submit', 'class="btn btn-large btn-primary"');
  echo form_close();
  ?>
</div>
</body>
</html>    
