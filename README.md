# Coinex API PHP
Coinex digital coin exchange API for PHP

## Requirements
- PHP>=7.1
- CURL PHP module

## Install
```shell
composer require roozbeh/coinex_php
```

## Acquire access\_id and secret\_key
Sign in to [CoinEx](https://www.coinex.com/register?refer_code=6zaqh) before invoking API and get Acquire access\_id/secret\_key in **Account** &gt; **API**.

> access\_id: To mark identity of API invoker
> 
> secret\_key: Key to sign the request parameters

## Setup request
```php
<?php
use Roozbeh\CoinexPhp\Market;


//use this variable in some functions as global
$access_id = '<ACCESS_ID>';
$secret_key = '<SECRET_KEY';



$market = new  Market($access_id,$secret_key);
$result = $market->acquireMarketList();

```

## Set proxy
The proxy is optional.\
Use proxy URL with this format:
```scheme://[username:password@]hostname:port```\
For examples:
```php
$proxy = 'socks5://user:pass@localhost:12345';
$proxy = 'http://127.0.01:8080';
```
And so use this proxy when setup request:
```php
$market = new  Market($access_id,$secret_key,$proxy);
$result = $market->acquireMarketList();
```

## Set params
```php
//params if nedded
//IMPORTANT: no needed set access_id, tonce into params.
$market->acquireMarketStatistics('BCHBTC');
```


## Wiki
See all requests, params and responses in [here official wiki](https://github.com/coinexcom/coinex_exchange_api/wiki).
