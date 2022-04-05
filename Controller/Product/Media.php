<?php Ccc::loadClass('Controller_Core_Action'); ?>
<?php Ccc::loadClass('Model_Product_Media'); ?>
<?php Ccc::loadClass('Model_Core_Request'); ?>
<?php

class Controller_Product_Media extends Controller_Core_Action
{
    public function gridAction()
    {
        $this->setTitle("Media Grid");
        $content = $this->getLayout()->getContent();
        $mediaGrid = Ccc::getBlock("Product_Media_grid");
        $content->addChild($mediaGrid);
        $this->renderLayout();
    }

    public function gridBlockAction()
    {
        $productMediaGrid = Ccc::getBlock("Product_Media_Grid")->toHtml();
        $messageBlock = Ccc::getBlock('Core_Message')->toHtml();
        $response = [
            'status' => 'success',
            'content' => $productMediaGrid,
            'message' => $messageBlock,
        ] ;
        $this->renderJson($response);

    }

    public function saveAction()
    {
        $message = $this->getMessage();
        $adapter = $this->getAdapter();
        try 
        {

            $productId = $this->getRequest()->getRequest('id');

            $mediaModel = Ccc::getModel('Product_Media');

            if(!$this->getRequest()->isPost())
            {
                throw new Exception("Invalid Request" );
            }

            $rows = $this->getRequest()->getPost();

            if(!$rows)
            {
                throw new Exception("Id not valid.");
            }

            $media = $rows['media'];
            $removeArr = $rows['media']['remove'];

            if(array_key_exists('remove',$media))
            {

                $removeIds = [];
                foreach($removeArr as $key => $value)
                {
                    array_push($removeIds ,$value);
                }
                $removeIdsImplode = implode(",",$removeIds);

                $query1 = "SELECT imageId , image FROM `product_media` WHERE `imageId` IN($removeIdsImplode) ";
                $result1 = $adapter->fetchPairs($query1);

                $query="DELETE FROM `product_media` WHERE `imageId` IN($removeIdsImplode)";
                $result = $adapter->delete($query);
                if(!$result)
                {
                    throw new Exception("System is unable to delete record.");
                }
                $message->addMessage('Delete Successfully.');   
                foreach($result1 as $key => $value){
                    if($result)
                    {
                        unlink($mediaModel->getImagePath() . $value);
                    }
                }

            }


            $query = "SELECT imageId,productId FROM `product_media` WHERE `productId` = $productId";
            $result = $adapter->fetchPairs($query);

            if(!$result)
            {
                throw new Exception("System is unable to fetch Pairs.");
            }
            $ids = array_keys($result);
            $implodeIds = implode(",",$ids);

            $query = "UPDATE `product_media` SET status = 0, thumb = 0, base = 0, small = 0 , gallery = 0 WHERE imageId IN ($implodeIds)";

            $result = $adapter->update($query);

            if(!$result)
            {
                throw new Exception("Update Unsuccessfully.");
            }
            $message->addMessage('Update Successfully.');


            $status = $rows['media']['status'];
            if(array_key_exists('status',$media))
            {
                $statusIds = [];
                foreach($status as $key => $value)
                {
                    array_push($statusIds ,$value);
                }
                $statusIdsImplode = implode(",",$statusIds);

                $query="UPDATE `product_media` SET `status`= 1 WHERE `imageId` IN($statusIdsImplode)";
                $result = $adapter->update($query);

                if(!$result)
                {
                    throw new Exception("Update Unsuccessfully.");
                }
                $message->addMessage('Update Successfully.');
            }


            $gallery = $rows['media']['gallery'];
            if(array_key_exists('gallery',$media))
            {
                $galleryIds = [];
                foreach($gallery as $key => $value)
                {
                    array_push($galleryIds ,$value);
                }
                print_r($galleryIds);
                $galleryIdsImplode = implode(",",$galleryIds);
                $query="UPDATE `product_media` SET `gallery`= 1 WHERE `imageId` IN($galleryIdsImplode)";


                $result = $adapter->update($query);

                if(!$result)
                {
                    throw new Exception("Update Unsuccessfully.");
                }
                $message->addMessage('Update Successfully.');
            }



            $base = $rows['media']['base'];
            if(array_key_exists('base',$media))
            {
                $query="UPDATE `product_media` SET `base`= 1 WHERE `imageId` = {$base}";
                $result = $adapter->update($query);

                if(!$result)
                {
                    throw new Exception("Update Unsuccessfully.");
                }
                $message->addMessage('Update Successfully.');
            }

            $thumb = $rows['media']['thumb'];
            if(array_key_exists('thumb',$media))
            {
                $query="UPDATE `product_media` SET `thumb`= 1 WHERE `imageId` = {$thumb}";
                $result = $adapter->update($query);

                if(!$result)
                {
                    throw new Exception("Update Unsuccessfully.");
                }
                $message->addMessage('Update Successfully.');
            }

            $small = $rows['media']['small'];
            if(array_key_exists('small',$media))
            {
                $query="UPDATE `product_media` SET `small`= 1 WHERE `imageId` = {$small}";
                $result = $adapter->update($query);

                if(!$result)
                {
                    throw new Exception("Update Unsuccessfully.");
                }
                $message->addMessage('Update Successfully.');
            }

            $this->redirect($this->getLayout()->getUrl('gridBlock','product',['id'=> $productId]));

        } catch (Exception $e) 
        {
            $message->addMessage($e->getMessage(),Model_Core_Message::ERROR);
            $this->redirect($this->getLayout()->getUrl('grid',null,null,true));
        }
    }

    public function addAction()
    {

        try {
            $message = $this->getMessage();
            $productId = $this->getRequest()->getRequest('id');
            $mediaModel = Ccc::getModel('Product_Media');
            $imageName1 = $_FILES['image']['name'];
            $imageAddress1 = $_FILES['image']['tmp_name'];
            $imageName = implode("", $imageName1);
            $imageName = date("mjYhis")."-".$imageName;
            $imageAddress = implode("", $imageAddress1);

            if(move_uploaded_file($imageAddress , $mediaModel->getImagePath() . $imageName))
            {
                $adapter = $this->getAdapter();
                $query =  "INSERT INTO `product_media`( `productId`, `image`, `base`, `thumb`, `small`, `gallery`, `status`) VALUES ({$productId},'$imageName',0,0,0,0,0)";

                $result = $adapter->insert($query);

                if(!$result)
                {
                    throw new Exception("Insert Unsuccessfully.");
                }
                $message->addMessage('Insert Successfully.');

                $this->redirect($this->getLayout()->getUrl('grid','product_media',['id'=> $productId]));
            }
            else
            {
                $this->redirect($this->getLayout()->getUrl('grid','product_media',['id' =>  $productId],true));
            } 

        } 
        catch (Exception $e) 
        {
            $message->addMessage($e->getMessage(),Model_Core_Message::ERROR);
            $this->redirect($this->getLayout()->getUrl('grid',null,null,true));   
        }


    }

}


?>