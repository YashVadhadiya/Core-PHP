<?php 

Ccc::loadClass('Controller_Core_Action');
Ccc::loadClass('Model_Core_Request');

class Controller_Category_Media extends Controller_Core_Action
{
	public function gridAction()
	{
		Ccc::loadClass('Category_Media_Grid')->toHtml();
	}

	public function saveAction()
	{
		$categoryId = $_GET['categoryId'];
		
		$imageName = $_FILES['image']['name'];
		$imageAddress1 = $_FILES['image']['tmp_name'];
		$imageName = implode("", $imageName1);
		$imageName = date("mjYHis")."/".$imageName;
		$imageAddress = implode("", $imageAddress1);

		$media = Ccc::getModel('Category_Media');
		$row = $this->getRequest()->getRequest('category_media');

		if(move_uploaded_file($imageAddress, 'C:\xampp-php\htdocs\Cybercom\Core-PHP\Media\Category/'. $imageName))
		{
			$query = "INSERT INTO category_media(categoryId, image, base, thumb, small, gallery, status) VALUES ($categoryId, '$imageName', 0,0,0,0,0)";

			$adapter = new Model_Core_Adapter();
			$result = $adapter->insert($query);
			$this->redirect($this->getUrl('grid', 'category_media', ['categoryId' => $categoryId], true));
		}
		else
		{
			$this->redirect($this->getUrl('grid', 'category_media', ['categoryId' => $categoryId], true));	
		}
	}
}

?>