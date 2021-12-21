<?php


namespace Roozbeh\CoinexPhp;

class Market
{
    use Initiator\Api;

    /*
     * https://github.com/coinexcom/coinex_exchange_api/wiki/020market
     *
     */
    public function acquireMarketList(){
        $this->connection->url = '/market/list';
        return  $this->prepareResult($this->connection->send());
    }

    /*
     * https://github.com/coinexcom/coinex_exchange_api/wiki/021ticker
     */
    public function acquireMarketStatistics(string $market){
        $this->connection->url = '/market/ticker';
        $this->connection->params = ['market' => $market];
        return $this->prepareResult($this->connection->send());
    }

    /*
     * https://github.com/coinexcom/coinex_exchange_api/wiki/021ticker
     */
    public function acquireAllMarketData(){
        $this->connection->url = '/market/ticker/all';
        return $this->prepareResult($this->connection->send());
    }

}