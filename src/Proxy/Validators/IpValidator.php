<?php
/**
 * Created by PhpStorm.
 * User: dpierwola
 * Date: 05.11.15
 * Time: 20:50
 */

namespace ProxyMarketApiClient\Proxy\Validators;

use ProxyMarketApiClient\Proxy\Exceptions\InvalidIpException;

/**
 * Class IpValidator
 * @package ProxyMarketApiClient\Proxy\Validators
 */
class IpValidator extends \ProxyMarketApiClient\Base\Validators {
    /**
     * @param $ip
     * @return bool
     * @throws InvalidIpException
     */
    public function valid($ip)
    {
        if (!filter_var($ip, FILTER_VALIDATE_IP) === false) {
            return true;
        }
        throw new InvalidIpException(sprintf("Ip: %s is invalid!", $ip));
    }
}