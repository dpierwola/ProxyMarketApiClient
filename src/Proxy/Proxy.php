<?php
/**
 * Created by PhpStorm.
 * User: dpierwola
 * Date: 04.11.15
 * Time: 21:29
 */

namespace ProxyMarketApi\Proxy;

use ProxyMarketApi\Proxy\Validators\IpValidator;
use ProxyMarketApi\Proxy\Validators\IpPortValidator;


class Proxy {
    protected $ip = null;
    protected $port = null;

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