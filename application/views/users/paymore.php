<div class="container">
  <div class="subscribe-extend-container form-container center-block">
    <?php $this->load->view('layout/flash'); ?>
    <h3>Billing</h3>

    <p>Please complete all fields.</p>

    <form role="form" class="new-user" id="new_user" action="<?php echo site_url('users/paymore');?>" method="post">

      <div class="field">
        <h4>Amount</h4>

        <div class="field">
          <label class="amount-photos-count-label" for="amount_photos_count">Count:</label>
          <select class="amount-photos-count form-control"
                  name="amount_photos_count" id="amount_photos_count">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="10">10</option>
            <option value="11">11</option>
            <option value="12">12</option>
            <option value="13">13</option>
            <option value="14">14</option>
            <option value="15">15</option>
            <option value="16">16</option>
            <option value="17">17</option>
            <option value="18">18</option>
            <option value="19">19</option>
            <option value="20">20</option>
          </select>
          <label class="amount-total-label">Total:</label>
          <label class="amount-total-value" id="amount_total_value">$2</label>
          <p>You can upload up to 20 photos in total in the contest, 2$ per one photo. Please select additional count of photos to increase.</p>
        </div>
      </div>

      <div class="field">
        <h4>Payment Information</h4>

        <div class="row mid-field">
          <div class="col-md-12">
            <input class="form-control" placeholder="Name On Credit Card" type="text"
                   name="credit_card[cardholder_name]" id="credit_card_cardholder_name">
          </div>
        </div>
        <div class="row mid-field">
          <div class="col-md-12">
            <input class="form-control" placeholder="Credit Card" type="text" name="credit_card[credit_card_number]"
                   id="credit_card_credit_card_number">
          </div>
        </div>
        <div class="row mid-field">
          <div class="col-md-12">
            <label class="subscribe-credit-card-expiration-label" for="credit_card_credit_card_expiration">Exp:</label>
            <select class="subscribe-credit-card-expiration-month form-control"
                    name="credit_card[credit_card_expiration_month]" id="credit_card_credit_card_expiration_month">
              <option value="01">01</option>
              <option value="02">02</option>
              <option value="03">03</option>
              <option value="04">04</option>
              <option value="05">05</option>
              <option value="06">06</option>
              <option value="07">07</option>
              <option value="08">08</option>
              <option value="09">09</option>
              <option value="10">10</option>
              <option value="11">11</option>
              <option value="12">12</option>
            </select>
            /
            <select class="subscribe-credit-card-expiration-year form-control"
                    name="credit_card[credit_card_expiration_year]" id="credit_card_credit_card_expiration_year">
              <option value="16">2016</option>
              <option value="17">2017</option>
              <option value="18">2018</option>
              <option value="19">2019</option>
              <option value="20">2020</option>
              <option value="21">2021</option>
              <option value="22">2022</option>
              <option value="23">2023</option>
              <option value="24">2024</option>
              <option value="25">2025</option>
              <option value="26">2026</option>
              <option value="27">2027</option>
              <option value="28">2028</option>
              <option value="29">2029</option>
              <option value="30">2030</option>
              <option value="31">2031</option>
              <option value="32">2032</option>
              <option value="33">2033</option>
              <option value="34">2034</option>
              <option value="35">2035</option>
              <option value="36">2036</option>
            </select>
            <input class="subscribe-credit-card-cvv form-control pull-right" placeholder="CVV" type="text"
                   name="credit_card[cvv]" id="credit_card_cvv">
          </div>
        </div>
      </div>

      <div class="actions">
        <button name="button" type="submit" class="btn btn-primary">Submit Payment</button>
      </div>
    </form>

    <p>You will get back to the photo upload page, once your payment has been processed.</p>

  </div>
</div>

<script>
  $(function () {
    initializeUserRegistrationForm("<?php echo site_url();?>");
  });
</script>