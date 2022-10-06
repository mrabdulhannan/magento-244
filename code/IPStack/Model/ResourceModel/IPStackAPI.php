<?php

namespace Firewalls\IPStack\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Firewalls\IPStack\Api\Data\IPStackApiInterface;

class IPStackAPI extends AbstractDb
{
    protected function _construct()
    {
        $this->_init(IPStackApiInterface::TABLE_NAME, IPStackApiInterface::ENTITY_ID);
    }
}