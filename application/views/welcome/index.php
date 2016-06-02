<div class="container">

  <h3>Photo Shoot Competition Application</h3>

  <div class="live-counter">
    <p id="live_counter_detail"></p>
  </div>
  <script>
    $(function () {
      initializeCounter("<?php echo site_url();?>");
    });
    function initializeCounter($base_path) {
      function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
      }
      var poller = function() {
        $.get('http://www.deangelomotors.com/app/index.php/live/counter', function(response) {
          $('#live_counter_detail').text('Current grand prize is $'+numberWithCommas(response));
        });
      };
      setInterval(poller, 2000);
    }
  </script>

  <div class="field">
    <p>You will need to submit payment to enter contest.</p>
    <span><a href="<?= site_url("users/register") ?> "class="btn btn-primary">Submit Payment</a></span>
  </div>

  <div class="field">
    <p>Already have participant code?</p>
    <span><a href="<?= site_url("photos/index") ?>"class="btn btn-success">Upload photo</a></span>
  <div class="field">

</div>

