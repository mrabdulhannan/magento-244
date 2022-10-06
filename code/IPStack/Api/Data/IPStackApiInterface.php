<?php

namespace Firewalls\IPStack\Api\Data;

interface IPStackApiInterface
{
    const TABLE_NAME = 'ip_stack_api';

    const ENTITY_ID = 'entity_id';
    const CUSTOMER_IP = 'customer_ip';
    const CUSTOMER_CITY = 'customer_city';
    const CUSTOMER_ZIP = 'customer_zip';
    const CUSTOMER_REGION_CODE = 'customer_region_code';
    const CUSTOMER_IS_ELIGIBLE = 'customer_is_eligible';
    const CUSTOMER_STATE = 'customer_state';
    const IS_STORE_CUSTOMER_ZIP = 'is_store_customer_zip';
    const CUSTOMER_COUNTRY_NAME = 'customer_country_name';


    public function getId();

    public function setId($id);

    public function getCustomerIp();

    public function setCustomerIp($ip);

    public function getCustomerCity();

    public function setCustomerCity($city);

    /**
     * @return mixed
     */
    public function getCustomerZip();

    /**
     * @param $zip
     * @return mixed
     */
    public function setCustomerZip($zip);

    /**
     * @return mixed
     */
    public function getCustomerRegionCode();

    /**
     * @param $regionCode
     * @return mixed
     */
    public function setCustomerRegionCode($regionCode);

    /**
     * @return string
     */
    public function getCustomerIsEligible();

    /**
     * @param $isEligibleFlag
     * @return mixed
     */
    public function setCustomerIsEligible($isEligibleFlag);

    /**
     * @return string
     */
    public function getCustomerState();

    /**
     * @param $state
     * @return mixed
     */
    public function setCustomerState($state);

    /**
     * @return string
     */
    public function getIsStoreCustomerZip();

    /**
     * @param $isStoreFlag
     * @return mixed
     */
    public function setIsStoreCustomerZip($isStoreFlag);

    /**
     * @return mixed
     */
    public function getCustomerCountryName();

    /**
     * @param $countryName
     * @return mixed
     */
    public function setCustomerCountryName($countryName);
}