<div class="container">
  <div class="email-verification-container form-container center-block">
    <?php $this->load->view('layout/flash'); ?>
    <p class="message-panel">Please check your email for a confirmation code. Once your payment has been processed, you will receive an email with a confirmation number, for you to upload your photo(s).</p>
    <form class="button_to" method="get" action="<?php echo site_url('users/login');?>"><input class="btn btn-success" type="submit" value="Go to upload your photo(s)"></form>
  </div>
</div>

<script>
  $(function () {
    initializeUserEmailVerifyForm();
  });
</script>