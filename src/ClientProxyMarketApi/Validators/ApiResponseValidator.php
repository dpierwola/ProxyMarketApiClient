<?php
/**
 * Created by PhpStorm.
 * User: dpierwola
 * Date: 11.11.15
 * Time: 20:30
 */

namespace ClientProxyMarketApi\ClientProxyMarketApi\Validators;

use ClientProxyMarketApi\Exceptions\InvalidApiResponse;

class ApiResponseValidator extends \ClientProxyMarketApi\Base\Validators {
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
        if((bool)!preg_match(self::INVALID_RESPONSE_PATTERN, $value)) {
            throw new InvalidApiResponse($value);
        }
        return true;
    }
}