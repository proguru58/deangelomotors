<div class="container">
  <div class="photos-container form-container center-block">
    <?php $this->load->view('layout/flash'); ?>
    <h3>Photos</h3>

    <?php if (count($photos) > 0) {?>
      <p>Here are your photos uploaded.</p>
    <?php } else { ?>
      <p>Upload your photo files.</p>
    <?php } ?>

    <div class="photos-list-view">

      <?php foreach ($photos as $photo): ?>

        <div class="photos-list-item">
          <span><?= $photo->name ?></span>

          <div>
            <span><a href="<?= base_url() ?>photos/<?= $photo->name ?>" class="btn btn-success btn-xs">View</a></span>
            <span><a href="<?= site_url("photos/delete/" . $photo->id) ?>" class="btn btn-danger btn-xs">Delete</a></span>
          </div>
        </div>

      <?php endforeach; ?>

    </div>

    <div class="actions">
      <a href="<?= site_url('photos/upload') ?>" class="btn btn-primary">Upload New Photo</a>
    </div>
    <div class="actions">
      <a href="<?= site_url('users/logout') ?>" class="btn btn-warning">Logout</a>
    </div>
  </div>
</div>