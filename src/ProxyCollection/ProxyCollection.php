<?php
/**
 * Created by PhpStorm.
 * User: dpierwola
 * Date: 07.11.15
 * Time: 15:39
 */

namespace ClientProxyMarketApi\ProxyCollection;

class ProxyCollection {
    /**
     * @var array
     */
    protected $proxyCollection = array();

    /**
     * @var int
     */
    protected $sizeOfCollection = 0;

    /**
     * Check is empty Proxy collection
     * @return bool
     */
    public function isEmpty() {
        return $this->sizeOfCollection > 0 ? false : true;
    }

    /**
     * @return int
     */
    public function getNumberOfElements() {
        return $this->sizeOfCollection;
    }

    /**
     * Append Proxy object to collection and increment sizeOfCollection flag
     * @param \ClientProxyMarketApi\Proxy\Proxy $proxyObject
     */
    public function push(\ClientProxyMarketApi\Proxy\Proxy $proxyObject) {
        $this->sizeOfCollection = array_push($this->proxyCollection, $proxyObject);
        return $this;
    }

    /**
     * Get last Proxy object from collection and decrement sizeOfCollection flag
     * @return bool | \ClientProxyMarketApi\Proxy\Proxy
     */
    public function pop() {
        if(!$this->isEmpty()) {
            $this->sizeOfCollection--;
            return array_pop($this->proxyCollection);
        }
        return false;
    }

    /**
     * Function provide collection of Proxy objects
     * @return array
     */
    public function getCollection() {
        return $this->proxyCollection;
    }

    /**
     * @param $ip
     * @return array
     */
    public function findProxyObjectsByIp($ip) {
        return array_filter($this->proxyCollection, function($proxyObject) use ($ip) {
            if($proxyObject->getIp() == $ip) {
                return $proxyObject;
            }
        });
    }

    /**
     * @param $port
     * @return array
     */
    public function findProxyObjectsByPort($port) {
        return array_filter($this->proxyCollection, function($proxyObject) use ($port) {
            if($proxyObject->getPort() == $port) {
                return $proxyObject;
            }
        });
    }

}