<?php $customers = $this->getCustomers(); ?>

<table border="1" width="100%" cellspacing="4">
	
	<td>Customer List</td>
      <td>
        <select name="customerId" onchange="url(this)">
            <option>Select Customer</option>
            <?php foreach ($customers as $customer):?>
                <option value="<?php echo $customer->id?>">
                	<?php echo $customer->id; ?>
                </option>
             <?php endforeach; ?>            
        </select>
      </td>
  </tr>

</table>

<script type="text/javascript">
    function url(ele) 
    {
        var page = ele.value;
        var pageUrl = "<?php echo $this->getUrl('cartCheck','cart',null,true) ?>&id="+ele.value;
        window.open(pageUrl,"_self");   
    }
</script>

    