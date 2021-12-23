<?php


namespace Roozbeh\CoinexPhp;


class Trade
{
    use Initiator\Api;

    /*
     * https://github.com/coinexcom/coinex_exchange_api/wiki/031limit_order
     */
    public function acquireCurrencyRate(){
        $this->connection->url = '/common/currency/rate';
        return $this->prepareResult($this->connection->send());
    }



}