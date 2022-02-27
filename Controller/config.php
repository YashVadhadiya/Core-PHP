<?php
Ccc::loadClass("Controller_Core_Action");
Ccc::loadClass("Model_Core_Request");

class Controller_Config extends Controller_Core_Action
{
    public function gridAction()
    {
        Ccc::getBlock("Config_Grid")->toHtml();
    }

    public function saveAction()
    {
        $config = Ccc::getModel('Config');
        $date = date("Y-m-d H:i:s");
        $getSaveData = $this->getRequest()->getRequest("config"); 

        try
        {
            if (!isset($getSaveData)) 
            {
            throw new Exception("You can not insert data in config.", 1);
            }

            if(array_key_exists('configId', $getSaveData) && $getSaveData['configId'] == null)
            {
            $config->name = $getSaveData["name"];
            $config->code = $getSaveData["code"];
            $config->value = $getSaveData["value"];
            $config->status = $getSaveData["status"];
            $config->createdAt = $date;
            $result = $config->save();

            if (!$result) 
                {
                    throw new Exception("System is not able to insert", 1);
                } 
                else 
                {
                    $this->redirect($this->getUrl("grid", "config", null, true));
                }
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

            if (!$result) 
                {
                    throw new Exception("System is not able to update", 1);
                } 
                else 
                {
                    $this->redirect($this->getUrl("grid", "config", null, true));
                }
            }
        }
        catch (Exception $e) 
        {
            echo $e->getMessage();
        }
    }

    public function addAction()
    {
        $configId = Ccc::getModel("Config");
        //Ccc::getBlock("Config_Add")->toHtml();
        Ccc::getBlock("Config_Edit")->addData("config", $configId)->toHtml();

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
            //$config->fetchRow("SELECT * FROM config WHERE configId = $configId");
            
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
