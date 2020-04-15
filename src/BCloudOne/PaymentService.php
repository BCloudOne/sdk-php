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
     * @return string
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
     * 根据币种和交易hash查询提现订单信息
     * @param string $coin
     * @param string $tx_hash
     * @return array
     * @throws BCloudException
     */
    public function getWithdrawOrderByTxhash($coin, $tx_hash)
    {
        $param = [
            'coin' => $coin,
            'tx_hash' => $tx_hash,
        ];
        $res = $this->post("withdraw/order_info", $param);
        return $res;
    }

    /**
     * 根据币种获取订单列表(支持基础筛选)
     * @param $coin
     * @param string $start_time
     * @param string $end_time
     * @param string $order_id
     * @param string $wallet_address
     * @param string $page
     * @return array
     * @throws BCloudException
     */
    public function getWithdrawOrderList($coin,$start_time = '',$end_time = '',$order_id = '',$wallet_address = '',$page = ''){
        $param = [
            'coin'           => $coin,
            'start_time'     => $start_time,
            'end_time'       => $end_time,
            'order_id'       => $order_id,
            'page'           => $page,
            'wallet_address' => $wallet_address,
        ];
        $res = $this->post("withdraw/order_list", $param);
        return $res;
    }
    
    
}