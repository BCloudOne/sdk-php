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

    /**
     * @param $path
     * @param $params
     * @return mixed
     * @throws BCloudException
     */
    function get($path, $params)
    {
        try{
            $this->signParam($params);
            $body = Request::get(self::BCLOUD_API_URL . $path, $params, $this->header());
            $res = json_decode($body, true);
        }catch(\Exception $e) {
            throw new BCloudException("钱包api服务请求异常");
        }
        return $res;
    }

    /**
     * @param $path
     * @param $data
     * @return mixed
     * @throws BCloudException
     */
    function post($path, $data)
    {
        try{
            $this->signParam($data);
            $res = Request::post(self::BCLOUD_API_URL . $path, $data, $this->header());
            $res = json_decode($res, true);
        }catch(\Exception $e) {
            throw new BCloudException("钱包api服务请求异常");
        }
        return $res;
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

}