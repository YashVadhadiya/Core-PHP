<?php
Ccc::loadClass('Model_Core_Row');
class Model_Order_Comment extends Model_Core_Row
{	
	const STATUS_PENDING = 1;
	const STATUS_PACKAGING = 2;
    const STATUS_DISPATCHED = 3;
    const STATUS_OUT_OF_DELIVERY = 4;
    const STATUS_SHIPPED = 5;
	const STATUS_COMPLETED = 6;

	const STATUS_PENDING_LBL = 'PENDING';
	const STATUS_PACKAGING_LBL = 'PACKAGING'; 
    const STATUS_DISPATCHED_LBL = 'DISPATCHED'; 
    const STATUS_OUT_OF_DELIVERY_LBL = 'OUT FOR DELIVERY'; 
	const STATUS_SHIPPED_LBL = 'SHIPPED'; 
	const STATUS_COMPLETED_LBL = 'COMPLETED';
	public function __construct()
	{
		$this->setResourceClassName('Order_Comment_Resource');
		parent::__construct();
	}

	public function getStatus($key = null)
    {       
        
        $statues = [self::STATUS_PENDING => self::STATUS_PENDING_LBL,
                    self::STATUS_PACKAGING => self::STATUS_PACKAGING_LBL,
                    self::STATUS_SHIPPED => self::STATUS_SHIPPED_LBL,
                    self::STATUS_DISPATCHED => self::STATUS_DISPATCHED_LBL,
                    self::STATUS_OUT_OF_DELIVERY => self::STATUS_OUT_OF_DELIVERY_LBL,
                    self::STATUS_COMPLETED => self::STATUS_COMPLETED_LBL];

        if(!$key)
        {
            return $statues;
        }

        if(array_key_exists($key , $statues))
        {
            return $statues[$key];
        }

        return self::STATUS_DEFAULT;
    }
}