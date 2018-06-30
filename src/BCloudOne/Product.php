<?php
/**
 * Created by PhpStorm.
 * User: Danny
 * Date: 2018/6/30
 * Time: 下午5:50
 */

namespace BCloudOne;


class Product
{
    private $accessKey = null;
    private $secretKey = null;
    const BCLOUD_API_URL = "https://api.bcloud.one/v1/";

    function __construct($accessKey, $secretKey)
    {
        $this->accessKey = $accessKey;
        $this->secretKey = $secretKey;
    }

    function header()
    {
        return [
            "ACCESS-KEY" => $this->accessKey
        ];
    }

    function get($path, $params)
    {
        $this->signParam($params);
        $body = Request::get(self::BCLOUD_API_URL . $path, $params, $this->header());
        $res = json_decode($body, true);
        if ($res["code"] != 0) {
            throw new BCloudException($res["message"], $res["code"]);
        } else {
            return $res["data"];
        }
    }

    function post($path, $data)
    {
        $this->signParam($data);
        $res = Request::post(self::BCLOUD_API_URL . $path, $data, $this->header());
        return json_decode($res, true);
    }

    function signParam(&$params)
    {
        $params["timestamp"] = time();
        ksort($params);
        $string = '';
        foreach ($params as $key => $value) {
            $string .= $key . '=' . $value;
        }
        $sign = md5($string . $this->secretKey);
        $params["sign"] = $sign;
    }
}