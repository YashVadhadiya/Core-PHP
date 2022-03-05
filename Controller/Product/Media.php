<?php
Ccc::loadClass("Controller_Core_Action");
Ccc::loadClass("Model_Product_Media");
Ccc::loadClass("Model_Core_Request");

class Controller_Product_Media extends Controller_Core_Action
{
    public function gridAction()
    {
        $content = $this->getLayout()->getContent();
        $productMediaGrid = Ccc::getBlock("Product_Media_Grid");
        $content->addChild($productMediaGrid);
        $this->renderLayout();
    }

    public function addAction()
    {
    $productId = $_GET['id'];
    $imageName1 = $_FILES['image']['name'];
    $imageAddress1 = $_FILES['image']['tmp_name'];
    $imageName = implode("", $imageName1);
    $imageName = date("mjYhis")."-".$imageName;
    $imageAddress = implode("", $imageAddress1);
    $message = Ccc::getModel('Core_Message');
    
        if (move_uploaded_file($imageAddress, $this->getBaseUrl('Media/Product/') .$imageName)) 
        {
            $query = "INSERT INTO `product_media`( `productId`, `image`, `base`, `thumb`, `small`, `gallery`, `status`) VALUES ($productId,'$imageName',0,0,0,0,0)";
            $result = $this->getAdapter()->insert($query);
            if (!$result) 
                {
                    throw new Exception("You can not insert image in media.", 1);
                } 
            else 
                {
                    $message->addMessage('Image is inserted in media.', Model_Core_Message::SUCCESS);
                    $this->redirect($this->getUrl("grid", "product_media", ["id" => $productId]));
                }
        } 
    }

    public function saveAction()
    {
        $message = Ccc::getModel('Core_Message');
        $media = Ccc::getModel('Product_Media');
        try {
            $request = $this->getRequest();
            $productId = $request->getRequest("id");
            if (!$request->isPost()) 
            {
                throw new Exception("Invalid Request", 1);
            }

            $rows = $request->getPost();

            $media = $rows["media"];
            $removeArr = $rows["media"]["remove"];

            if (array_key_exists("remove", $media)) 
            {
                $removeIds = [];
                
                foreach ($removeArr as $key => $value) 
                {
                    array_push($removeIds, $value);
                }

                $removeIdsImplode = implode(",", $removeIds);

                $query = "SELECT imageId , image FROM `product_media` WHERE imageId IN($removeIdsImplode) ";
                $result = $this->getAdapter()->fetchPairs($query);

                $deleteQuery = "DELETE FROM `product_media` WHERE imageId IN($removeIdsImplode)";
                $deleteResult = $this->getAdapter()->delete($deleteQuery);
                if (!$deleteResult) 
                {
                    throw new Exception("Image is not deleted.", 1);
                } 
                else 
                {
                    $message->addMessage('Image is deleted.', Model_Core_Message::SUCCESS);
                }

                foreach($result as $key => $value)
                {
                    if($deleteResult)
                    {
                        unlink($this->getBaseUrl('Media/product/') . $value);
                    }
                }
            }

            $query = "SELECT imageId, productId FROM `product_media` WHERE productId = $productId";
            $result = $this->getAdapter()->fetchPairs($query);
            $ids = array_keys($result);
            $implodeIds = implode(",", $ids);

            $query = "UPDATE `product_media` SET status = 0, thumb = 0, base = 0, small = 0 , gallery = 0 WHERE imageId IN ($implodeIds)";

            $result = $this->getAdapter()->update($query);

            $status = $rows["media"]["status"];
            if (array_key_exists("status", $media)) 
            {
                $statusIds = [];
                foreach ($status as $key => $value) 
                {
                    array_push($statusIds, $value);
                }
                $statusIdsImplode = implode(",", $statusIds);
                $query = "UPDATE `product_media` SET `status`= 1 WHERE imageId IN($statusIdsImplode)";
                $result = $this->getAdapter()->update($query);

            }

            $gallery = $rows["media"]["gallery"];
            if (array_key_exists("gallery", $media)) 
            {
                $galleryIds = [];
                foreach ($gallery as $key => $value) 
                {
                    array_push($galleryIds, $value);
                }
                print_r($galleryIds);
                $galleryIdsImplode = implode(",", $galleryIds);
                $query = "UPDATE `product_media` SET `gallery`= 1 WHERE imageId IN($galleryIdsImplode)";

                $result = $this->getAdapter()->update($query);

            }

            $base = $rows["media"]["base"];
            if (array_key_exists("base", $media)) 
            {
                $query = "UPDATE `product_media` SET `base`= 1 WHERE imageId = {$base}";
                $result = $this->getAdapter()->update($query);
                if (!$result) 
                {
                    throw new Exception("You can not insert base image in media.", 1);
                } 
                else 
                {
                    $message->addMessage('Image is selected.', Model_Core_Message::SUCCESS);
                }

            }

            $thumb = $rows["media"]["thumb"];
            if (array_key_exists("thumb", $media)) 
            {
                $query = "UPDATE `product_media` SET `thumb`= 1 WHERE imageId = {$thumb}";
                $result = $this->getAdapter()->update($query);
                if (!$result) 
                {
                    throw new Exception("You can not insert thumb image in media.", 1);
                } 
                else 
                {
                    $message->addMessage('Image is selected.', Model_Core_Message::SUCCESS);
                }

            }

            $small = $rows["media"]["small"];
            if (array_key_exists("small", $media)) 
            {
                $query = "UPDATE `product_media` SET `small`= 1 WHERE imageId = {$small}";
                $result = $this->getAdapter()->update($query);
                if (!$result) 
                {
                    throw new Exception("You can not insert base image in media.", 1);
                } 
                else 
                {
                    $message->addMessage('Image is selected.', Model_Core_Message::SUCCESS);
                }
            }

            $this->redirect(
                $this->getUrl("grid", "product_media", ["id" => $productId])
            );
    }catch (Exception $e) 
        {
            $message->addMessage($e->getMessage(), Model_Core_Message::ERROR);
            $this->redirect($this->getUrl("grid", "product_media", ["id" => $categoryId]));        }
    }
}

?>
