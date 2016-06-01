<div class="container">
  <div class="upload-success-container center-block">
    <?php $this->load->view('layout/flash'); ?>
    <p class="message-panel">Thank you for uploading your photo and being a part of De Angelo Motors international photo shoot contest. Your photo has been successfully submitted. We encourage you to spread the world around your community. You may enter multiple times to increase your chances of winning. Best of luck!</p>
  </div>
  <span><a href="<?= site_url("photos/index") ?>"class="btn btn-primary">Return to main page</a></span>
  <span><a href="<?= site_url("photos/upload") ?>"class="btn btn-success">Submit another photo</a></span>
</div>
