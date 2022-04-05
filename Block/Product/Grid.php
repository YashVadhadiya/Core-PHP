<?php 

Ccc::loadClass('Block_Core_Grid');
class Block_Product_Grid extends Block_Core_Grid
{
	public function __construct()
	{
		parent::__construct();
	}

	public function getEditUrl($product)
	{
		return $this->getUrl('edit',null,['id'=>$product->id]);
	}
	
	public function getDeleteUrl($product)
	{
		return $this->getUrl('delete',null,['id'=>$product->id]);
	}
	public function prepareActions()
	{
		parent::prepareActions();
		$this->setActions([
			['title'=>'Edit','method'=>'getEditUrl'],
			['title'=>'Delete','method'=>'getDeleteUrl']
			]);
		return $this;
	}

	public function prepareCollections()
	{
		parent::prepareCollections();
		return $this->setCollections($this->getProducts());
	}

	public function prepareColumns()
	{
		parent::prepareColumns();

		$this->addColumn('id', [
			'title' => 'Product Id',
			'type' => 'int',
		]);

		$this->addColumn('name',[
			'title' => 'Name',
			'type' => 'varchar',
		]);

		$this->addColumn('price',[
			'title' => 'Price',
			'type' => 'float',
		]);

		$this->addColumn('cost',[
			'title' => 'Cost',
			'type' => 'float',
		]);

		$this->addColumn('discount',[
			'title' => 'Discount',
			'type' => 'float',
		]);

		$this->addColumn('discountMode',[
			'title' => 'Discount Mode',
			'type' => 'int',
		]);

		$this->addColumn('quantity',[
			'title' => 'Quantity',
			'type' => 'int',
		]);

		$this->addColumn('sku',[
			'title' => 'SKU',
			'type' => 'varchar',
		]);

		$this->addColumn('tax',[
			'title' => 'Tax',
			'type' => 'decimal',
		]);

		$this->addColumn('status',[
			'title' => 'Status',
			'type' => 'int',
		]);

		$this->addColumn('baseImage',[
			'title' => 'Base Image',
			'type' => 'int',
		]);

		$this->addColumn('smallImage',[
			'title' => 'Small Image',
			'type' => 'int',
		]);

		$this->addColumn('thumbImage',[
			'title' => 'Thumb Image',
			'type' => 'int',
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

	public function getProducts()
	{
		$page = Ccc::getFront()->getRequest()->getRequest('p',1);
		$perPageCount = Ccc::getFront()->getRequest()->getRequest('ppr',10);
		$pager = Ccc::getModel('Core_Pager');
		$this->setPager($pager);
		$productModel = Ccc::getModel('Product');
		$totalCount = $productModel->getAdapter()->fetchOne("SELECT count('productId') FROM product");
		$this->getPager()->execute($totalCount,$page);
		
		$query = "SELECT p.*,b.image AS baseImage,t.image AS thumbImage,s.image AS smallImage FROM product p LEFT JOIN product_media b ON p.id = b.productId AND (b.base = 1) LEFT JOIN product_media t ON p.id = t.productId AND (t.thumb = 1) LEFT JOIN product_media s ON p.id = s.productId AND (s.small = 1) LIMIT {$this->getPager()->getStartLimit()},{$perPageCount};";

		$products = $productModel->fetchAll($query);
		return $products;
	}
}

