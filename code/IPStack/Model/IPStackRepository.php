<?php

namespace Firewalls\IPStack\Model;

use Firewalls\IPStack\Api\IPStackRepositoryInterface;
use Firewalls\IPStack\Api\Data\IPStackApiInterface;
use Firewalls\IPStack\Api\Data\IPStackApiInterfaceFactory;
use Firewalls\IPStack\Model\ResourceModel\IPStackAPI as IPStackAPIResource;
use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Exception\NoSuchEntityException;

class IPStackRepository implements IPStackRepositoryInterface
{

    /**
     * @var IPStackAPIResource
     */
    protected $iPStackAPIResource;

    /**
     * @var IPStackApiInterfaceFactory
     */
    protected $iPStackApiInterfaceFactory;

    /**
     * @param IPStackAPIResource $iPStackAPIResource
     * @param IPStackApiInterfaceFactory $iPStackApiInterfaceFactory
     */
    public function __construct(
        IPStackAPIResource $iPStackAPIResource,
        IPStackApiInterfaceFactory $iPStackApiInterfaceFactory
    )
    {
        $this->iPStackAPIResource = $iPStackAPIResource;
        $this->iPStackApiInterfaceFactory = $iPStackApiInterfaceFactory;
    }

    /**
     * @param IPStackApiInterface $ApolloApiInterface
     * @return \Exception|IPStackAPIResource|AlreadyExistsException
     * @throws \Exception
     */
    public function save(IPStackApiInterface $ApolloApiInterface)
    {
        try {
            return $this->iPStackAPIResource->save($ApolloApiInterface);
        } catch (AlreadyExistsException $e) {
            return $e;
        }
    }

    /**
     * @param $id
     * @return mixed
     * @throws NoSuchEntityException
     */
    public function getById($id)
    {
        $api = $this->iPStackApiInterfaceFactory->create();
        $api->getResource()->load($api, 1);
        if (! $api->getId()) {
            throw new NoSuchEntityException(__('IP Not Found "%1"', $id));
        }
        return $api;
    }

    /**
     * @param $ip
     * @return array
     */
    public function getByIp($ip)
    {
        $connection = $this->iPStackAPIResource->getConnection();
        $select = $connection->select()->from(['mgwu_ip_stack_api'], ['*'])->where('customer_ip = :ip');
        $bind = [':ip' => (string)$ip];
        return $connection->fetchAll($select, $bind);
    }

    /**
     * @param IPStackApiInterface $iPStackApiInterface
     * @return IPStackAPIResource
     * @throws \Exception
     */
    public function delete(IPStackApiInterface $iPStackApiInterface)
    {
        return $this->iPStackAPIResource->delete($iPStackApiInterface);
    }

    /**
     * @param $id
     * @return bool
     * @throws NoSuchEntityException
     */
    public function deleteById($id)
    {
        $api = $this->getById($id);
        $this->delete($api);
        return true;
    }
}