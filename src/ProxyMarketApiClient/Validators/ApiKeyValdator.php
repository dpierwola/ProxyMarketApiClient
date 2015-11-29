<?php
/**
 * Created by PhpStorm.
 * User: dpierwola
 * Date: 11.11.15
 * Time: 20:17
 */

namespace ProxyMarketApiClient\ProxyMarketApiClient\Validators;

use ProxyMarketApiClient\Exceptions\InvalidApiKey;

/**
 * Class ApiKeyValidator
 * @package ProxyMarketApiClient\ProxyMarketApiClient\Validators
 */
class ApiKeyValidator extends \ProxyMarketApiClient\Base\Validators {

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