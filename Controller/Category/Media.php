<?php
Ccc::loadClass("Controller_Core_Action");
Ccc::loadClass("Model_Category_Media");
Ccc::loadClass("Model_Core_Request");

class Controller_Category_Media extends Controller_Core_Action
{
    public function gridAction()
    {
        $content = $this->getLayout()->getContent();
        $categoryMediaGrid = Ccc::getBlock("Category_Media_Grid");
        $content->addChild($categoryMediaGrid);
        $this->renderLayout();
    }

    public function addAction()
    {
        $categoryId = $_GET['categoryId'];
        $imageName1 = $_FILES['image']['name'];
        $imageAddress1 = $_FILES['image']['tmp_name'];
        $imageName = implode("", $imageName1);
        $imageName = date('mjYhis') . '-' . $imageName;
        $imageAddress = implode("", $imageAddress1);
        $message = Ccc::getModel('Core_Message');

        if (move_uploaded_file($imageAddress, $this->getBaseUrl('Media/Category/') .$imageName)) 
        {
            $query = "INSERT INTO `category_media`( `categoryId`, `image`, `base`, `thumb`, `small`, `gallery`, `status`) VALUES ($categoryId,'$imageName',0,0,0,0,0)";
            $result = $this->getAdapter()->insert($query);
            if (!$result) 
                {
                    $message->addMessage('You can not insert image in media.', Model_Core_Message::ERROR);
                    $this->redirect($this->getUrl("grid", "category_media", ["id" => $categoryId]));
                } 
            else 
                {
                    $message->addMessage('Image is inserted in media.', Model_Core_Message::SUCCESS);
                    $this->redirect($this->getUrl("grid", "category_media", ["id" => $categoryId]));
                }

            $this->redirect($this->getUrl("grid", "category_media", ["categoryId" => $categoryId]), true);

        } 
        else 
        {
            $this->redirect($this->getUrl('grid', 'category_media',['categoryId' =>  $categoryId], true));
        }
    }
    
    public function saveAction()
    {
        $message = Ccc::getModel('Core_Message');
        try {
            $request = $this->getRequest();
            $categoryId = $request->getRequest("categoryId");
            if (!$request->isPost()) 
            {   $message->addMessage('Invalid Request Id.', Model_Core_Message::ERROR);
                $this->redirect($this->getUrl('grid', 'category_media', null, true));
                //throw new Exception("Invalid Request", 1);
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

                $query = "SELECT imageId , image FROM `category_media` WHERE imageId IN($removeIdsImplode) ";
                $result = $this->getAdapter()->fetchPairs($query);

                $deleteQuery = "DELETE FROM `category_media` WHERE imageId IN($removeIdsImplode)";
                $deleteResult = $this->getAdapter()->delete($deleteQuery);
                if (!$deleteResult) 
                {
                    $message->addMessage('Image is not deleted.', Model_Core_Message::ERROR);
                    $this->redirect($this->getUrl("grid", "category_media", ["id" => $categoryId]));
                } 
                else 
                {
                    $message->addMessage('Image is deleted.', Model_Core_Message::SUCCESS);
                    $this->redirect($this->getUrl("grid", "category_media", ["id" => $categoryId]));
                }
                
                foreach($result as $key => $value)
                {
                    if($deleteResult)
                    {
                        unlink($this->getBaseUrl('Media/Category/') . $value);
                    }
                }
            }
            $query = "SELECT imageId, categoryId FROM `category_media` WHERE categoryId = $categoryId";
            $result = $this->getAdapter()->fetchPairs($query);  
            $ids = array_keys($result);
            $implodeIds = implode(",", $ids);

            $query = "UPDATE `category_media` SET status = 0, thumb = 0, base = 0, small = 0 , gallery = 0 WHERE imageId IN ($implodeIds)";

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
                $query = "UPDATE `category_media` SET `status`= 1 WHERE imageId IN($statusIdsImplode)";
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
                $query = "UPDATE `category_media` SET `gallery`= 1 WHERE imageId IN($galleryIdsImplode)";

                $result = $this->getAdapter()->update($query);

            }

            $base = $rows["media"]["base"];
            if (array_key_exists("base", $media)) 
            {
                $query = "UPDATE `category_media` SET `base`= 1 WHERE imageId = {$base}";
                $result = $this->getAdapter()->update($query);
                if (!$result) 
                {
                    $message->addMessage('You can not insert base image in media.', Model_Core_Message::ERROR);
                    $this->redirect($this->getUrl("grid", "category_media", ["id" => $categoryId]));
                } 
                else 
                {
                    $message->addMessage('Image is selected.', Model_Core_Message::SUCCESS);
                    //$this->redirect($this->getUrl("grid", "category_media", ["id" => $categoryId]));
                }
            }

            $thumb = $rows["media"]["thumb"];
            if (array_key_exists("thumb", $media)) 
            {
                $query = "UPDATE `category_media` SET `thumb`= 1 WHERE imageId = {$thumb}";
                $result = $this->getAdapter()->update($query);
                if (!$result) 
                {
                    $message->addMessage('You can not insert base image in media.', Model_Core_Message::ERROR);
                    $this->redirect($this->getUrl("grid", "category_media", ["id" => $categoryId]));
                } 
                else 
                {
                    $message->addMessage('Image is selected.', Model_Core_Message::SUCCESS);
                    //$this->redirect($this->getUrl("grid", "category_media", ["id" => $categoryId]));
                }
            }

            $small = $rows["media"]["small"];
            if (array_key_exists("small", $media)) 
            {
                $query = "UPDATE `category_media` SET `small`= 1 WHERE imageId = {$small}";
                $result = $this->getAdapter()->update($query);
                if (!$result) 
                {
                    $message->addMessage('You can not insert base image in media.', Model_Core_Message::ERROR);
                    $this->redirect($this->getUrl("grid", "category_media", ["id" => $categoryId]));
                } 
                else 
                {
                    $message->addMessage('Image is selected.', Model_Core_Message::SUCCESS);
                    //$this->redirect($this->getUrl("grid", "category_media", ["id" => $categoryId]));
                }
            }

            $this->redirect(
                $this->getUrl("grid", "category_media", ["categoryId" => $categoryId])
            );
    }
    catch (Exception $e) 
        {
            echo $e->getMessage();
        }
    }

}

?>
