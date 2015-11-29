<?php
/**
 * Created by PhpStorm.
 * User: dpierwola
 * Date: 05.11.15
 * Time: 20:49
 */

namespace ProxyMarketApiClient\Base;

/**
 * Class Validators
 * @package ProxyMarketApiClient\Base
 */
abstract class Validators {
    /**
     * @param $value
     * @return boolean
     */
    abstract function valid($value);
}