<?php
$message = $this->session->flashdata('result');
if(isset($message)) {
  ?>
  <div class="alert alert-<?php echo $message['class']?>">
    <strong>
      <?php
      if ($message['class'] == 'success')
        echo 'Success!';
      elseif ($message['class'] == 'danger')
        echo 'Error!';
      ?>
    </strong>
    <?php echo $message['message']; ?>
  </div>
  <?php
}
?>