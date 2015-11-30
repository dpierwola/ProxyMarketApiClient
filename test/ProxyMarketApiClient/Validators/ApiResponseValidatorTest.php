<?php
/**
 * Created by PhpStorm.
 * User: dpierwola
 * Date: 30.11.15
 * Time: 23:20
 */

class ApiResponseValidatorTest extends PHPUnit_Framework_TestCase {
    /**
     * @dataProvider getApiResponseValidDataProvider
     * @param $value
     * @throws \ProxyMarketApiClient\Exceptions\InvalidApiResponse
     */
    public function testValidSuccess($value) {
        $apiResponseValidator = new ProxyMarketApiClient\ProxyMarketApiClient\Validators\ApiResponseValidator();
        $this->assertTrue($apiResponseValidator->valid($value));
    }

    /**
     * @dataProvider getApiResponseInvalidDataProvider
     * @expectedException \ProxyMarketApiClient\Exceptions\InvalidApiResponse
     * @param $value
     */
    public function testValidFail($value) {
        $apiResponseValidator = new ProxyMarketApiClient\ProxyMarketApiClient\Validators\ApiResponseValidator();
        $apiResponseValidator->valid($value);
    }

    /**
     * @return array
     */
    public static function getApiResponseValidDataProvider() {
        return array(
            array('106.186.114.218:3128'),
            array('117.164.245.103'),
            array('8123')
        );
    }

    /**
     * @return array
     */
    public static function getApiResponseInvalidDataProvider() {
        return array(
            array('brak usera o takim api key: xxxxxxxx'),
            array('Brak usera o takim API KEY: xxxxx'),
            array('user: john nie ma aktywnego anonimowego pakietu proxy'),
            array('User: John nie ma aktywnego anonimowego pakietu proxy'),
            array('user: John - zbyt czeste wywolanie api. maksymalnie co: 30 sekund'),
            array('User: John - zbyt czeste wywolanie API. maksymalnie co: 30 sekund')
        );
    }
}
