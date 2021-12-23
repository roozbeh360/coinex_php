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
    /**
     * @param string $market
     * @return mixed
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

    /*
     * https://github.com/coinexcom/coinex_exchange_api/wiki/022depth
     */
    /**
     * @param string $market
     * @param string $merge
     * @param int $limit
     * @return mixed
     */
    public function acquireMarketDepth(string $market,string $merge,int $limit){
        $this->connection->url = '/market/depth';
        $this->connection->params = ['market'=>market,'merge'=>$merge,'limit'=>$limit];
        return $this->prepareResult($this->connection->send());
    }

    /*
     * https://github.com/coinexcom/coinex_exchange_api/wiki/023deals
     */
    /**
     * @param string $market
     * @param int $lastId
     * @param int $limit
     * @return mixed
     */
    public function acquireLatestTransactionData(string $market,int $lastId,int $limit){
        $this->connection->url = '/market/deals';
        $this->connection->params = ['market'=>market,'last_id'=>$lastId,'limit'=>$limit];
        return $this->prepareResult($this->connection->send());
    }

    /*
     * https://github.com/coinexcom/coinex_exchange_api/wiki/024kline
     */
    /**
     * @param string $market
     * @param string $type
     * @param int $limit
     * @return mixed
     */
    public function acquireKlineData(string $market,string $type,int $limit){
        $this->connection->url = '/market/kline';
        $this->connection->params = ['market'=>market,'type'=>$type,'limit'=>$limit];
        return $this->prepareResult($this->connection->send());
    }

    /*
     * https://github.com/coinexcom/coinex_exchange_api/wiki/025marketinfo
     */
    public function acquireMarketInformation(){
        $this->connection->url = '/market/info';
        return $this->prepareResult($this->connection->send());
    }

    /*
     * https://github.com/coinexcom/coinex_exchange_api/wiki/026market_single_info
     */
    /**
     * @param string $market
     * @return mixed
     */
    public function acquireSingleMarketInformation(string $market){
        $this->connection->url = '/market/detail';
        $this->connection->params = ['market'=>market];
        return $this->prepareResult($this->connection->send());
    }

    /*
     * https://github.com/coinexcom/coinex_exchange_api/wiki/092amm_market_list
     */
    public function AcquireAmmMarketList(){
        $this->connection->url = '/amm/market';
        return $this->prepareResult($this->connection->send());
    }




}