
<div class="container">
  <div class="login-container form-container center-block">
    <?php $this->load->view('layout/flash'); ?>
    <h3>Login</h3>

    <form role="form" id="users_login_form" action="<?php echo site_url('users/go');?>" accept-charset="UTF-8" method="post">
      <div id="photos_signin_section">
        <p>Please verify your email and code.</p>

        <div class="verification-email-container field">
          <label>Email</label>
          <input class="form-control" placeholder="Email" type="email" name="email" id="users_email">
        </div>

        <div class="verification-code-container field">
          <label>Verification Code</label>
          <input class="form-control" placeholder="Verification Code" type="text" name="code" id="users_code">
        </div>
      </div>
      <div class="actions">
        <button name="button" type="submit" class="btn btn-primary" id="verify_code_submit">Verify</button>
      </div>
      <div class="field">
        <p>Forgot your verification code?</p>
        <span><a href="<?= site_url("users/forgot_code") ?> "class="btn btn-warning">Request Verification Code</a></span>
      </div>
    </form>
  </div>
</div>
<script>
  $(function () {
    initializeUserLoginForm();
  });
</script>