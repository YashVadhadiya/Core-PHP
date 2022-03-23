<?php Ccc::loadClass('Controller_Core_Action');?>
<?php Ccc::loadClass('Model_Core_Request');?>
<?php
class Controller_Order extends Controller_Core_Action
{
    public function gridAction()
    {
        $this->setTitle('Order Grid');
        $content = $this->getLayout()->getContent();
        $orderGrid = Ccc::getBlock('Order_Grid');
        $content->addChild($orderGrid);
        $this->renderLayout();
    }

    public function editAction()
    {
        $this->setTitle('Order Edit');
        $message = $this->getMessage();
        try
        {
            $orderId = (int)$this->getRequest()->getRequest('id');
            if (!$orderId)
            {
                throw new Exception('Edit is not working');
            }
            $order = Ccc::getModel('Order')->load($orderId);
            
            if (!$order) 
            {
                throw new Exception("Invalid Id.");
            }
            $content = $this->getLayout()->getContent();
            $orderEdit = Ccc::getBlock('Order_Edit')->setData(['order' => $order]);
            $content->addChild($orderEdit);
            $this->renderLayout();
        }
        catch (Exception $e)
        {
            $message->addMessage($e->getMessage(), Model_Core_Message::ERROR);
            $this->redirect($this->getLayout()->getUrl('grid', 'order', null, true));        
        }
    }

    public function saveAction()
    {
        $order = Ccc::getModel('order');
        $date = date('Y-m-d H:i:s');
        $getSaveData = $this->getRequest()->getRequest('order'); 
        $message = $this->getMessage();

        try
        {
            if (!$getSaveData)
            {
            throw new Exception('You can not insert data in order.');
            }

            $orderId = (int)$this->getRequest()->getRequest('id');
            $order = Ccc::getModel('order')->load($orderId);

            if(!$order)
            {
                $order = Ccc::getModel('order');
                $order->setData($getSaveData);
            }
            else
            {
                $order->setData($getSaveData);
                $order->updatedAt = $date;
            }
                $result = $order->save();

            if (!$result) 
            {
                throw new Exception("System is not able to update.");
            } 
            else 
            {
                $message->addMessage('Data Saved.');
                $this->redirect($this->getLayout()->getUrl('grid', 'order', null, false));
            }
        }
        catch (Exception $e) 
        {
            $message->addMessage($e->getMessage(), Model_Core_Message::ERROR);
            $this->redirect($this->getLayout()->getUrl('grid', 'order', ['id' => null], false));        
        }
    }
}