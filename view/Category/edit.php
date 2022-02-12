 <?php
 require_once('Model/Core/Adapter.php');
 $adapter = new Model_Core_Adapter();
 $id = $_GET['id'];
 $category = $adapter->fetchRow("SELECT * FROM `category` WHERE `categoryId` = $id");

 $categoryId = $category['categoryId'];
 $categoryName = $category['categoryName'];
 $status = $category['status'];
 $parentId = $parentId['parentId'];
 ?>

 <!DOCTYPE html>
 <html>
 <head>
       <title>Update Category</title>
</head>

<body>
        <table border="1" width="100%">
                <form method="post" action="index.php?c=category&a=save">
                        <tr>
                                <td>Id</td>
                                <td><input type="text" name="categoryId" value="<?php echo $categoryId; ?>" readonly></td>
                                <tr>
                                        <td>Category Name</td>
                                        <td><input type="text" name="category" value="<?php echo $categoryName; ?>" required></td>
                                </tr>
                                <tr>
                                        <td>Status</td>
                                        <td>
                                                <select name="status">
                                                        <option value="1" <?php if($status == 1) echo 'selected'; ?>>Active</option>
                                                        <option value="2" <?php if($status == 2) echo 'selected'; ?>>Inactive</option>
                                                </select>
                                        </td>
                                </tr>
                                <tr>
                                        <td>Sub-Category Name</td>
                                        <td><input type="text" name="categoryName" value="<?php echo $parentId; ?>">
                                                
                                        </td>
                                </tr>
                                <tr>
                                        <td>&nbsp;</td>
                                        <td><input type="submit" name="submit" value="Submit">
                                                <button type="button"><a href="index.php?c=category&a=grid">Cancel</a></button></td>
                                        </tr>
                                </form>
                        </table>
                </body>
                </html>