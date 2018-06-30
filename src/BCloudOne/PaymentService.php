<?php
/**
 * Created by PhpStorm.
 * User: Danny
 * Date: 2018/6/30
 * Time: 下午5:49
 */

namespace BCloudOne;


class PaymentService extends Product
{
    /**
     * 获取新钱包地址
     * @param $coin
     * @param $user_tag
     * @return string
     */
    function getNewWalletAddress($coin, $user_tag)
    {
        $param = [
            "coin" => $coin,
            "user_tag" => $user_tag,
        ];
        $res = $this->get("payment/address", $param);
        return $res["wallet_address"];
    }
}