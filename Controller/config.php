<?php
Ccc::loadClass("Controller_Core_Action");
Ccc::loadClass("Model_Core_Request");

class Controller_Config extends Controller_Core_Action
{
    public function gridAction()
    {
        Ccc::getBlock("Config_Grid")->toHtml();
    }

    protected function saveConfig()
    {
        $config = Ccc::getModel('Config');
        $date = date("Y-m-d H:i:s");
        $getSaveData = $this->getRequest()->getRequest("config");

        if(!array_key_exists('configId', $getSaveData))
        {
            $config->name = $getSaveData["name"];
            $config->code = $getSaveData["code"];
            $config->value = $getSaveData["value"];
            $config->status = $getSaveData["status"];
            $config->createdAt = $date;
            $result = $config->save();
        }
        else
        {
            $config->load($getSaveData['configId']);
            $config->configId = $getSaveData["configId"];
            $config->name = $getSaveData["name"];
            $config->code = $getSaveData["code"];
            $config->value = $getSaveData["value"];
            $config->status = $getSaveData["status"];
            $result = $config->save();
        }
    }

    public function saveAction()
    {
        $config = Ccc::getModel('Config');
    
        try
        {
            $configId = $this->saveconfig();
            $this->redirect($this->getUrl("grid","config",null,true));
        }
        catch (Exception $e) 
        {
            echo $e->getMessage();
        }
    }

    public function addAction()
    {
        Ccc::getBlock("Config_Add")->toHtml();
    }

    public function editAction()
    {
        try
        {
            $configId = (int)$this->getRequest()->getRequest("configId");
            if (!$configId)
            {
                throw new Exception("Edit is not working", 1);
            }
            $config = Ccc::getModel("Config")->load($configId);
            
            if (!$config) {
                throw new Exception("This is not config Id", 1);
            }
            Ccc::getBlock("Config_Edit")->addData("config", $config)->toHtml();
        }
        catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function deleteAction()
    {
        $getDelete = $this->getRequest()->getRequest("configId");
        $config = Ccc::getModel("Config")->load($getDelete);
        $result = $config->delete();
    
        if ($result)
        {
            $this->redirect($this->getUrl("grid", "config", null, true));
        }
    }
    public function errorAction()
    {
        echo "error";
    }
} 
?>
