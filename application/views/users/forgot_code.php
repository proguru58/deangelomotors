<div class="container">
  <div class="forgot-code-container form-container center-block">
    <?php $this->load->view('layout/flash'); ?>
    <p class="message-panel">Please type email address to receive your verification code. Once you submit this form, you will receice an email with verification code number.</p>
    <form role="form" class="forgot-code" id="email_verify" action="<?php echo site_url('users/forgot_code');?>" accept-charset="UTF-8" method="post">

      <h4>Send email with verification code</h4>

      <div class="participant-email-wrapper mid-field">
        <input class="form-control" placeholder="Email" type="email" name="email">
      </div>

      <div class="actions">
        <button name="button" type="submit" class="btn btn-primary">Resend</button>
      </div>

    </form>
    <p>Received verfication code?</p>
    <form class="button_to" method="get" action="<?php echo site_url('users/login');?>"><input class="btn btn-success" type="submit" value="Upload photo"></form>

  </div>
</div>

<script>
  $(function () {
    initializeUserEmailVerifyForm();
  });
</script>