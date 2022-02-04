<!DOCTYPE html>
<html>
<head>
	<title>Category Database</title>
</head>
<body>
    <div class="form-tbl">
	<form method="post" action="index.php?a=saveAction"> 
</br>
        <label for="">name</label>
        <input type="text" name="name" placeholder="Enter Name">
</br>
        <label for="">Status</label>
        <input type="text" name="status" placeholder="Enter Status (active-1, inactive-2)">
</br>
        <input type="submit" name="submit" value="Submit">
        <a href="index.php?a=gridAction" type="submit">View Database</a>
</br>   
        

        </form>
        </div>
    </body>
</html>