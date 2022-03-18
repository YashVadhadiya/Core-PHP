<?php $product = $this->getProduct(); ?>
<?php $categories = $this->getCategories(); ?>

<?php $getCategoryWithPath = $this->getCategoryWithPath(); ?>
<?php $categoryProductPair = $this->getCategoryProductPair(); ?>


    <table border="1" width="100%">
        <form action="<?php echo$this->getUrl('save','product',null, false) ?>" method="post">
            <tr>
                <td>Id</td>
                <td><input type="text" name="product[id]" value="<?php echo $product->id; ?>" readonly></td>
            </tr>
            <tr>
                <td>Name</td>
                <td><input type="text" name="product[name]" value="<?php echo $product->name; ?>"></td>
            </tr>
            <tr>
                <td>Price</td>
                <td><input type="text" name="product[price]" value="<?php echo $product->price; ?>"></td>
            </tr>
            <tr>
                <td>Quantity</td>
                <td><input type="text" name="product[quantity]" value="<?php echo $product->quantity; ?>"></td>
            </tr>
            <tr>
                <td>SKU</td>
                <td><input type="text" name="product[sku]" value="<?php echo $product->sku; ?>"></td>
            </tr>
            <tr>
                <td>Status</td>
                <td><select name="product[status]">
                        <?php foreach ($product->getStatus() as $key => $value): ?>
                        <option <?php if($product->status == $key): ?> selected <?php endif; ?> value="<?php echo $key; ?>"> <?php echo $value; ?></option>
                            <?php endforeach; ?>
                    </select></td>
            </tr>

            <tr>
        <td width="10%">Categories</td>
        <td>
          <table border='1'>
            <tr>
              <th>Category Id</th>
              <th>Category Name</th>
              <th>Check Box</th>
            </tr>
              
        <?php foreach ($categories as $categoryProduct): ?>
        <tr>
            <td><?php echo $categoryProduct->categoryId ?></td>
            <td><?php $result = $getCategoryWithPath; 
                        echo $result[$categoryProduct->categoryId];?>
            </td>
          <td><input type="checkbox" name="product[category][]" value="<?php echo $categoryProduct->categoryId ?>"<?php if($categoryProductPair):
            if(in_array($categoryProduct->categoryId, $categoryProductPair)): ?>
              checked
            <?php endif; ?>
            <?php endif; ?>></td>
          </tr>
        <?php endforeach; ?>
          </table>
        </td>
      </tr>

            <tr>
                <td></td>
                <td><input type="submit" name="submit" value="Save">
                    <button type="button"><a href="<?php echo $this->getUrl('grid','product',null,true) ?>">Cancel</a></button>
                </td>
            </tr>
        </form>
    </table>