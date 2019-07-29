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
    //传入从BCloud控制台申请的密钥
    $PaymentService = new PaymentService($access_key, $secret_key);
    $address_info = $PaymentService->getNewWalletAddress($coin, $uid);
} catch (BCloudException $e) {
    //异常处理
    $this->fail(ResponseService::ERROR_MISSING_PARAM, $e->getMessage());
}
//返回数据
$address_info  = [
    "address"=> "0x9787Bb1dfa0C9b74a0ECe2b116c2a61Efc46069b",
    "address_tag"=> ""
  ];
```

### 链接
* BCloud控制台：[https://console.bcloud.one](https://console.bcloud.one)
* BCloud官网：[https://www.bcloud.one/](https://www.bcloud.one/)
* BCloud接口文档：[https://docs.bcloud.one/](https://docs.bcloud.one/)

