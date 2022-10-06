<?php

namespace Firewalls\IPStack\Helper;

use Magento\Customer\Model\Session as CustomerSession;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\HTTP\Client\Curl;
use Magento\Framework\HTTP\PhpEnvironment\RemoteAddress;
use Magento\Framework\Message\ManagerInterface;
use Magento\Framework\Serialize\Serializer\Json as JsonSerializer;
use Firewalls\IPStack\Api\IPStackRepositoryInterface;
use Firewalls\IPStack\Api\Data\IPStackApiInterfaceFactory;
use Firewalls\IPStack\Logger\Logger;

/**
 * Class Data
 * @package Firewalls\ZipCheck\Helper
 */
class Data extends AbstractHelper
{

    /**
     * IP Stack API Url
     */
    const API_STACK_ENDPOINT = 'http://api.ipstack.com/';

    /**
     * IP Stack Access Key
     */
    const XML_PATH_IP_STACK_KEY = 'ip_stack_api_section/ip_stack_api_group/ip_stack_api_access_key';

    /**
     * @var Curl
     */
    private $curl;

    /**
     * @var RemoteAddress
     */
    private $remoteAddress;

    /**
     * @var CustomerSession
     */
    private $customerSession;

    /**
     * @var ManagerInterface
     */
    private $messageManager;

    /**
     * @var JsonSerializer
     */
    private $jsonSerializer;

    /**
     * @var IPStackRepositoryInterface
     */
    public $iPStackRepositoryInterface;

    /**
     * @var IPStackApiInterfaceFactory
     */
    public $ipStackAPIRepository;

    /**
     * @var Logger
     */
    protected $logger;

    /**
     * Data constructor.
     * @param Context $context
     * @param Curl $curl
     * @param RemoteAddress $remoteAddress
     * @param CustomerSession $customerSession
     * @param ManagerInterface $messageManager
     * @param JsonSerializer $jsonSerializer
     */
    public function __construct(
        Context                    $context,
        Curl                       $curl,
        RemoteAddress              $remoteAddress,
        CustomerSession            $customerSession,
        ManagerInterface           $messageManager,
        JsonSerializer             $jsonSerializer,
        IPStackRepositoryInterface $iPStackRepositoryInterface,
        IPStackApiInterfaceFactory $ipStackAPIRepository,
        Logger                     $logger
    )
    {
        parent::__construct($context);
        $this->curl = $curl;
        $this->remoteAddress = $remoteAddress;
        $this->customerSession = $customerSession;
        $this->messageManager = $messageManager;
        $this->jsonSerializer = $jsonSerializer;
        $this->iPStackRepositoryInterface = $iPStackRepositoryInterface;
        $this->ipStackAPIRepository = $ipStackAPIRepository;
        $this->logger = $logger;
    }

    /**
     * @return mixed
     */
    public function getIpStackAccessKey()
    {
        return $this->scopeConfig->getValue(self::XML_PATH_IP_STACK_KEY);
    }

    /**
     * @param $userIp
     * @return ManagerInterface|string
     */
    public function getGeoIpAddress($userIp)
    {
        try {
            $accessToken = $this->getIpStackAccessKey();
            $url = DATA::API_STACK_ENDPOINT . $userIp . '?access_key=' . $accessToken . "&format=1";
            $this->curl->get($url);
            $this->logger->info($this->curl->getBody());
            return $this->curl->getBody();
        } catch (\Exception $e) {
            return $this->messageManager->addErrorMessage(
                __("Api 1 Call Failed" . $e->getMessage())
            );
        }
    }

    /**
     * @return ManagerInterface|string
     */
    public function getCountryNameForQuoteRequest()
    {
        $remoteIp = $this->remoteAddress->getRemoteAddress();
        if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
            $remoteIp = $_SERVER["HTTP_CF_CONNECTING_IP"];
        }
        $persistedData = $this->iPStackRepositoryInterface->getByIp($remoteIp);
        foreach ($persistedData as $item) {
            $persistedIp = $item['customer_ip'];
            $persistedCountry = $item['customer_country_name'];
        }
        if (!isset($persistedIp) or $persistedIp != $remoteIp) {
            $ipInfo = $this->getGeoIpAddress($remoteIp);
            if ($ipInfo) {
                $responseArray = (array)json_decode($ipInfo);
                if (!isset($responseArray['success'])) {
                    $ipStackAPIRepository = $this->ipStackAPIRepository->create();
                    $ipStackAPIRepository->setCustomerIp($responseArray['ip']);
                    $ipStackAPIRepository->setCustomerCity($responseArray['city']);
                    $ipStackAPIRepository->setCustomerZip($responseArray['zip']);
                    $ipStackAPIRepository->setCustomerRegionCode($responseArray['region_code']);
                    $ipStackAPIRepository->setCustomerState($responseArray['region_name']);
                    $ipStackAPIRepository->setIsStoreCustomerZip(true);
                    $ipStackAPIRepository->setCustomerCountryName($responseArray['country_name']);
                    $this->iPStackRepositoryInterface->save($ipStackAPIRepository);
                }
            }
            $countryName = !empty($ipInfo) ? json_decode($ipInfo, true)["country_name"] : '';
        } else {
            $countryName = $persistedCountry;
        }

        return $countryName;
    }

}
