<div class="container">
  <div class="upload-container center-block">
    <?php $this->load->view('layout/flash'); ?>
    <h3>Upload Photo File</h3>
    <p>Choose your photo file to upload.</p>

    <form enctype="multipart/form-data" action="<?= site_url('photos/go') ?>" method="post">

      <div class="field">
        <label>File</label>
        <input type="file" name="photo"/>
      </div>

      <div class="actions">
        <input type="submit" name="upload" class="btn btn-primary"/>
      </div>
    </form>

  </div>
</div>
