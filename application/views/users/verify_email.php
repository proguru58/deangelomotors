<div class="container">
  <div class="email-verification-container center-block">
    <?php $this->load->view('layout/flash'); ?>
    <p>Please check your email for a confirmation code. Once your payment has been processed, you will receice an email with a confirmation code number to upload your photo for the content.</p>
    <br>
    <form role="form" class="email-verify" id="email_verify" action="<?php echo site_url('users/verify_email');?>" accept-charset="UTF-8" method="post">

      <h4>Resend Email</h4>

      <div class="participant-email-wrapper field">
        <input class="form-control" placeholder="Email" type="email" name="email">
      </div>

      <div class="actions">
        <button name="button" type="submit" class="btn btn-primary">Resend</button>
      </div>

    </form>
    <br>
    <p>Already have participant code?</p>
    <form class="button_to" method="get" action="<?php echo site_url('users/login');?>"><input class="btn btn-success" type="submit" value="Upload photo"></form>

  </div>
</div>

<script>
  $(function () {
    initializeUserEmailVerifyForm();
  });
</script>