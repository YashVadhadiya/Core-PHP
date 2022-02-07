<!DOCTYPE html>
<html>
<head>
	<title>Category Database</title>
</head>
<body>
    <div class="form-tbl">
	<form method="post" action="index.php?c=category&a=save"> 
</br>
        <label for="">name</label>
        <input type="text" name="name" placeholder="Enter Name">
</br>
        <label for="">Status</label>
        <select name="status">
		<option value="1">Active</option>
		<option value="2">Inactive</option>
	</select>
</br>
        <input type="submit" name="submit" value="Submit">
        <button type="button"><a href="index.php?c=category&a=grid">Cancel</a></button></br>   
        

        </form>
        </div>
    </body>
</html>