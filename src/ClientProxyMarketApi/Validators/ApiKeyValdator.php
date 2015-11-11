<?php
/**
 * Created by PhpStorm.
 * User: dpierwola
 * Date: 11.11.15
 * Time: 20:17
 */

namespace ClientProxyMarketApi\ClientProxyMarketApi\Validators;

use ClientProxyMarketApi\Exceptions\InvalidApiKey;

class ApiKeyValidator extends \ClientProxyMarketApi\Base\Validators {

    /**
     * @param $value
     * @return bool
     * @throws InvalidApiKey
     */
    function valid($value)
    {
        if(empty($value)) {
            throw new InvalidApiKey('Api key is invalid');
        }
        return true;

    }
}