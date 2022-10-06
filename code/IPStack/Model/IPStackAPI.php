<?php

namespace Firewalls\IPStack\Model;


use Firewalls\IPStack\Api\Data\IPStackApiInterface;
use Magento\Framework\Model\AbstractModel;

class IPStackAPI extends AbstractModel implements IPStackApiInterface
{
    /**
     * Initialize address model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(\Firewalls\IPStack\Model\ResourceModel\IPStackAPI::class);
    }

    /**
     * @return array|mixed|null
     */
    public function getCustomerIp()
    {
        return $this->getData(IPStackApiInterface::CUSTOMER_IP);
    }

    /**
     * @param $ip
     * @return IPStackAPI
     */
    public function setCustomerIp($ip)
    {
        return $this->setData(IPStackApiInterface::CUSTOMER_IP, $ip);
    }

    /**
     * @return array|mixed|null
     */
    public function getCustomerCity()
    {
        return $this->getData(IPStackApiInterface::CUSTOMER_CITY);
    }

    /**
     * @param $city
     * @return IPStackAPI
     */
    public function setCustomerCity($city)
    {
        return $this->setData(IPStackApiInterface::CUSTOMER_CITY, $city);
    }

    /**
     * @return array|mixed|null
     */
    public function getCustomerZip()
    {
        return $this->getData(IPStackApiInterface::CUSTOMER_ZIP);
    }

    /**
     * @param $zip
     * @return IPStackAPI
     */
    public function setCustomerZip($zip)
    {
        return $this->setData(IPStackApiInterface::CUSTOMER_ZIP, $zip);
    }

    /**
     * @return array|mixed|null
     */
    public function getCustomerRegionCode()
    {
        return $this->getData(IPStackApiInterface::CUSTOMER_REGION_CODE);
    }

    /**
     * @param string $regionCode
     * @return \Firewalls\IPStack\Api\Data\IPStackApiInterface|IPStackAPI
     */
    public function setCustomerRegionCode($regionCode)
    {
        return $this->setData(IPStackApiInterface::CUSTOMER_REGION_CODE, $regionCode);
    }

    /**
     * @return array|mixed|string|null
     */
    public function getCustomerIsEligible()
    {
        return $this->getData(IPStackApiInterface::CUSTOMER_IS_ELIGIBLE);
    }

    /**
     * @param bool $isEligibleFlag
     * @return \Firewalls\IPStack\Api\Data\IPStackApiInterface|IPStackAPI
     */
    public function setCustomerIsEligible($isEligibleFlag)
    {
        return $this->setData(IPStackApiInterface::CUSTOMER_IS_ELIGIBLE, $isEligibleFlag);
    }

    /**
     * @return array|mixed|string|null
     */
    public function getCustomerState()
    {
        return $this->getData(IPStackApiInterface::CUSTOMER_STATE);
    }

    /**
     * @param string $state
     * @return \Firewalls\IPStack\Api\Data\IPStackApiInterface|IPStackAPI
     */
    public function setCustomerState($state)
    {
        return $this->setData(IPStackApiInterface::CUSTOMER_STATE, $state);
    }

    /**
     * @return array|mixed|string|null
     */
    public function getIsStoreCustomerZip()
    {
        return $this->getData(IPStackApiInterface::IS_STORE_CUSTOMER_ZIP);
    }

    /**
     * @param bool $isStoreFlag
     * @return \Firewalls\IPStack\Api\Data\IPStackApiInterface|IPStackAPI
     */
    public function setIsStoreCustomerZip($isStoreFlag)
    {
        return $this->setData(IPStackApiInterface::IS_STORE_CUSTOMER_ZIP, $isStoreFlag);
    }

    /**
     * @return array|mixed|string|null
     */
    public function getCustomerCountryName()
    {
        return $this->getData(IPStackApiInterface::CUSTOMER_COUNTRY_NAME);
    }

    /**
     * @param $countryName
     * @return \Firewalls\IPStack\Api\Data\IPStackApiInterface|IPStackAPI
     */
    public function setCustomerCountryName($countryName)
    {
        return $this->setData(IPStackApiInterface::CUSTOMER_COUNTRY_NAME, $countryName);
    }
}