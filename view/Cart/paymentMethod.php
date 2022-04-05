<?php $paymentMethods = $this->getPaymentMethods();  ?>
<?php $cart = $this->getCart(); ?>


<h2>Payment Methods<h2>
    <table id="example2" class="table table-bordered table-hover">

        <?php foreach ($paymentMethods as $paymentMethod):?>
            <tr>
                <td><?php echo $paymentMethod->name?></td>
                <td>
                    <input type="radio" name="paymentMethod" value="<?php echo $paymentMethod->methodId ?>"<?php echo ($cart->paymentMethodId == $paymentMethod->methodId) ? 'checked' : '' ; ?>>
                </td>
            </tr>
        <?php endforeach; ?>  
        <tr> 
            <td>
                <button class="btn btn-success" type="button" onclick="savePaymentForm()">Save</button>

            </td>  
        </tr>          

    </table>
    
    <hr>
    <script type="text/javascript">
        function savePaymentForm() 
        {
//alert('button clicked');
admin.setForm(jQuery('#indexForm'));
admin.setUrl("<?php echo $this->getUrl('updatePaymentMethod') ?>");
admin.load();
}
</script>