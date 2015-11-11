<?php
/**
 * Created by PhpStorm.
 * User: dpierwola
 * Date: 11.11.15
 * Time: 20:56
 */

include dirname(__FILE__) . '/../vendor/autoload.php';

try {
    $clientProxyMarket = new ClientProxyMarketApi\ClientProxyMarketApi('xxxxxxxxxxxxxxxxxxxxxxxxxxx', new \Curl\Curl());
    $proxyCollection = $clientProxyMarket->getProxyCollection();

    while($proxy = $proxyCollection->pop()) {
       echo sprintf("Ip: %s, port: %s\n", $proxy->getIp(), $proxy->getPort());
    }
} catch(Exception $ex) {
    echo sprintf("Error: %s\n",  $ex->getMessage());
}