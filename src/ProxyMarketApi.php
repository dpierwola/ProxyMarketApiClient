<?php
/**
 * Created by PhpStorm.
 * User: macbookpro15
 * Date: 02.11.15
 * Time: 23:50
 */
namespace ProxyMarketApi;


use Curl\Curl;
use ProxyMarketApi\Exceptions\InvalidApiKey;
use ProxyMarketApi\Exceptions\InvalidApiRequest;
use ProxyMarketApi\Exceptions\InvalidApiResponse;

class ProxyMarketApi {
    const PROXY_MARKER_API_URL = 'http://www.proxymarket.pl/api/getanonim/';
    const INVALID_RESPONSE_PATTERN = "/^.*(zbyt czeste wywolanie API)+/i";


    protected $_apiKey  = null;
    protected $_curlObject = null;
    protected $proxyCollection = array();

    public function __construct($apiKey, Curl $curlObject) {
        if(empty($apiKey)) {
            throw new InvalidApiKey('Api key is invalid');
        }

        $this->_apiKey = $apiKey;
        $this->_curlObject = $curlObject;
    }

    /**
     * Functions preapre full path to proxyMarketApi
     * @return string
     */
    public function getApiUrl() {
        return self::PROXY_MARKER_API_URL . $this->_apiKey;
    }

    /**
     * Function get all proxies from proxyMarket
     */
    public function getProxies() {
        $this->_curlObject->get($this->getApiUrl());
        if($this->_curlObject->error) {
            throw new InvalidApiRequest($this->_curlObject->errorMessage, $this->_curlObject->errorCode);
        }
        if(!$this->isCorrectApiResponse()) {
            throw new InvalidApiResponse($this->_curlObject->response);
        }
        $this->proxyCollection = explode("\n", $this->_curlObject->response);

        return $this->proxyCollection;
    }

    /**
     * @return bool
     */
    private function isCorrectApiResponse() {
        return (bool)!preg_match(self::INVALID_RESPONSE_PATTERN, $this->_curlObject->response);
    }

    /**
     * Funtions get us acctive proxy
     */
    public function getProxy() {
        if(empty($this->proxyCollection)) {
            return false;
        }
        return array_pop($this->proxyCollection);
    }

    public function __destruct() {
        $this->_curlObject->close();
    }
}