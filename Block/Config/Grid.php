<?php 
Ccc::loadClass('Block_Core_Grid');
class Block_Config_Grid extends Block_Core_Grid
{
	public function __construct()
	{
		parent::__construct();
	}

	public function getEditUrl($config)
	{
		return $this->getUrl('edit',null,['configId'=>$config->configId]);
	}
	
	public function getDeleteUrl($config)
	{
		return $this->getUrl('delete',null,['configId'=>$config->configId]);
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
		return $this->setCollections($this->getConfigs());
	}

	public function prepareColumns()
	{
		parent::prepareColumns();

		$this->addColumn('configId', [
			'title' => 'Config Id',
			'type' => 'int',
		]);

		$this->addColumn('name',[
			'title' => 'Name',
			'type' => 'varchar',
		]);

		$this->addColumn('code',[
			'title' => 'Code',
			'type' => 'varchar',
		]);

		$this->addColumn('value',[
			'title' => 'Value',
			'type' => 'varchar',
		]);

		$this->addColumn('status',[
			'title' => 'Status',
			'type' => 'int',
		]);

		$this->addColumn('createdAt',[
			'title' => 'Created At',
			'type' => 'datetime',
		]);

		return $this;
	}

	public function getConfigs()
	{
		$page = Ccc::getFront()->getRequest()->getRequest('p',1);
		$perPageCount = Ccc::getFront()->getRequest()->getRequest('ppr',10);
		$pager = Ccc::getModel('Core_Pager');
		$this->setPager($pager);
		$configModel = Ccc::getModel('Config');
		$totalCount = $configModel->getAdapter()->fetchOne("SELECT count('configId') FROM config");
		$this->getPager()->execute($totalCount,$page);
		$configs = $configModel->fetchAll("SELECT * FROM config LIMIT {$this->getPager()->getStartLimit()},{$perPageCount}");
		return $configs;
	}
}

