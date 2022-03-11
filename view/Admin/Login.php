<?php $urlAction = new Controller_Core_Action();?>
<?php 
	$messages = $this->getMessages();
	if($messages) 
	{
	    foreach ($messages as $key => $value) 
	    {
	        echo $value;
	    }
	} 
?>
<form action="<?php echo $urlAction->getUrl('loginPost'); ?>" method="POST">
	<table border="1" width="100%">
		<tr>
			<th colspan="2">Admin Login</th>
		</tr>
		<tr>
			<td>Email</td>
			<td><input type="email" name="admin[email]" required></td>
		</tr>
		<tr>
			<td>Password</td>
			<td><input type="password" name="admin[password]" required></td>
		</tr>
		<tr>
			<td></td>
			<td><input type="submit" name="login" value="Login">
			<button type="button"><a href="<?php echo $urlAction->getUrl('login','admin_login',null,true) ?>">Cancel</a></button></td>
		</tr>
	</table>
</form>