<?php
Ccc::loadClass('Controller_Core_Action');
Ccc::loadClass('Model_Core_Request');
class Controller_Product_Media extends Controller_Core_Action{

   public function gridAction()
    { 
         Ccc::getBlock('Product_Media_Grid')->toHtml();      
    }

   public function saveAction()
   {
      $productId = $_GET['id'];
      
      if(!isset($_POST['remove']))
         {
            $query = "DELETE FROM `product_media` WHERE imageId = 1 ";
         }

      $imageName1 = $_FILES['image']['name'];
      $imageAddress1 = $_FILES['image']['tmp_name'];
      $imageName = implode("", $imageName1);
      $imageName = date("mjYhis")."-".$imageName;
      $imageAddress = implode("", $imageAddress1);

         $media = Ccc::getModel('Product_Media');
         //$media = $mediaModel->getRow();
         $row = $this->getRequest()->getRequest('product_media');
         
         if(move_uploaded_file($imageAddress , 'C:\xampp-php\htdocs\Cybercom\Core-PHP\Media/'. $imageName))
            {

               $query = "INSERT INTO `product_media`(`productId`,`image`, `base`, `thumb`, `small`, `gallery`, `status`) VALUES ($productId,'$imageName' ,0,0,0,0,0)";


               $adapter = new Model_Core_Adapter();

               $result = $adapter->insert($query);
               
               $this->redirect($this->getUrl('grid','product_media',['id' =>  $productId],true));
            }
            else
            {
               $this->redirect($this->getUrl('grid','product_media',['id' =>  $productId],true));
            }  


   }
}

?>




