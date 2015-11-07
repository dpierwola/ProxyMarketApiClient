<?php
/**
 * Created by PhpStorm.
 * User: dpierwola
 * Date: 06.11.15
 * Time: 23:24
 */

namespace ProxyMarketApi\Tests\Proxy;

use ProxyMarketApi\Proxy\Proxy;
use ProxyMarketApi\Proxy\Validators\IpPortValidator;

include dirname(__FILE__) . '/../../vendor/autoload.php';

class ProxyTest extends \PHPUnit_Framework_TestCase {
    /**
     * @dataProvider getProxiesObjects
     * @param Proxy $proxyObject
     * @param $expectedIpValue
     * @param $expectedIpPortValue
     */
    public function testCreateProxyObjectPass(Proxy $proxyObject) {
        $this->assertNotNull($proxyObject->getIp());
        $this->assertNotNull($proxyObject->getPort());
    }

    /**
     * @dataProvider getInvalidIpDataProvider
     * @expectedException \ProxyMarketApi\Proxy\Exceptions\InvalidIpException
     * @param $invalidIp
     */
    public function testCreateProxyObjectWithInvalidIp($invalidIp) {
        new Proxy($invalidIp);
    }

    /**
     * @dataProvider getInvalidIpPortDataProvider
     * @expectedException \ProxyMarketApi\Proxy\Exceptions\InvalidIpPortException
     * @param $invalidIpPort
     */
    public function testCreateProxyObjectWithInvalidIpPort($invalidIpPort) {
        new Proxy('127.0.0.1', $invalidIpPort);
    }

    /**
     * @dataProvider getProxiesObjects
     * @param Proxy $proxyObject
     * @param $expectedIpValue
     * @param $expectedIpPortValue
     */
    public function testGetIp(Proxy $proxyObject, $expectedIpValue) {
        $this->assertEquals($expectedIpValue, $proxyObject->getIp());
    }

    /**
     * @dataProvider getProxiesObjects
     * @param Proxy $proxyObject
     * @param $expectedIpValue
     * @param $expectedIpPortValue
     */
    public function testGetPort(Proxy $proxyObject, $expectedIpValue, $expectedIpPortValue) {
        $this->assertEquals($expectedIpPortValue, $proxyObject->getPort());
    }

    /**
     * @return array(Proxy, expectedIp, expectedIpPort)
     */
    public static function getProxiesObjects() {
        return array(
            array(new Proxy('192.168.1.1'), '192.168.1.1', 80 ),
            array(new Proxy('127.0.0.1', 34), '127.0.0.1', 34),
            array(new Proxy('67.145.1.31', 8080), '67.145.1.31', 8080)
        );
    }

    /**
     * @return array
     */
    public static function getInvalidIpDataProvider() {
        return array(
            array('-1.-1.-1.-1'),
            array('...'),
            array('256.256.256'),
        );
    }

    /**
     * @return array
     */
    public static  function getInvalidIpPortDataProvider() {
        return array(
            array('-1'),
            array(99999999),
            array(IpPortValidator::MIN_RANGE_IP_PORT - 1),
            array(IpPortValidator::MAX_RANGE_IP_PORT + 1)
        );
    }

}
