<?php 

class Model_Core_Response
{
	public function render($content)
	{
		echo $content;
	}

	public function setHeader($key, $value)
	{
		header("Content-type:$value");
		return $this;
	}
}

