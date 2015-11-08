<?php
/**
 * Created by PhpStorm.
 * User: dpierwola
 * Date: 07.11.15
 * Time: 15:39
 */

namespace ProxyMarketApi\ProxyCollection;

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
     * @param \ProxyMarketApi\Proxy\Proxy $proxyObject
     */
    public function push(\ProxyMarketApi\Proxy\Proxy $proxyObject) {
        $this->sizeOfCollection = array_push($this->proxyCollection, $proxyObject);
        return $this;
    }

    /**
     * Get last Proxy object from collection and decrement sizeOfCollection flag
     * @return bool | \ProxyMarketApi\Proxy\Proxy
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
     * @param string $ip
     * @return array
     */
    public function findProxyObjectsByIp($ip) {
        $foundProxyObjects = array();
        foreach($this->proxyCollection as $proxyObject) {
            if($proxyObject->getIp() == $ip) {
                array_push($foundProxyObjects, $proxyObject);
            }
        }
        return $foundProxyObjects;
    }

    /**
     * @param int $ipPort
     * @return array
     */
    public function findProxyObjectsByIpPort($ipPort) {
        $foundProxyObjects = array();
        foreach($this->proxyCollection as $proxyObject) {
            if($proxyObject->getPort() == $ipPort) {
                array_push($foundProxyObjects, $proxyObject);
            }
        }
        return $foundProxyObjects;
    }
}