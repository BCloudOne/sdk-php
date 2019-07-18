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
     */
    function getNewWalletAddress($coin, $user_tag)
    {
        $param = [
            "coin" => $coin,
            "uid" => $user_tag,
        ];
        $res = $this->post("deposit/address", $param);
        $this->checkError($res);
        return $res['data'];
    }
    
    /**
     * 申请提现
     * @param int $user_id
     * @param int $order_id
     * @param string $coin
     * @param int|float $amount
     * @param string $address
     * @param string $address_tag
     * @return string
     */
    public function WithdrawApply($user_id, $order_id, $coin, $amount, $address, $address_tag = '')
    {
        $param = [
            'user_id' => $user_id,
            'order_id' => $order_id,
            'coin' => $coin,
            'amount' => $amount,
            'address' => $address,
            'address_tag' => $address_tag,
        ];
        $res = $this->post("withdraw/apply", $param);
        $this->checkError($res);
        return $res['data'];
    }
    
    /**
     * 获取提现配置
     * @return array
     */
    public function getWithdrawConfig()
    {
        $res = $this->get("withdraw/config", []);
        $this->checkError($res);
        return $res['data'];
    }
    /**
     * 更新提现配置
     * @param string $callback
     * @param string $confirm_type only_confirm/twice_notify/every_time
     * @return bool
     */
    public function updateWithdrawConfig($callback, $confirm_type)
    {
        $param = [
            'callback' => $callback,
            'confirm_type' => $confirm_type,
        ];
        $res = $this->post("withdraw/config", $param);
        $this->checkError($res);
        return $res['data'];
    }
    /**
     * 获取充值配置
     * @return array
     */
    public function getDepositConfig()
    {
        $res = $this->get("withdraw/config", []);
        $this->checkError($res);
        return $res['data'];
    }
    /**
     * 更新充值配置
     * @param string $callback
     * @param string $confirm_type only_confirm/twice_notify/every_time
     * @return bool
     */
    public function updateDepositConfig($callback, $confirm_type)
    {
        $param = [
            'callback' => $callback,
            'confirm_type' => $confirm_type,
        ];
        $res = $this->post("deposit/config", $param);
        $this->checkError($res);
        return $res['data'];
    }
    
    
    /**
     * 根据币种和交易hash查询充值订单信息
     * @param string $coin
     * @param string $tx_hash
     * @return array
     */
    public function getDepositOrderByTxhash($coin, $tx_hash)
    {
        $param = [
            'coin' => $coin,
            'tx_hash' => $tx_hash,
        ];
        $res = $this->post("deposit/order_info", $param);
        $this->checkError($res);
        return $res['data'];
    }
    /**
     * 根据币种和交易hash查询提现订单信息
     * @param string $coin
     * @param string $tx_hash
     * @return array
     */
    public function getWithdrawOrderByTxhash($coin, $tx_hash)
    {
        $param = [
            'coin' => $coin,
            'tx_hash' => $tx_hash,
        ];
        $res = $this->post("withdraw/order_info", $param);
        $this->checkError($res);
        return $res['data'];
    }
    
    
}