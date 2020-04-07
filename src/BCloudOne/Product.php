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
    private $publicKey  = null;
    private $privateKey = null;
    private $accessId   = null;
    const BCLOUD_API_URL = "https://api.bcloud.one/v1/";

    function __construct($publicKey, $privateKey, $accessId)
    {
        $this->publicKey  = $publicKey;
        $this->privateKey = $privateKey;
        $this->accessId   = $accessId;
    }

    function header()
    {
        return [
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

    /**
     * RSA 私钥签名
     * @param $params
     */
    function signParam(&$params)
    {
        $params["timestamp"] = time();
        $params['access_id']  = $this->accessId;

        ksort($params);
        foreach ($params as $key => $value) {
            $tmp[] = $key . '=' . $value;
        }
        $string = implode('&', $tmp);

        openssl_sign($string, $sign,$this->privateKey,OPENSSL_ALGO_SHA256);
        $sign = base64_encode($sign);
        $params["sign"] = $sign;
    }

    /**
     * 检查是否有错误，并抛出异常
     * @param unknown $res
     * @throws BCloudException
     */
    public function checkError($res)
    {
        if (!$res || $res['code'] != 0) {
            throw new BCloudException($res['message'], $res['code']);
        }
    }

}