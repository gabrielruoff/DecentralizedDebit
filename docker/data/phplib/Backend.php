<?php

namespace Backend;

//require_once('/usr/local/php/lib/vendor/autoload.php');
require_once('vendor/autoload.php');
require_once('Redirect.php');

use GuzzleHttp;

class apibackend
{

    /**
     * apibackend constructor.
     * @param string $hostname
     * @param int $port
     */
    function __construct()
    {
        $this->client = new GuzzleHttp\Client();
        $this->baseurl = 'http://71.176.66.122:5000';
    }

    /**
     * Helper function for creating requests
     * @param json $body
     */
    public function _request($suburl, $body)
    {

        $body = json_encode($body);
        $ch = curl_init();
        $curlConfig = array(
            CURLOPT_URL            => $this->baseurl.'/'.$suburl,
            CURLOPT_POST           => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => array('Content-Type:application/json', 'Content-Length: '. strlen($body)),
            CURLOPT_POSTFIELDS => $body,
            CURLOPT_FOLLOWLOCATION => true
        );
        curl_setopt_array($ch, $curlConfig);
        $result = curl_exec($ch);
        curl_close($ch);

        // format result
        $result = json_decode($result);
        $result->success = eval("return $result->success;");
        return $result;
    }

    public function authenticate($username, $password) {
        $params = ["username" => $username, "password" => $password];
        $body = ["method" => "authenticate", "body" => $params];
        return $this->_request('Account/'.$username, $body);
    }

    public function createaccount($username, $password, $ismerchant=false) {
        $params = ["username" => $username, "password" => $password, "merchant" => $ismerchant];
        $body = ["method" => "createaccount", "body" => $params];
        return $this->_request('Accounts', $body);
    }

    public function becomemerchant($username, $password) {
        $params = ["username" => $username, "password" => $password];
        $body = ["method" => "becomemerchant", "body" => $params];
        return $this->_request('Accounts', $body);
    }

    public function createwalletbtc($username, $password) {
        $params = ["password" => $password];
        $body = ["method" => "createwalletbtc", "body" => $params];
        return $this->_request('Account/'.$username, $body);
    }

    public function getbalance($username, $currency, $sessionid) {
        $params = ["session_id" => $sessionid];
        $body = ["method" => "getbalance", "body" => $params];
        return $this->_request('Wallet/'.$username.'/'.$currency, $body);
    }

    public function getnewaddress($currency, $username, $sessionid) {
        $params = ["session_id" => $sessionid];
        $body = ["method" => "getnewaddress", "body" => $params];
        return $this->_request('Wallet/'.$username.'/'.$currency, $body);
    }

    public function submittransaction($username, $rx_data, $tx_data, $signed_hash, $password) {
        $params = ["rx_data" => $rx_data, "tx_data" => $tx_data, "signed_hash" => $signed_hash, "password" => $password];
        $body = ["method" => "submittransaction", "body" => $params];
        return $this->_request('Merchant/'.$username, $body);
    }

    public function generatesessionid($username, $password) {
        $params = ["password" => $password];
        $body = ["method" => "generatesessionid", "body" => $params];
        return $this->_request('Account/'.$username, $body);
    }

    public function validatesession($username, $sessionid) {
        $params = ["session_id" => $sessionid];
        $body = ["method" => "validatesession", "body" => $params];
        return $this->_request('Account/'.$username, $body);
    }

    public function listtransactions($username, $currency, $sessionid) {
        $params = ["session_id" => $sessionid];
        $body = ["method" => "listtransactions", "body" => $params];
        return $this->_request('Wallet/'.$username.'/'.$currency, $body);
    }

}