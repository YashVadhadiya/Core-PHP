<?php 

Ccc::loadClass('Block_Core_Grid');
class Block_Category_Grid extends Block_Core_Grid
{
	public function __construct()
	{
		parent::__construct();
	}

	public function getEditUrl($category)
	{
		return $this->getUrl('edit',null,['id'=>$category->categoryId]);
	}
	
	public function getDeleteUrl($category)
	{
		return $this->getUrl('delete',null,['id'=>$category->categoryId]);
	}
	public function prepareActions()
	{
		$this->setActions([
			['title'=>'Edit','method'=>'getEditUrl'],
			['title'=>'Delete','method'=>'getDeleteUrl']
		]);
		return $this;
	}

	public function prepareCollections()
	{
		$this->setCollections($this->getCategories());
	}

	public function prepareColumns()
	{
		parent::prepareColumns();

		$this->addColumn('categoryId', [
			'title' => 'Category Id',
			'type' => 'int',
		]);

		$this->addColumn('categoryName',[
			'title' => 'Name',
			'type' => 'varchar',
		]);

		$this->addColumn('status',[
			'title' => 'Status',
			'type' => 'int',
		]);

		$this->addColumn('baseImage',[
			'title' => 'Base Image',
			'type' => 'tinyInt',
		]);

		$this->addColumn('thumbImage',[
			'title' => 'Thumb Image',
			'type' => 'tinyInt',
		]);

		$this->addColumn('smallImage',[
			'title' => 'Small Image',
			'type' => 'tinyInt',
		]);

		$this->addColumn('createdAt',[
			'title' => 'Created At',
			'type' => 'datetime',
		]);

		$this->addColumn('updatedAt',[
			'title' => 'Updated At',
			'type' => 'datetime',
		]);

		return $this;
	}

	public function getCategories()
	{
		$page = Ccc::getFront()->getRequest()->getRequest('p',1);
		$perPageCount = Ccc::getFront()->getRequest()->getRequest('ppr',10);
		$pager = Ccc::getModel('Core_Pager');
		$this->setPager($pager);
		$categoryModel = Ccc::getModel('Category');
		$totalCount = $categoryModel->getAdapter()->fetchOne("SELECT count('category') FROM category");
		$this->getPager()->execute($totalCount,$page);
		$categories = $categoryModel->fetchAll("SELECT c.*,b.image AS baseImage,t.image AS thumbImage,s.image AS smallImage FROM category c LEFT JOIN category_media b ON c.categoryId = b.categoryId AND (b.base = 1) LEFT JOIN category_media t ON c.categoryId = t.categoryId AND (t.thumb = 1) LEFT JOIN category_media s ON c.categoryId = s.categoryId AND (s.small = 1) ORDER BY path LIMIT {$this->getPager()->getStartLimit()},{$perPageCount}");
		return $categories;
	}
	public function getCategoryWithPath()
	{
		Ccc::loadClass('Controller_Category');
		$categoryModel = new Controller_Category();
		$categoryPath = $categoryModel->getCategoryWithPath();
		return $categoryPath;
	}

}

