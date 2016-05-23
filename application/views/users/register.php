<div class="container">
  <div class="subscribe-container center-block">
    <?php $this->load->view('layout/flash'); ?>
    <h3>Billing</h3>

    <p>Please complete all fields.</p>

    <form role="form" class="new-user" id="new_user" action="<?php echo site_url('users/register');?>" method="post">

      <div class="field">
        <label>Email</label>
        <input class="form-control" placeholder="Email" type="email" name="email" id="user_email">
      </div>

      <div class="field">
        <label>Payment Information</label>


        <div class="row field">
          <div class="col-md-12">
            <input class="form-control" placeholder="Name On Credit Card" type="text"
                   name="credit_card[cardholder_name]" id="credit_card_cardholder_name">
          </div>
        </div>
        <div class="row field">
          <div class="col-md-12">
            <input class="form-control" placeholder="Credit Card" type="text" name="credit_card[credit_card_number]"
                   id="credit_card_credit_card_number">
          </div>
        </div>
        <div class="row field">
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
    <br>

    <p>You will receive an email with a confirmation code number, once your payment has been processed.</p>

  </div>
</div>

<script>
  $(function () {
    initializeUserRegistrationForm("<?php echo site_url();?>");
  });
</script>