<?php 

class Model_Core_Message
{
	const SUCCESS = 'success';
	const ERROR = 'error' ;
	const WARNING = 'warning';
	protected $session = null;

	public function setSession($session)
	{
		$this->session = $session;
		return $this;
	}

	public function getSession()
	{
		if(!$this->session)
		{
			$this->setSession(Ccc::getModel('Core_Session'));
		}
		return $this->session;
	}

	public function addMessage($message , $type = self::SUCCESS)
	{
		$messages = ($this->getSession()->messages) ? $this->getSession()->messages : [];

		$messages[$type] = $message;
		$this->getSession()->messages = $messages;
		return $this;
	}

	public function getMessages()
	{
		return $this->getSession()->messages;
	}

	public function unsetMessage()
	{
		unset($this->getSession()->messages);
	}

}