<?php
/**
 * Created by PhpStorm.
 * User: dpierwola
 * Date: 11.11.15
 * Time: 20:30
 */

namespace ProxyMarketApiClient\ProxyMarketApiClient\Validators;

use ProxyMarketApiClient\Exceptions\InvalidApiResponse;

/**
 * Class ApiResponseValidator
 * @package ProxyMarketApiClient\ProxyMarketApiClient\Validators
 */
class ApiResponseValidator extends \ProxyMarketApiClient\Base\Validators {
    /**
     * @const string INVALID_USERNAME_PATTERN
     */
    const INVALID_USERNAME_PATTERN = "/^(brak usera o takim api key:)+.*/i";

    /**
     * @const string LACK_OF_CREDITS_PATTERN
     */
    const LACK_OF_CREDITS_PATTERN = "/^(user:).*(nie ma aktywnego anonimowego pakietu proxy)+/i";

    /**
     * @const string TO_MANY_REQUEST_PATTERN
     */
    const TO_MANY_REQUEST_PATTERN = "/^(user:).*(- zbyt czeste wywolanie api. maksymalnie co: 30 sekund)/i";

    /**
     * @param $value
     * @return bool
     * @throws InvalidApiResponse
     */
    function valid($value)
    {
        if(
            (bool)preg_match(self::INVALID_USERNAME_PATTERN, $value) ||
            (bool)preg_match(self::LACK_OF_CREDITS_PATTERN, $value) ||
            (bool)preg_match(self::TO_MANY_REQUEST_PATTERN, $value)
        ) {
            throw new InvalidApiResponse($value);
        }
        return true;
    }
}