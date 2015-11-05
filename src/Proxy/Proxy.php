<?php
/**
 * Created by PhpStorm.
 * User: dpierwola
 * Date: 04.11.15
 * Time: 21:29
 */

namespace ProxyMarketApi;

class Proxy {
    protected $ip;
    protected $port;

    public function __construct($ip, $port = 8080) {
        $this->ip = $ip;
        $this->port = $port;
    }

    public function getIp() {
        return $this->ip;
    }

    public function getPort() {
        return $this->port;
    }

    public function __toString() {
        return sprintf("%s:%s", $this->ip, $this->port);
    }
}