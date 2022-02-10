<!DOCTYPE html>
<html>
<head>
	<title>Category Database</title>
</head>
<body>
    <table border="1" width="100%">
	<form method="post" action="index.php?c=category&a=save"> 

        <tr>
            <td>Chooese Category</td>   
            <td><select name="category">
                <option value="1">Electronics</option>
                <option value="2">Fashion</option>
                <option value="3">Home Applinces</option>
                <option value="4">Home Applinces1</option>
                <option value="5">Home Applinces1</option>
                <option value="6">Home Applinces1</option>
            </select>
            </td>
            <!-- <td><input type="text" name="categoryName" required></td> -->
        <!-- </tr> -->
            
        </tr>

        <tr>
            <td>Status</td>
            <td><select name="status">
                <option value="1">Active</option>
                <option value="2">Inactive</option>
                </select>
            </td>
        </tr>

        <tr>
            <td>Category Name</td>
            <td>
                <input type="text" name="categoryName">
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