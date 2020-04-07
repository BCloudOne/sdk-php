<?php
/**
 * Created by PhpStorm.
 * User: Danny
 * Date: 2018/6/30
 * Time: 下午6:00
 */

namespace BCloudOne;


class Request
{

    /**
     * @param string $url
     * @param array $param
     * @param array $header
     * @return mixed
     */
    public static function get($url, $param, $header = [])
    {
        $url .= "?" . http_build_query($param);
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_ENCODING, '');
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        if ($header) {
            curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        }
        $r = curl_exec($curl);
        curl_close($curl);
        return $r;
    }

    /**
     * post request by default format (x-www-form-urlencoded)
     *
     * @param $url
     * @param $data
     * @param $header
     *
     * @return mixed
     */
    public static function post($url, $data, $header = [])
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        if ($header) {
            curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        $r = curl_exec($curl);
        curl_close($curl);
        return $r;
    }
}