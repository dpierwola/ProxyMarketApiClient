<?php
/**
 * Created by PhpStorm.
 * User: dpierwola
 * Date: 02.11.15
 * Time: 23:50
 */
namespace ProxyMarketApiClient;

use ProxyMarketApiClient\ProxyMarketApiClient\Validators\ApiKeyValidator;
use \ProxyMarketApiClient\ProxyMarketApiClient\Validators\ApiResponseValidator;
use ProxyMarketApiClient\ProxyCollection\ProxyCollection;
use Curl\Curl;
use ProxyMarketApiClient\Exceptions\InvalidApiKey;
use ProxyMarketApiClient\Exceptions\InvalidApiRequest;

class ProxyMarketApiClient {
    /**
     * @const PROXY_MARKER_API_URL
     */
    const PROXY_MARKER_API_URL = 'http://www.proxymarket.pl/api/getanonim/';

    /**
     * @var string
     */
    protected $_apiKey  = null;

    /**
     * @var Curl
     */
    protected $_curlObject = null;

    /**
     * @var ProxyCollection
     */
    protected $proxyCollection = null;

    /**
     * @param $apiKey
     * @param Curl $curlObject
     * @throws InvalidApiKey
     */
    public function __construct($apiKey, Curl $curlObject) {
        if((new ApiKeyValidator())->valid($apiKey)) {
            $this->_apiKey = $apiKey;
            $this->_curlObject = $curlObject;
            $this->proxyCollection = new ProxyCollection();
        }
    }

    /**
     * Function prepare full path to proxyMarketApi
     * @return string
     */
    private function _getApiUrl() {
        return self::PROXY_MARKER_API_URL . $this->_apiKey;
    }

    /**
     * @return ProxyCollection
     * @throws Exceptions\InvalidApiResponse
     * @throws InvalidApiRequest
     */
    public function getProxyCollection() {
        $this->_curlObject->get($this->_getApiUrl());
        if($this->_curlObject->error) {
            throw new InvalidApiRequest($this->_curlObject->errorMessage, $this->_curlObject->errorCode);
        }
        if((new ApiResponseValidator())->valid($this->_curlObject->response)) {
            $proxyRows = explode("\n", $this->_curlObject->response);
            foreach($proxyRows as $row) {
                $proxyPart = explode(':', $row);
                if(count($proxyPart) == 2) {
                    list($ip, $port) = $proxyPart;
                    $this->proxyCollection->push(new Proxy\Proxy($ip, (int)$port));
                }
            }

            return $this->proxyCollection;
        }
    }

    public function __destruct() {
        $this->_curlObject->close();
    }
}