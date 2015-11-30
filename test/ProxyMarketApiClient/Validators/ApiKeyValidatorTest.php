<?php
/**
 * Created by PhpStorm.
 * User: dpierwola
 * Date: 30.11.15
 * Time: 22:12
 */

class ApiKeyValidatorTest extends PHPUnit_Framework_TestCase {

    /**
     * @dataProvider getApiKeyValidDataProvider
     * @param $expected
     * @param $value
     */
    public function testValidSuccess($value) {
        $apiKeyValidator = new \ProxyMarketApiClient\ProxyMarketApiClient\Validators\ApiKeyValidator();
        $this->assertTrue($apiKeyValidator->valid($value));
    }

    /**
     * @dataProvider getApiKeyInvalidDataProvider
     * @expectedException \ProxyMarketApiClient\Exceptions\InvalidApiKey
     * @param $value
     */
    public function testValidFail($value) {
        $apiKeyValidator = new \ProxyMarketApiClient\ProxyMarketApiClient\Validators\ApiKeyValidator();
        $apiKeyValidator->valid($value);

    }

    /**
     * @return array
     */
    public static function getApiKeyValidDataProvider() {
        return array(
            array('xxxxxxxxxxxxxxxxxxxx'),
            array('xxxxxxxxxxxxxxxxx')
        );
    }

    /**
     * @return array
     */
    public static function getApiKeyInvalidDataProvider() {
        return array(
            array(''),
            array(array())
        );
    }
}
