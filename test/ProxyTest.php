<?php
/**
 * Created by PhpStorm.
 * User: macbookpro15
 * Date: 05.11.15
 * Time: 00:41
 */

namespace ProxyMarketApi\Tests;

use ProxyMarketApi\Proxy;

include '../vendor/autoload.php';

class ProxyTest extends \PHPUnit_Framework_TestCase  {
    /**
     * @dataProvider ipProvider
     * @param Proxy $proxyObject
     * @param $expectedIp
     */
    public function testGetIp(Proxy $proxyObject, $expectedIp) {
        $this->assertEquals($expectedIp, $proxyObject->getIp());
    }

    /**
     * @dataProvider portProvider
     * @param Proxy $proxyObject
     * @param $expectedPort
     */
    public function testGetPort(Proxy $proxyObject, $expectedPort) {
        $this->assertEquals($expectedPort, $proxyObject->getPort());
    }


    public static function ipProvider() {
        return array(
            array(new Proxy('127.0.0.1'), '127.0.0.1'),
            array(new Proxy('78.29.12.2'), '78.29.12.2')
        );
    }

    public static function portProvider() {
        return array(
            array(new Proxy('127.0.0.1'), '8080'),
            array(new Proxy('123.23.4.23', '8118'), '8118'),
            array(new Proxy('23.24.24.3', '8080'), '8080'),
            array(new Proxy('243.234.231.22', '80'), '80')
        );
    }

}