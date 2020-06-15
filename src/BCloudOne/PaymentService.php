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
     * @return array
     * @throws BCloudException
     */
    function getNewWalletAddress($coin, $user_tag)
    {
        $param = [
            "coin"      => $coin,
            "user_tag"  => $user_tag,
        ];
        $res = $this->post("deposit/address", $param);
        return $res;
    }

    /**
     * 申请提现
     * @param int $user_tag
     * @param int $order_id
     * @param string $coin
     * @param int|float $amount
     * @param string $address
     * @param string $address_tag
     * @return array
     * @throws BCloudException
     */
    public function WithdrawApply($user_tag, $order_id, $coin, $amount, $address, $address_tag = '')
    {
        $param = [
            'user_tag' => $user_tag,
            'order_id' => $order_id,
            'coin'     => $coin,
            'amount'   => $amount,
            'address'  => $address,
            'address_tag' => $address_tag,
        ];
        $res = $this->post("withdraw/apply", $param);
        return $res;
    }

    /**
     * 发起网关支付订单
     * @param $title
     * @param $currency_type
     * @param $value
     * @param $callback_url
     * @param $return_url
     * @param $merc_order_id
     * @param $order_type
     * @param $is_convert
     * @return array
     * @throws BCloudException
     */
    public function GatewayApply($title, $currency_type, $value, $callback_url, $return_url, $merc_order_id, $order_type, $is_convert)
    {
        $param = [
            'title'         => $title,
            'currency_type' => $currency_type,
            'value'         => $value,
            'callback_url'  => $callback_url,
            'return_url'    => $return_url,
            'merc_order_id' => $merc_order_id,
            "order_type"    => $order_type,
            "is_convert"    => $is_convert
        ];
        $res = $this->post("gateway/apply", $param);
        return $res;
    }

    /**
     * 根据商户订单号查询网关订单信息
     * @param $order_id
     * @return array
     * @throws BCloudException
     */
    public function getGatewayOrderById($order_id)
    {
        $param = [
            'order_id' => $order_id,
        ];
        $res = $this->post("gateway/order_info", $param);
        return $res;
    }

    /**
     * 根据币种和交易hash查询充值订单信息
     * @param string $coin
     * @param string $tx_hash
     * @return array
     * @throws BCloudException
     */
    public function getDepositOrderByTxhash($coin, $tx_hash)
    {
        $param = [
            'coin' => $coin,
            'tx_hash' => $tx_hash,
        ];
        $res = $this->post("deposit/order_info", $param);
        return $res;
    }

    /**
     * 查询提现订单信息
     * @param string $coin
     * @param string $tx_hash
     * @param string $order_id
     * @return array
     * @throws BCloudException
     */
    public function getWithdrawOrderByTxhash($coin, $tx_hash, $order_id)
    {
        $param = [
            'coin' => $coin,
            'tx_hash' => $tx_hash,
            'order_id' => $order_id,
        ];
        $res = $this->post("withdraw/order_info", $param);
        return $res;
    }

    /**
     * 获取支持币种的列表
     * @return array
     * @throws BCloudException
     */
    public function getSupportCoinsList(){
        $param = [
        ];
        $res = $this->get("coin/list", $param);
        return $res;
    }
    
}