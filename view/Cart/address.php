<?php $billingAddress = $this->getBillingAddress(); ?>
<?php $shippingAddress = $this->getShippingAddress(); ?>
<?php $customer = $this->getCustomer(); ?>
<?php $cartBillingAddress= $this->getCartBillingAddress(); //var_dump($cartBillingAddress); die; ?>
<?php $cartShippingAddress= $this->getCartShippingAddress(); //var_dump($cartBillingAddress); die; ?>

<form action="<?php echo $this->getUrl('saveAddress') ?>" method="POST">
<table border="1" width="100%" cellspacing="4">

    <tr>
      <td colspan="2"><h2>Billing Information</h2></td>
    </tr>

    <tr>
      <td width="10%">First Name</td>
      <td><input type="text" id="billingAddress" name="customerBilling[firstName]" value="<?php if($cartBillingAddress) : echo $cartBillingAddress->firstName; else: echo $customer->firstName; endif;?>"></td>
    </tr>

    <tr>
      <td width="10%">Last Name</td>
      <td><input type="text" id="billingAddress" name="customerBilling[lastName]" value="<?php if($cartBillingAddress) : echo $cartBillingAddress->lastName; else: echo $customer->lastName; endif;?>"></td>
    </tr>

    <tr>
      <td width="10%">Phone</td>
      <td><input type="number" id="billingAddress" name="customerBilling[phone]" value="<?php if($cartBillingAddress) : echo $cartBillingAddress->phone; else: echo $customer->phone; endif;?>"></td>
    </tr>

    <tr>
      <td width="10%">email</td>
      <td><input type="text" id="billingAddress" name="customerBilling[email]" value="<?php if($cartBillingAddress) : echo $cartBillingAddress->email; else: echo $customer->email; endif;?>"></td>
    </tr>
    <tr>
      <td width="10%">Address</td>
      <td><input type="text" id="billingAddress" name="billingAddress[address]" value="<?php if($cartBillingAddress) : echo $cartBillingAddress->address; else: echo $billingAddress->address; endif;?>"></td>
    </tr>
    
    <tr>
      <td width="10%">City</td>
      <td><input type="text" id="billingCity" name="billingAddress[city]" value="<?php if($cartBillingAddress) : echo $cartBillingAddress->city; else: echo $billingAddress->city; endif;?>"></td>
    </tr>
    <tr>
      <td width="10%">State</td>
      <td><input type="text" id="billingState" name="billingAddress[state]" value="<?php if($cartBillingAddress) : echo $cartBillingAddress->state; else: echo $billingAddress->state; endif;?>"></td>
    </tr>
    <tr>
      <td width="10%">Postal Code</td>
      <td><input type="text" id="billingPostalcode" name="billingAddress[postalCode]" value="<?php if($cartBillingAddress) : echo $cartBillingAddress->postalCode; else: echo $billingAddress->postalCode; endif;?>"></td>
    </tr>
    <tr>
      <td width="10%">Country</td>
      <td><input type="text" id="billingCountry" name="billingAddress[country]" value="<?php if($cartBillingAddress) : echo $cartBillingAddress->country; else: echo $billingAddress->country; endif;?>"></td>
    </tr>
    <tr>
      <td colspan="2"><input type="checkbox" name="billingAddressBook" <?php if($billingAddress->same == 1):?> checked <?php endif; ?>>Add To AddressBook</td>
    </tr>
    <tr>
      <td colspan="2"><input type="checkbox" name="same" onclick="showHide(this)">Mark Shipping as Billing</td>
    </tr>
</table>


    <script type="text/javascript">
      function showHide(checkbox) {
        var shippingAddress = document.getElementById('shipping');
        shippingAddress.style.display = checkbox.checked ? "none" : "block";
      }
    </script>
<div id="shipping"  style="display:block;"  >
<table border="1" width="100%" cellspacing="4">
    <tr>
      <td colspan="2"><h2>Shipping Information</h2></td>
    </tr>

     <tr>
      <td width="10%">First Name</td>
      <td><input type="text" id="shippingAddress" name="customerShipping[firstName]" value="<?php if($cartShippingAddress) : echo $cartShippingAddress->firstName; else: echo $customer->firstName; endif;?>"></td>
    </tr>

    <tr>
      <td width="10%">Last Name</td>
      <td><input type="text" id="shippingAddress" name="customerShipping[lastName]" value="<?php if($cartShippingAddress) : echo $cartShippingAddress->lastName; else: echo $customer->lastName; endif;?>"></td>
    </tr>

    <tr>
      <td width="10%">Phone</td>
      <td><input type="number" id="shippingAddress" name="customerShipping[phone]" value="<?php if($cartShippingAddress) : echo $cartShippingAddress->phone; else: echo $customer->phone; endif;?>"></td>
    </tr>

    <tr>
      <td width="10%">email</td>
      <td><input type="text" id="shippingAddress" name="customerShipping[email]" value="<?php if($cartShippingAddress) : echo $cartShippingAddress->email; else: echo $customer->email; endif;?>"></td>
    </tr>

    <tr>
      <td width="10%">Address</td>
      <td><input type="text" id="shippingAddress" name="shippingAddress[address]" value="<?php if($cartShippingAddress) : echo $cartShippingAddress->address; else: echo $shippingAddress->address; endif;?>"></td>
    </tr>
    
    <tr>
      <td width="10%">City</td>
      <td><input type="text" id="shippingCity" name="shippingAddress[city]" value="<?php if($cartShippingAddress) : echo $cartShippingAddress->city; else: echo $shippingAddress->city; endif;?>"></td>
    </tr>
    <tr>
      <td width="10%">State</td>
      <td><input type="text" id="shippingState" name="shippingAddress[state]" value="<?php if($cartShippingAddress) : echo $cartShippingAddress->state; else: echo $shippingAddress->state; endif;?>"></td>
    </tr>
    <tr>
      <td width="10%">Postal Code</td>
      <td><input type="text" id="shippingPostalcode" name="shippingAddress[postalCode]" value="<?php if($cartShippingAddress) : echo $cartShippingAddress->postalCode; else: echo $shippingAddress->firstName; endif;?>"></td>
    </tr>
    <tr>
      <td width="10%">Country</td>
      <td><input type="text" id="shippingCountry" name="shippingAddress[country]" value="<?php if($cartShippingAddress) : echo $cartShippingAddress->country; else: echo $shippingAddress->country; endif;?>"></td>
    </tr>
    <tr>
      <td colspan="2"><input type="checkbox" name="shippingAddressBook" <?php if($billingAddress->same == 1):?> checked <?php endif; ?>>Add To Address Book</td>
    </tr>
</table>  
</div>
<button type="submit" name="submit" >Save </button>
</form>
<hr>