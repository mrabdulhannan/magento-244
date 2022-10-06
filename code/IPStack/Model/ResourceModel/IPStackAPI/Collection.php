<?php

namespace Firewalls\IPStack\Model\ResourceModel\IPStackAPI;

use Firewalls\IPStack\Model\IPStackAPI;
use Firewalls\IPStack\Model\ResourceModel\IPStackAPI as IPStackAPIResource;
use Firewalls\IPStack\Api\Data\IPStackApiInterface;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = IPStackApiInterface::ENTITY_ID;

    protected function _construct()
    {
        $this->_init(IPStackAPI::class, IPStackAPIResource::class);
    }
}