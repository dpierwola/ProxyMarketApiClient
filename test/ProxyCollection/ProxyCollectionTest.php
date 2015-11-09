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
     * Test diffrent case in getNumberOfElements method
     */
    public function testGetNumberOfElements() {
        $proxyCollectionObject = new \ProxyMarketApi\ProxyCollection\ProxyCollection();
        $this->assertEquals(0, $proxyCollectionObject->getNumberOfElements());

        $proxyCollectionObject->push(new \ProxyMarketApi\Proxy\Proxy('127.0.0.1'));
        $this->assertEquals(1, $proxyCollectionObject->getNumberOfElements());

        $proxyCollectionObject->pop();
        $this->assertEquals(0, $proxyCollectionObject->getNumberOfElements());

        for($i = 0; $i < 10; $i++) {
            $proxyCollectionObject->push(new \ProxyMarketApi\Proxy\Proxy('192.168.1.23'));
        }
        $this->assertEquals(10, $proxyCollectionObject->getNumberOfElements());
    }

    /**
     * Push and Pop test methods
     */
    public function testPushAndPop() {
        $proxyCollectionObject = new \ProxyMarketApi\ProxyCollection\ProxyCollection();
        $this->assertFalse($proxyCollectionObject->pop());
        $this->assertEquals(0, $proxyCollectionObject->getNumberOfElements());

        $proxyCollectionObject->push(new ProxyMarketApi\Proxy\Proxy('127.0.0.1'));
        $this->assertEquals(1, $proxyCollectionObject->getNumberOfElements());

        $proxyObject = $proxyCollectionObject->pop();
        $this->assertEquals(0, $proxyCollectionObject->getNumberOfElements());
        $this->assertEquals('127.0.0.1', $proxyObject->getIp());

        $this->assertFalse($proxyCollectionObject->pop());
    }

    /**
     * GetCollection test method
     */
    public function testGetCollection() {
        $proxyCollectionObject = new \ProxyMarketApi\ProxyCollection\ProxyCollection();
        $this->assertEquals(array(), $proxyCollectionObject->getCollection());
        $this->assertEquals(0, count($proxyCollectionObject->getCollection()));

        $proxyCollectionObject->push(new \ProxyMarketApi\Proxy\Proxy('127.0.0.1'));
        $this->assertEquals(1, count($proxyCollectionObject->getCollection()));
    }

    /**
     * FindProxyObjectsByIp test method
     */
    public function testFindProxyObjectsByIp() {
        $proxyCollectionObject = new \ProxyMarketApi\ProxyCollection\ProxyCollection();
        $this->assertEquals(array(), $proxyCollectionObject->findProxyObjectsByIp('127.0.0.1'));
        $this->assertEquals(array(), $proxyCollectionObject->findProxyObjectsByIp(''));

        $proxyCollectionObject->push(new \ProxyMarketApi\Proxy\Proxy('127.0.0.1'));
        $this->assertEquals(1, count($proxyCollectionObject->findProxyObjectsByIp('127.0.0.1')));
        $this->assertEquals('127.0.0.1', $proxyCollectionObject->findProxyObjectsByIp('127.0.0.1')[0]->getIp());

        $proxyCollectionObject->push(new \ProxyMarketApi\Proxy\Proxy('127.0.0.1'));
        $this->assertEquals(2, count($proxyCollectionObject->findProxyObjectsByIp('127.0.0.1')));
        $this->assertEquals('127.0.0.1', $proxyCollectionObject->findProxyObjectsByIp('127.0.0.1')[1]->getIp());
    }

    /**
     * FindProxyObjectsByPort test method
     */
    public function testFindProxyObjectsByPort() {
        $proxyCollectionObject = new \ProxyMarketApi\ProxyCollection\ProxyCollection();
        $this->assertEquals(array(), $proxyCollectionObject->findProxyObjectsByPort(80));
        $this->assertEquals(array(), $proxyCollectionObject->findProxyObjectsByIp(''));
        $this->assertEquals(array(), $proxyCollectionObject->findProxyObjectsByIp('80'));

        $proxyCollectionObject->push(new \ProxyMarketApi\Proxy\Proxy('127.0.0.1'));
        $this->assertEquals(1, count($proxyCollectionObject->findProxyObjectsByPort('80')));
        $this->assertEquals(1, count($proxyCollectionObject->findProxyObjectsByPort(80)));
        $this->assertEquals(80, $proxyCollectionObject->findProxyObjectsByPort(80)[0]->getPort());
        $this->assertEquals('80', $proxyCollectionObject->findProxyObjectsByPort('80')[0]->getPort());

        $proxyCollectionObject->push(new \ProxyMarketApi\Proxy\Proxy('127.0.0.1', 80));
        $this->assertEquals(2, count($proxyCollectionObject->findProxyObjectsByPort('80')));
        $this->assertEquals(2, count($proxyCollectionObject->findProxyObjectsByPort(80)));
        $this->assertEquals(80, $proxyCollectionObject->findProxyObjectsByPort(80)[1]->getPort());

        $proxyCollectionObject->push(new \ProxyMarketApi\Proxy\Proxy('127.0.0.1', 8081));
        $this->assertEquals(1, count($proxyCollectionObject->findProxyObjectsByPort('8081')));
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
