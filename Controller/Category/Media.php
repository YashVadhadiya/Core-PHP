<?php
Ccc::loadClass("Controller_Core_Action");
Ccc::loadClass("Model_Category_Media");
Ccc::loadClass("Model_Core_Request");

class Controller_Category_Media extends Controller_Core_Action
{
    public function gridAction()
    {
        Ccc::getBlock("Category_Media_grid")->toHtml();
    }

    public function saveAction()
    {
        $adapter = new Model_Core_Adapter();
        try {
            $request = $this->getRequest();
            $categoryId = $request->getRequest("categoryId");
            if (!$request->isPost()) {
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

                $query = "DELETE FROM `category_media` WHERE imageId IN($removeIdsImplode)";
                $result = $adapter->delete($query);
            }

            $query = "SELECT imageId, categoryId FROM `category_media` WHERE categoryId = $categoryId";
            $result = $adapter->fetchPairs($query);
            $ids = array_keys($result);
            $implodeIds = implode(",", $ids);

            $query = "UPDATE `category_media` SET status = 0, thumb = 0, base = 0, small = 0 , gallery = 0 WHERE imageId IN ($implodeIds)";

            $result = $adapter->update($query);

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
                $result = $adapter->update($query);

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

                $result = $adapter->update($query);

            }

            $base = $rows["media"]["base"];
            if (array_key_exists("base", $media)) 
            {
                $query = "UPDATE `category_media` SET `base`= 1 WHERE imageId = {$base}";
                $result = $adapter->update($query);

            }

            $thumb = $rows["media"]["thumb"];
            if (array_key_exists("thumb", $media)) 
            {
                $query = "UPDATE `category_media` SET `thumb`= 1 WHERE imageId = {$thumb}";
                $result = $adapter->update($query);

            }

            $small = $rows["media"]["small"];
            if (array_key_exists("small", $media)) 
            {
                $query = "UPDATE `category_media` SET `small`= 1 WHERE imageId = {$small}";
                $result = $adapter->update($query);
            }

            $this->redirect(
                $this->getUrl("grid", "category_media", ["categoryId" => $categoryId])
            );
        } catch (Exception $e) 
        {
            echo $e->getMessage();
        }
    }

    public function addAction()
    {
        $categoryId = $_GET['categoryId'];

        $imageName1 = $_FILES['image']['name'];
        $imageAddress1 = $_FILES['image']['tmp_name'];
        $imageName = implode("", $imageName1);
        $imageName = date('mjYhis') . '-' . $imageName;
        $imageAddress = implode("", $imageAddress1);

        if (move_uploaded_file($imageAddress,'C:\xampp-php\htdocs\Cybercom\Core-PHP\Media\Category/' .$imageName)) 
        {
            $adapter = new Model_Core_Adapter();
            $query = "INSERT INTO `category_media`( `categoryId`, `image`, `base`, `thumb`, `small`, `gallery`, `status`) VALUES ($categoryId,'$imageName',0,0,0,0,0)";

            $result = $adapter->insert($query);

            $this->redirect($this->getUrl("grid", "category_media", ["categoryId" => $categoryId]), true);

        } 
        else 
        {
            $this->redirect($this->getUrl('grid', 'category_media',['categoryId' =>  $categoryId], true));
        }
    }
}

?>
