<?php
/**
 * Created by PhpStorm.
 * User: dpierwola
 * Date: 05.11.15
 * Time: 20:50
 */

namespace ClientProxyMarketApi\Proxy\Validators;

use ClientProxyMarketApi\Proxy\Exceptions\InvalidIpException;

class IpValidator extends \ClientProxyMarketApi\Base\Validators {
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