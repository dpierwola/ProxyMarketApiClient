<?php
/**
 * Created by PhpStorm.
 * User: dpierwola
 * Date: 05.11.15
 * Time: 21:14
 */

namespace ProxyMarketApiClient\Proxy\Validators;

use ProxyMarketApiClient\Proxy\Exceptions\InvalidIpPortException;

/**
 * Class IpPortValidator
 * @package ProxyMarketApiClient\Proxy\Validators
 */
class IpPortValidator extends \ProxyMarketApiClient\Base\Validators {
    /**
     * @const int MIN_RANGE_IP_PORT
     */
    const MIN_RANGE_IP_PORT = 0;

    /**
     * @const int MAX_RANGE_IP_PORT
     */
    const MAX_RANGE_IP_PORT = 65535;

    /**
     * Rules for ip port is defined in RFC-6056 standard
     * https://tools.ietf.org/html/rfc6056
     * @param $ipPort
     * @return bool
     * @throws InvalidIpPortException
     */
    function valid($ipPort)
    {
        if(!is_int($ipPort) || $ipPort < self::MIN_RANGE_IP_PORT || $ipPort > self::MAX_RANGE_IP_PORT) {
            throw new InvalidIpPortException(sprintf("Port: %s is invalid", $ipPort));
        }
        return true;
    }
}