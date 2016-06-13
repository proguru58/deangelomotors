<div class="container">
  <div class="email-verification-container form-container center-block">
    <?php $this->load->view('layout/flash'); ?>
    <p class="message-panel">Please check your email for a confirmation code. Once your payment has been processed, you will receive an email with a confirmation number, for you to upload your photo(s).</p>
    <form role="form" class="email-verify" id="email_verify" action="<?php echo site_url('users/verify_email');?>" accept-charset="UTF-8" method="post">

      <h4>Resend Email</h4>

      <div class="participant-email-wrapper mid-field">
        <input class="form-control" placeholder="Email" type="email" name="email" value="<?php echo $email;?>">
      </div>

      <div class="actions">
        <button name="button" type="submit" class="btn btn-primary">Resend</button>
      </div>

    </form>
    <p>Already have participant code?</p>
    <form class="button_to" method="get" action="<?php echo site_url('users/login');?>"><input class="btn btn-success" type="submit" value="Upload photo"></form>

  </div>
</div>

<script>
  $(function () {
    initializeUserEmailVerifyForm();
  });
</script>