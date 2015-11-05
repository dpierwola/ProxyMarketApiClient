<?php
/**
 * Created by PhpStorm.
 * User: macbookpro15
 * Date: 03.11.15
 * Time: 00:36
 */
include './vendor/autoload.php';
include './src/ProxyMarketApi.php';


$proxyProvider = new \ProxyMarketApi\ProxyMarketApi('cefc05f78ecf1ef2c262db4d749573240d2668d6', new \Curl\Curl());
try {
    $proxy = $proxyProvider->getProxies();

    var_dump('Drukujemy nasze proxy :-)');
    var_dump($proxy);
} catch(\ProxyMarketApi\Exceptions\InvalidApiResponse $err) {
    echo sprintf("Nie badz taki napalony, serwer mowi: %s\n", $err->getMessage());
}
