<!DOCTYPE html> 
<html lang="en-US">
<head>
  <title>De Angelo Motors Admin</title>
  <meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>static/css/bootstrap.2.min.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>static/css/admin/styles.css"/>
	<script src="<?php echo base_url(); ?>static/js/jquery-2.2.4.min.js"></script>
	<script src="<?php echo base_url(); ?>static/js/jquery.validate.min.js"></script>
	<script src="<?php echo base_url(); ?>static/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>static/js/admin/main.js"></script>
</head>
<body>
	<div class="navbar navbar-fixed-top">
	  <div class="navbar-inner">
	    <div class="container">
	      <a class="brand">De Angelo Motors</a>
	      <ul class="nav">
	        <li <?php if($this->uri->segment(2) == 'photos'){echo 'class="active"';}?>>
	          <a href="<?php echo base_url(); ?>index.php/admin/photos">Photos</a>
	        </li>
	        <li <?php if($this->uri->segment(2) == 'participants'){echo 'class="active"';}?>>
	          <a href="<?php echo base_url(); ?>index.php/admin/participants">Participants</a>
	        </li>
	        <li class="dropdown">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown">System <b class="caret"></b></a>
	          <ul class="dropdown-menu">
	            <li>
	              <a href="<?php echo base_url(); ?>index.php/admin/logout">Logout</a>
	            </li>
	          </ul>
	        </li>
	      </ul>
	    </div>
	  </div>
	</div>	
