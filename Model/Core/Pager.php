<?php

class Model_Core_Pager 
{
	protected $totalCount = 0;
	protected $perPageCountOptions = [1,2,3,4,5,6,7,8,9,10,20,50,100,200];
	protected $pageCount = 0;
	protected $perPageCount = 10;
	protected $startLimit  = 0;
	protected $start = 0;
	protected $prev = 0;
	protected $current = 0;
	protected $next = 0;
	protected $end = 0;
	protected $endLimit= 0;

	public function execute($totalCount , $current)
	{
		$ppr = Ccc::getFront()->getRequest()->getRequest('ppr');
		
		if(!in_array($ppr,$this->getPerPageCountOptions()))
		{
			$this->setPerPageCount(200);
			$action = new Controller_Core_Action();
			$action->redirect(($action->getUrl('grid',null,['p' => 1 ,'ppr' => 10],false)));
		}
		else
		{
			$this->setPerPageCount($ppr);
		}
		$this->setTotalCount($totalCount);
		$this->setPageCount(ceil($this->getTotalCount()/$this->getPerPageCount()));
		$this->setStart('1');

		if($current > $this->getPageCount())
		{
			$this->setCurrent($this->getPageCount());
		}
		elseif($current < $this->getStart())
		{
			$this->setCurrent($this->getStart());
		}
		else
		{
			$this->setCurrent($current);
		}
		
		$this->setEnd($this->getPageCount());
		$this->setStartLimit($this->getPerPageCount() * ($this->getCurrent() - 1) );
		$this->setEndLimit($this->getPerPageCount() * $this->getCurrent() );
		$this->setPrev(($this->getCurrent() == $this->getStart()) ? null : $this->getCurrent() - 1);
		$this->setNext(($this->getCurrent() == $this->getEnd()) ? null : $this->getCurrent() + 1);

		
	}

	
	public function getPerPageCountOptions()
	{
		return $this->perPageCountOptions;
	}
	
	public function getTotalCount()
	{
		return $this->totalCount;
	}

	public function setTotalCount($totalCount)
	{
		$this->totalCount = $totalCount;
		return $this->totalCount;
	}

	public function getPageCount()
	{
		return $this->pageCount;
	}

	public function setPageCount($pageCount)
	{
		$this->pageCount = $pageCount;
		return $this->pageCount;
	}

	public function getPerPageCount()
	{
		return $this->perPageCount;
	}

	public function setPerPageCount($perPageCount)
	{
		$this->perPageCount = $perPageCount;
		return $this->perPageCount;
	}

	public function getStart()
	{
		return $this->start;
	}

	public function setstart($start)
	{
		$this->start = $start;
		return $this->start;
	}

	public function getEnd()
	{
		return $this->end;
	}

	public function setEnd($end)
	{
		$this->end = $end;
		return $this->end;
	}

	public function getPrev()
	{
		return $this->prev;
	}

	public function setPrev($prev)
	{
		$this->prev = $prev;
		return $this->prev;
	}

	public function getNext()
	{
		return $this->next;
	}

	public function setNext($next)
	{
		$this->next = $next;
		return $this->next;
	}

	public function getStartLimit()
	{
		return $this->startLimit;
	}

	public function setStartLimit($startLimit)
	{
		$this->startLimit = $startLimit;
		return $this->startLimit;
	}

	public function getEndLimit()
	{
		return $this->endLimit;
	}

	public function setEndLimit($endLimit)
	{
		$this->endLimit = $endLimit;
		return $this->endLimit;
	}

	public function getCurrent()
	{
		return $this->current;
	}

	public function setCurrent($current)
	{
		$this->current = $current;
		return $this->current;
	}

}