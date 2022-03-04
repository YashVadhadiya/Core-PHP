<?php 
$msg = Ccc::getBlock('Core_Message');
$msg1 = $msg->getMessages();
if($msg1)
{
  	foreach ($msg1 as $key => $value)
  	{ 
		 print_r($value); 
	}
} 
?>