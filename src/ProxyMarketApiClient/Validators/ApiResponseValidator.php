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
     * @const INVALID_RESPONSE_PATTERN
     */
    const INVALID_RESPONSE_PATTERN = "/^.*(zbyt czeste wywolanie API)+/i";

    /**
     * @param $value
     * @return bool
     * @throws InvalidApiResponse
     */
    function valid($value)
    {
        if((bool)preg_match(self::INVALID_RESPONSE_PATTERN, $value)) {
            throw new InvalidApiResponse($value);
        }
        return true;
    }
}