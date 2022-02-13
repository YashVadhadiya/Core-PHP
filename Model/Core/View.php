<?php
echo "<pre>";

class Model_Core_View
{

    public $template = null;

    public $data = [];

    public function getTemplate()
    {
        return $this->template;
    }

    public function setTemplate($template)
    {
        $this->template = $template;
        return $this;
    }

    public function toHtml()
    {
        $data = $this->data;
        require ($this->getTemplate());
    }

    public function getData()
    {
        return $this->data;
    }

    public function setData(array $data)
    {
        $this->data = $data;
        return $this;
    }

    public function addData($key, $value)
    {
        $this->data[$key] = $value;
        return $this;
    }

    public function removeData($key)
    {
        if (array_key_exists($key, $this->data))
        {
            unset($this->data[$key]);
        }
        return $this;
    }
}

?>
