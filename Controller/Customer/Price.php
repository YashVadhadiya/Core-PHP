<?php 

Ccc::loadClass('Controller_Core_Action');

class Controller_Customer_Price extends Controller_Core_Action 
{
    public function gridAction()
    {
        $content = $this->getLayout()->getContent();
        $customerPriceGrid = Ccc::getBlock('Customer_Price_Grid');
        $content->addChild($customerPriceGrid);
        $this->renderLayout();
    }

    public function saveAction()
    {
        $message = Ccc::getModel('Core_Message');
        try
        {
            if (!$this->getRequest()->getRequest('price')) 
            {
                throw new Exception("Invalid Request", 1);
            }
            $getSaveData = $this->getRequest()->getRequest();
            $customerId = (int)$this->getRequest()->getRequest('customerId');
            if(array_key_exists('exists',$getSaveData['price']))
            {
                foreach ($getSaveData['price']['exists'] as $productId => $price) 
                {
                    $customerPrice = Ccc::getModel('Customer_Price')->fetchRow("SELECT * FROM customer_price WHERE customerId = {$customerId} AND productId = $productId");
                    $customerPrice->customerPrice = $price;
                    $result = $customerPrice->save();
                    if(!$result)
                    {
                        throw new Exception("Customer Price not updated.", 1);
                    }
                }
            }
           
            if(array_key_exists('new', $getSaveData['price']))
            {
                foreach ($getSaveData['price']['new'] as $productId => $price) 
                {
                    $customerPrice = Ccc::getModel('Customer_Price');
                    $customerPrice->productId = $productId;
                    $customerPrice->customerId = $customerId;
                    $customerPrice->customerPrice = $price;
                    $customerPrice->save();
                }
            }

            $salesmanId = (int)$this->getRequest()->getRequest('id');
            $message->addMessage('Customer Price saved successfully.', Model_Core_Message::SUCCESS);
            $this->redirect($this->getUrl('grid',null,['id'=>$salesmanId,'customerId'=>$customerId],true));
        }
        catch (Exception $e) 
        {
            $message->addMessage($e->getMessage(), Model_Core_Message::ERROR);
            $this->redirect($this->getUrl('grid'));
        }


    }
    
}