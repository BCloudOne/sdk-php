# BCloud One SDK
>基于PHP的BCloud平台SDK

-------
### 安装方法

```
$ composer require bcloudone/sdk-php 
```

### 使用方法


```
use BCloudOne\PaymentService

try {
    //传入RSA公私钥以及秘钥ID
    $PaymentService = new PaymentService($publicKey, $privateKey, $accessId);
    $address_info = $PaymentService->getNewWalletAddress($coin, $user_tag);
    if(!$address_info || $address_info['code'] != 0){
        $this->fail($address_info['code'], $address_info['message']);
    }
} catch (BCloudException $e) {
    //异常处理
    $this->fail(ResponseService::ERROR_MISSING_PARAM, $e->getMessage());
}
//返回数据
$address_info  = [
    'code'    => 0,
    'message' => '成功',
    'data'    => [
        "address"=> "0x9787Bb1dfa0C9b74a0ECe2b116c2a61Efc46069b",
        "address_tag"=> ""
    ]
  ];
```

### 链接
* BCloud控制台：[https://console.bcloud.one](https://console.bcloud.one)
* BCloud官网：[https://www.bcloud.one/](https://www.bcloud.one/)
* BCloud接口文档：[https://docs.bcloud.one/](https://docs.bcloud.one/)



