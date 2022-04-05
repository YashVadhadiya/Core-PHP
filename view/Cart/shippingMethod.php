<?php $shippingMethods = $this->getShippingMethods(); ?>
<?php $cart = $this->getCart(); ?>

<h2>Shipping Methods<h2>
    <table id="example2" class="table table-bordered table-hover">

        <?php foreach ($shippingMethods as $shippingMethod):?>
            <tr>
                <td><?php echo $shippingMethod->name?></td>
                <td><?php echo $shippingMethod->price?></td>
                <td>
                    <input type="radio" name="shippingMethod" value="<?php echo $shippingMethod->methodId?>" <?php echo ($cart->shippingMethodId == $shippingMethod->methodId) ? 'checked' : '' ; ?>>
                </td>
            </tr>
        <?php endforeach; ?>  
        <tr> 
            <td>
                <button class="btn btn-success" type="button" onclick="saveShippinForm()">Save</button>
            </td>     
        </tr>    

    </table>

    <hr>

    <script type="text/javascript">
        function saveShippinForm() 
        {
            //alert('button clicked');
            admin.setForm(jQuery('#indexForm'));
            admin.setUrl("<?php echo $this->getUrl('updateShippingMethod') ?>");
            admin.load();
        }
    </script>