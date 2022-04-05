<center>
<?php 
$message = Ccc::getBlock('Core_Message');
$messages = $message->getMessages();

if($messages)
{
  	foreach ($messages as $key => $value)
  	{ 
		 print_r($value); 
	}
		
} 
?>
</center>