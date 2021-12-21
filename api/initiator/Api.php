<?php
namespace Roozbeh\CoinexPhp\Initiator;

/**
 * https://github.com/NabiKAZ/Coinex-API-PHP
 */

use mysql_xdevapi\Exception;
use  NabiKAZ\Coinex\CoinexAPI;

trait Api {

    /**
     * @var CoinexAPI
     */
   private $connection ;

    private $accessId ;
    private $secretKey ;
    /**
     * format = socks5://user:pass@localhost:12345
     */
    private $proxy = '';

   function  __construct($accessId,$secretKey,$proxy = null)
   {
       $this->accessId = $accessId ;
       $this->secretKey = $secretKey;
       defined($proxy) ?  $this->proxy = $proxy : $proxy = null ;
       $this->connection = new CoinexAPI($accessId, $secretKey, $proxy);
    }

    function prepareResult($result)
    {

        if($result['code'] == 0)
            return $result['data'] ;

        $errorMessage = '';
        switch ($result['code']) {
            case 1 :
                $errorMessage = 'Error Code 1';
            case 2 :
                $errorMessage = 'Error Code 2 - Parameter error';
            case 25 :
                $errorMessage = 'Error Code 25 - Signature error';
            case 107 :
                $errorMessage = 'Error Code 107 - Insufficient balance ';
            case 600 :
                $errorMessage = 'Error Code 600 - Order number does not exist ';
            case 601 :
                $errorMessage = 'Error Code 601 - Other user\'s order ';
            case 602 :
                $errorMessage = 'Error Code 602 - Below min. buy/sell limit ';
            case 606 :
                $errorMessage = 'Error Code 606 - price and the latest deviation is too large ';
        }

        throw new Exception($errorMessage);
    }


}