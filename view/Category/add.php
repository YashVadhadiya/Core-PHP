<?php $controllerCategory = new Controller_category(); ?>
<?php $urlAction = new Controller_Core_Action(); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Category Database</title>
</head>
<body>
    <table border="1" width="100%">
       <form method="post" action="<?php echo $urlAction->getUrl('save','category',null,true) ?>">
        <tr>
            <td>Chooese Category</td>   
            <td>
                <select name="category[parentId]">
                    <option value="">New Category</option>
                    <?php $result = $controllerCategory->getCategoryWithPath(); 
                    foreach($result as $key => $value): 
                        ?>
                    <option value=<?php echo $key; ?> >
                        <?php echo($value); ?>
                    </option>
                    <?php
                endforeach;
                ?>                  
                
            </select>
        </td>
    </tr>

    <tr>
        <td>Status</td>
        <td><select name="category[status]">
            <option value="1">Active</option>
            <option value="2">Inactive</option>
        </select>
    </td>
</tr>

<tr>
    <td>Category Name</td>
    <td>
        <input type="text" name="category[categoryName]">
    </td>
</tr>

<tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="submit" value="Submit">
        <button type="button"><a href="<?php echo $urlAction->getUrl('grid','category',null,true) ?>">Cancel</a></button></td>
    </tr>
</form>        
</table>
</body>
</html>