<?php 

Ccc::loadClass('Block_Core_Template');

class Block_Core_Message extends Block_Core_Template
{

	public function __construct()
	{
		$this->setTemplate('view/core/layout/header/message.php');
	}

	public function getMessages()
	{
		$message = Ccc::getModel('Admin_Message');
		$messages = $message->getMessages();
		$message->unsetMessage();
		return $messages;
	}
}


?>