<?php
/**
 * Created by PhpStorm.
 * User: dpierwola
 * Date: 06.11.15
 * Time: 15:18
 */
namespace ProxyMarketApi\Tests;

include dirname(__FILE__) . '/../../../vendor/autoload.php';
use \ProxyMarketApi\Proxy\Exceptions\InvalidIpPortException;
use \ProxyMarketApi\Proxy\Validators\IpPortValidator;

class IpPortValidatorTest extends \PHPUnit_Framework_TestCase {
    /**
     * @dataProvider ipPortDataProvider
     */
    public function testValidPass($value) {
        $this->assertTrue(true, (new IpPortValidator())->valid($value));
    }

    /**
     * @dataProvider invalidIpPortDataProvider
     * @expectedException \ProxyMarketApi\Proxy\Exceptions\InvalidIpPortException
     * @param $value
     * @throws InvalidIpPortException
     */
    public function testValidTrowException($value) {
        (new IpPortValidator())->valid($value);
    }

    /**
     * @return array
     */
    public static function ipPortDataProvider() {
        return array(
            array(IpPortValidator::MIN_RANGE_IP_PORT),
            array(2),
            array(32),
            array(80),
            array(8080),
            array(IpPortValidator::MAX_RANGE_IP_PORT)
        );
    }

    /**
     * @return array
     */
    public static function invalidIpPortDataProvider() {
        return array(
            array(IpPortValidator::MIN_RANGE_IP_PORT - 1),
            array(IpPortValidator::MAX_RANGE_IP_PORT + 1),
            array('-1'),
            array('22'),
            array((string)IpPortValidator::MAX_RANGE_IP_PORT),
            array('ProxyMarketApi')
        );
    }
}