<!DOCTYPE html>
<html>
  <head>
    <meta content="text/html;charset=utf-8" http-equiv="Content-Type" />
    <meta content="utf-8" http-equiv="encoding" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/windcave/global.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/windcave/storefront.css" />
  </head>
  <body>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/windcave/global.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/windcave//storefront.js"></script>

    <div id="navbar"></div>

    <div id="content">
      <div id="error" class="form-section hidden"></div>

      <div id="customer" class="form-section">
        <div class="form-section-title">Customer Details</div>

        <div class="space-between">
          <div class="form-section-field width-48">
            <label for="first-name">First Name</label>
            <input type="text" id="first-name" name="firstName" value="John" />
          </div>

          <div class="form-section-field width-48">
            <label for="last-name">Last Name</label>
            <input type="text" id="last-name" name="lastName" value="Doe" />
          </div>
        </div>

        <div class="space-between">
          <div class="form-section-field width-48">
            <label for="email">Email</label>
            <input type="text" id="email" name="email" value="john.doe@hosting.com" />
          </div>

          <div class="form-section-field width-48">
            <label for="phone-number">Phone Number</label>
            <input type="text" id="phone-number" name="phoneNumber" value="+6421384236" />
          </div>
        </div>
      </div>

      <div class="space-between">
        <div id="billing" class="form-section width-45">
          <div class="form-section-title">Billing Address</div>

          <div class="form-section-field">
            <label for="billing-name">Name</label>
            <input type="text" id="billing-name" name="name" value="John Doe" />
          </div>

          <div class="form-section-field">
            <label for="billing-address1">Address 1</label>
            <input type="text" id="billing-address1" name="address1" value="Address 1" />
          </div>

          <div class="form-section-field">
            <label for="billing-address2">Address 2</label>
            <input type="text" id="billing-address2" name="address2" value="Address 2" />
          </div>

          <div class="form-section-field">
            <label for="billing-address3">Address 3</label>
            <input type="text" id="billing-address3" name="address3" value="Address 3" />
          </div>

          <div class="space-between">
            <div class="form-section-field width-48">
              <label for="billing-city">City</label>
              <input type="text" id="billing-city" name="city" value="Auckland" />
            </div>

            <div class="form-section-field width-48">
              <label for="billing-postal-code">Postal Code</label>
              <input type="text" id="billing-postal-code" name="postalCode" value="1234" />
            </div>
          </div>

          <div class="form-section-field">
            <label for="billing-country-code">Country</label>
            <select id="billing-country-code" name="countryCode">
              <option value="NZ" selected>New Zealand</option>
              <option value="USA">United States</option>
            </select>
          </div>

          <div class="space-between">
            <div class="form-section-field width-48">
              <label for="billing-phone-number">Phone Number</label>
              <input type="text" id="billing-phone-number" name="phoneNumber" value="+123456789" />
            </div>

            <div class="form-section-field width-48">
              <label for="billing-state">State</label>
              <input type="text" id="billing-state" name="state" value="State" />
            </div>
          </div>
        </div>

        <div id="shipping" class="form-section width-45">
          <div class="space-between">
            <div class="form-section-title">Shipping Address</div>
            <div>
              <label><input type="checkbox" id="same-as-billing" onclick="setHidden('shipping-fields', this.checked);" />Same as billing</label>
            </div>
          </div>

          <div id="shipping-fields">
            <div class="form-section-field">
              <label for="shipping-name">Name</label>
              <input type="text" id="shipping-name" name="name" value="John Doe" />
            </div>

            <div class="form-section-field">
              <label for="shipping-address1">Address 1</label>
              <input type="text" id="shipping-address1" name="address1" value="Another Address 1" />
            </div>

            <div class="form-section-field">
              <label for="shipping-address2">Address 2</label>
              <input type="text" id="shipping-address2" name="address2" value="Another Address 2" />
            </div>

            <div class="form-section-field">
              <label for="shipping-address3">Address 3</label>
              <input type="text" id="shipping-address3" name="address3" value="Another Address 3" />
            </div>

            <div class="space-between">
              <div class="form-section-field width-48">
                <label for="shipping-city">City</label>
                <input type="text" id="shipping-city" name="city" value="New York City" />
              </div>

              <div class="form-section-field width-48">
                <label for="shipping-postal-code">Postal Code</label>
                <input type="text" id="shipping-postal-code" name="postalCode" value="12345" />
              </div>
            </div>

            <div class="form-section-field">
              <label for="shipping-country-code">Country</label>
              <select id="shipping-country-code" name="countryCode">
                <option value="NZ">New Zealand</option>
                <option value="US" selected>United States</option>
              </select>
            </div>

            <div class="space-between">
              <div class="form-section-field width-48">
                <label for="shipping-phone-number">Phone Number</label>
                <input type="text" id="shipping-phone-number" name="phoneNumber" value="+987654321" />
              </div>

              <div class="form-section-field width-48">
                <label for="shipping-state">State</label>
                <input type="text" id="shipping-state" name="state" value="New York" />
              </div>
            </div>
          </div>
        </div>
      </div>

      <div id="payment" class="form-section hidden">
        <div class="form-section-title">Payment</div>

        <div id="has-saved-card" class="hidden">
          <div class="form-section-field">
            <div>
              <label>
                <input type="radio" id="use-saved-card" name="useSavedCard" value="true" checked />
                Proceed with a saved card
              </label>
            </div>

            <div id="saved-card-wrapper" class="form-section-field">
              <select id="saved-card" name="savedCard"></select>
            </div>
          </div>

          <div class="form-section-field">
            <div>
              <label>
                <input type="radio" id="use-saved-card" name="useSavedCard" value="false" />
                Proceed without using saved card
              </label>
            </div>

            <div id="save-card-wrapper" class="form-section-field">
              <label>
                <input type="checkbox" name="saveCard" />
                Save card for future purchases
              </label>
            </div>
          </div>
        </div>

        <div id="can-save-card" class="form-section-field hidden">
          <label>
            <input type="checkbox" name="saveCard" />
            Save card for future purchases
          </label>
        </div>
      </div>

      <div id="button-wrapper">
        <button class="button" onclick="submitPayment();">Submit</button>
      </div>
    </div>
  </body>
</html>
