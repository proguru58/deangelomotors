<div class="container">
  <div class="photos-container center-block">
    <?php $this->load->view('layout/flash'); ?>
    <h3>Photos</h3>

    <p>Here are your photos.</p>
    <div class="photos-list-view">

      <?php foreach ($photos as $photo): ?>

        <div class="photos-list-item">
          <span><?= $photo->name ?></span>

          <div class="pull-right">
            <span><a href="<?= base_url() ?>photos/<?= $photo->name ?>" class="btn btn-success btn-xs">View</a></span>
            <span><a href="<?= site_url("photos/delete/" . $photo->id) ?>" class="btn btn-danger btn-xs">Delete</a></span>
          </div>
        </div>

      <?php endforeach; ?>

    </div>

    <div class="actions">
      <a href="<?= site_url('photos/upload') ?>" class="btn btn-primary">Upload New Photo</a>
      <a href="<?= site_url('users/logout') ?>" class="btn btn-warning">Logout</a>
    </div>
    <br style="clear:both; height: 0px;"/>

  </div>
</div>