<?php
/**
 * Created by PhpStorm.
 * User: dpierwola
 * Date: 08.11.15
 * Time: 15:23
 */

class ProxyCollectionTest extends PHPUnit_Framework_TestCase {

    /**
     * Test create empty object and check properties
     */
    public function testCreateProxyCollectionObject() {
        $proxyCollectionObject = new \ProxyMarketApi\ProxyCollection\ProxyCollection();
        $this->isEmpty($proxyCollectionObject->getCollection());
        $this->assertFalse($proxyCollectionObject->pop());
    }

    /**
     * @dataProvider getProxyCollectionObjects
     * @param \ProxyMarketApi\ProxyCollection\ProxyCollection $proxyCollection
     * @param $expectedValue
     */
    public function testIsEmpty(\ProxyMarketApi\ProxyCollection\ProxyCollection $proxyCollection, $expectedValue) {
        $this->assertEquals($expectedValue, $proxyCollection->isEmpty());
    }


    /**
     * @return array
     */
    public static function getProxyCollectionObjects() {
        $proxyCollection = new \ProxyMarketApi\ProxyCollection\ProxyCollection();
        $proxyCollection->push(new ProxyMarketApi\Proxy\Proxy('192.168.1.1'));
        $cloneProxyCollection = clone $proxyCollection;
        $proxyCollection->pop();
        return array(
            array((new \ProxyMarketApi\ProxyCollection\ProxyCollection()), true),
            array(
                (new \ProxyMarketApi\ProxyCollection\ProxyCollection())
                    ->push(new \ProxyMarketApi\Proxy\Proxy('127.0.0.1')), false),
            array($cloneProxyCollection, false),
            array($proxyCollection, true)
        );
    }

}
