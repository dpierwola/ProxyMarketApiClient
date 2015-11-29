<?php
/**
 * Created by PhpStorm.
 * User: dpierwola
 * Date: 04.11.15
 * Time: 21:29
 */

namespace ProxyMarketApiClient\Proxy;

use ProxyMarketApiClient\Proxy\Validators\IpValidator;
use ProxyMarketApiClient\Proxy\Validators\IpPortValidator;

/**
 * Class Proxy
 * @package ProxyMarketApiClient\Proxy
 */
class Proxy {
    /**
     * @var null | string
     */
    protected $ip = null;

    /**
     * @var null | int
     */
    protected $port = null;

    /**
     * @param $ip
     * @param int $port
     */
    public function __construct($ip, $port = 80) {
        $this->setIp($ip);
        $this->setIpPort($port);
    }

    /**
     * @param $ip
     * @throws Exceptions\InvalidIpException
     */
    protected function setIp($ip) {
        if((new IpValidator())->valid($ip)) {
            $this->ip = $ip;
        }
    }

    /**
     * @param $port
     * @throws Exceptions\InvalidIpPortException
     */
    protected function setIpPort($port) {
        if((new IpPortValidator())->valid($port)) {
            $this->port = $port;
        }
    }

    /**
     * @return string
     */
    public function getIp() {
        return $this->ip;
    }

    /**
     * @return int
     */
    public function getPort() {
        return $this->port;
    }

    /**
     * @return string
     */
    public function __toString() {
        return sprintf("%s:%s", $this->ip, $this->port);
    }
}