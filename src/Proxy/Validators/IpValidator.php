<?php
/**
 * Created by PhpStorm.
 * User: dpierwola
 * Date: 05.11.15
 * Time: 20:50
 */

namespace ProxyMarketApi\Proxy\Validators;

use ProxyMarketApi\Proxy\Exceptions\InvalidIpException;

class IpValidator extends \ProxyMarketApi\Base\Validators {
    /**
     * @param $ip
     * @return bool
     * @throws InvalidIpException
     */
    public function valid($ip)
    {
        if(filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6) !== false) {
            throw new InvalidIpException(sprintf("Ip: %s is invalid!"), $ip);
        }
        return true;
    }
}