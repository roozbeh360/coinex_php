<?php


namespace Roozbeh\CoinexPhp;


class Trade
{
    use Initiator\Api;

    /*
     * https://github.com/coinexcom/coinex_exchange_api/wiki/031limit_order
     */
    /**
     * @param string $market
     * @param string $type sell,buy
     * @param string $amount order amount, min. 0.001, accurate to 8 decimal places
     * @param string $price order amount, accurate to 8 decimal places
     * @param string|null $sourceId
     * @param string|null $option order option, NORMAL: normal order, IOC: an Immediate or Cancel Order, FOK: Fill or kill Order, MAKER_ONLY: only maker order, default value is NORMAL
     * @param int|null $accountId
     * @param string|null $clientId
     * @param bool|null $hide
     * @return mixed
     */
    public function placeLimitOrder(string $market,string $type,string $amount,string $price, string $sourceId = null,string $option = null,int $accountId = null ,string $clientId = null ,bool $hide = null ){
        $this->connection->url = '/common/currency/rate';
        $this->connection->method = 'POST';
        $this->connection->params = [
            
            
            'market' => $market,
            'type' => $type,
            'amount' => $amount,
            'price' => $price,
            'source_id' => $sourceId,
            'option' => $option,
            'account_id' => $accountId,
            'client_id' => $clientId,
            'hide' => $hide
        ];
        return $this->prepareResult($this->connection->send());
    }

    /*
     * https://github.com/coinexcom/coinex_exchange_api/wiki/0312limit_batch_orders
     */
    /**
     * @param string $market
     * @param string $type sell: sell order;     buy: buy order;
     * @param string $amount
     * @param string $price
     * @param array $batchOrders
     * @param string|null $sourceId
     * @param int|null $accountId
     * @return mixed
     */
    public function placeMultipleLimitOrders(string $market,string $type,string $amount,string $price,array $batchOrders, string $sourceId = null,int $accountId = null ){
        $this->connection->url = '/order/limit/batch';
        $this->connection->method = 'POST';
        $this->connection->params = [
            
            
            'market' => $market,
            'type' => $type,
            'amount' => $amount,
            'price' => $price,
            'source_id' => $sourceId,
            'batch_orders' => json_encode($batchOrders), // use makeSingleBatchOrder to make single row of batches
            'account_id' => $accountId
        ];
        return $this->prepareResult($this->connection->send());
    }

    /**
     * @param string $type
     * @param string $amount
     * @param string $price
     * @param string|null $sourceId
     * @param string|null $option
     * @param string|null $clientId
     * @return array
     */
    public function makeSingleBatchOrder(string $type,string $amount,string $price, string $sourceId = null,string $option = null,string $clientId = null ){
        return [
            "source_id" => $sourceId ,
            "amount" => $amount,
            "type" => $type,
            "price" =>$price,
            "client_id" => $clientId,
            "option" => $option
        ];
    }

    /*
     * https://github.com/coinexcom/coinex_exchange_api/wiki/032market_order
     */
    /**
     * @param string $market
     * @param string $type
     * @param string $amount
     * @param string|null $sourceId
     * @param int|null $accountId
     * @param string|null $clientId
     * @return mixed
     */
    public function placeMarketOrder(string $market,string $type,string $amount, string $sourceId = null,int $accountId = null ,string $clientId = null  ){
        $this->connection->url = '/order/market';
        $this->connection->method = 'POST';
        $this->connection->params = [
            
            
            'market' => $market,
            'type' => $type,
            'amount' => $amount,
            'source_id' => $sourceId,
            'account_id' => $accountId,
            'client_id' => $clientId,
        ];
        return $this->prepareResult($this->connection->send());
    }

    /*
     * https://github.com/coinexcom/coinex_exchange_api/wiki/03111stop_limit_order
     */
    /**
     * @param string $market
     * @param string $type
     * @param string $amount
     * @param string $price
     * @param string $stopPrice
     * @param string|null $sourceId
     * @param string|null $option
     * @param string|null $clientId
     * @param bool|null $hide
     * @return mixed
     */
    public function placeStopLimitOrder(  string $market, string $type, string $amount, string $price, string $stopPrice, string $sourceId = null,int $accountId = null , string $option =  null, string $clientId = null, bool $hide = null){
        $this->connection->url = '/order/stop/limit';
        $this->connection->method = 'POST';
        $this->connection->params = [
            
            
            'market' => $market,
            'type' => $type,
            'amount' => $amount,
            'source_id' => $sourceId,
            'client_id' => $clientId,
            'account_id'=>$accountId ,
            'stop_price' => $stopPrice,
            'price' => $price,
            'option' => $option,
            'hide' => $hide
        ];
        return $this->prepareResult($this->connection->send());
    }

    /*
     * https://github.com/coinexcom/coinex_exchange_api/wiki/033IOC_order
     */
    /**
     * @param string $market
     * @param string $type
     * @param string $amount
     * @param string $price
     * @param string|null $sourceId
     * @param string|null $clientId
     * @param string|null $accountId
     * @return mixed
     */
    public function placeIOCOrder(  string $market, string $type, string $amount, string $price,string $sourceId = null, string $clientId = null, string $accountId = null){
        $this->connection->url = '/order/ioc';
        $this->connection->method = 'POST';
        $this->connection->params = [
           
           
            'market' => $market,
            'type' => $type,
            'amount' => $amount,
            'source_id' => $sourceId,
            'client_id' => $clientId,
            'account_id'=>$accountId ,
            'price' => $price,
        ];
        return $this->prepareResult($this->connection->send());
    }

    /*
     * https://github.com/coinexcom/coinex_exchange_api/wiki/034pending
     */
    /**
     * @param string $market
     * @param int $limit
     * @param int $page
     * @param string|null $type
     * @param int|null $accountId
     * @return mixed
     */
    public function acquireUnexecutedOrderList(  string $market, int $limit, int $page,string $type = null, int $accountId = null){
        $this->connection->url = '/order/pending';
        $this->connection->params = [
            
            
            'market' => $market,
            'type' => $type,
            'page' => $page,
            'limit' => $limit,
            'account_id'=>$accountId
        ];
        return $this->prepareResult($this->connection->send());
    }

    /*
     * https://github.com/coinexcom/coinex_exchange_api/wiki/041stop_pending
     */
    /**@param string $market
     * @param int $limit
     * @param int $page
     * @param string|null $type
     * @param int|null $accountId
     * @return mixed
     */
    public function acquireUnexecutedStopOrderList( string $market, int $limit, int $page,string $type = null, int $accountId = null){
        $this->connection->url = '/order/stop/pending';
        $this->connection->params = [
            
            'market' => $market,
            'type' => $type,
            'page' => $page,
            'limit' => $limit,
            'account_id'=>$accountId
        ];
        return $this->prepareResult($this->connection->send());
    }

    /*
     * https://github.com/coinexcom/coinex_exchange_api/wiki/036finished
     */
    /**
     * @param string $market
     * @param int $limit
     * @param int $page
     * @param int|null $accountId
     * @return mixed
     */
    public function acquireExecutedOrderList(  string $market, int $limit, int $page, int $accountId = null){
        $this->connection->url = '/order/finished';
        $this->connection->params = [
            
            
            'market' => $market,
            'page' => $page,
            'limit' => $limit,
            'account_id'=>$accountId
        ];
        return $this->prepareResult($this->connection->send());
    }

    /*
     * https://github.com/coinexcom/coinex_exchange_api/wiki/040stop_finished
     */
    /**@param string $market
     * @param int $limit
     * @param int $page
     * @param int|null $accountId
     * @return mixed
     */
    public function acquireExecutedStopOrderList( string $market, int $limit, int $page, int $accountId = null){
        $this->connection->url = '/order/finished';
        $this->connection->params = [
            
            'market' => $market,
            'page' => $page,
            'limit' => $limit,
            'account_id'=>$accountId
        ];
        return $this->prepareResult($this->connection->send());
    }

    /*
     * https://github.com/coinexcom/coinex_exchange_api/wiki/037order_status
     */
    /**
     * @param string $market
     * @param int $id
     * @return mixed
     */
    public function acquireOrderStatus(  string $market, int $id){
        $this->connection->url = '/order/status';
        $this->connection->params = [
            
            
            'market' => $market,
            'id' => $id
        ];
        return $this->prepareResult($this->connection->send());
    }

    /*
     * https://github.com/coinexcom/coinex_exchange_api/wiki/0313batch_orders_status
     */
    /**
     * @param string $market
     * @param array $ids
     * @return mixed
     */
    public function acquireMultipleOrders(  string $market, array $ids){
        $this->connection->url = '/order/status/batch';
        $this->connection->params = [
            
            
            'market' => $market,
            'batch_ids' => implode(',',$ids)
        ];
        return $this->prepareResult($this->connection->send());
    }

    /*
     * https://github.com/coinexcom/coinex_exchange_api/wiki/0311order_deals
     */
    /**
     * @param int $id order number
     * @param int $page
     * @param int $limit
     * @param int|null $accountId
     * @return mixed
     */
    public function acquireExecutedOrderDetail(  int $id,int $page,int $limit,int $accountId = null){
        $this->connection->url = '/order/deals';
        $this->connection->params = [
            
            
            'id' => $id,
            'page' => $page,
            'limit' => $limit,
            'account_id' => $accountId
        ];
        return $this->prepareResult($this->connection->send());
    }

    /*
     * https://github.com/coinexcom/coinex_exchange_api/wiki/039user_deals
     */
    /**
     * @param int $market
     * @param int $page
     * @param int $limit
     * @param int|null $accountId
     * @return mixed
     */
    public function acquireUserDeals(  int $market,int $page,int $limit,int $accountId = null){
        $this->connection->url = '/order/user/deals';
        $this->connection->params = [
            
            
            'market' => $market,
            'page' => $page,
            'limit' => $limit,
            'account_id' => $accountId
        ];
        return $this->prepareResult($this->connection->send());
    }

    /*
     * https://github.com/coinexcom/coinex_exchange_api/wiki/035cancel
     */
    /**
     * @param int $id
     * @param string $market
     * @param int|null $accountId
     * @return mixed
     */
    public function cancelOrder(  int $id,string $market,int $accountId = null){
        $this->connection->url = '/order/pending';
        $this->connection->method = 'DELETE';
        $this->connection->params = [
            
            
            'id' => $id,
            'market' => $market,
            'account_id' => $accountId
        ];
        return $this->prepareResult($this->connection->send());
    }

    /*
     * https://github.com/coinexcom/coinex_exchange_api/wiki/0314cancel_batch
     */
    /**
     * @param array $ids
     * @param string $market
     * @param int|null $accountId
     * @return mixed
     */
    public function cancelMultipleOrders(  array $ids,string $market,int $accountId = null){
        $this->connection->url = '/order/pending/batch';
        $this->connection->method = 'DELETE';
        $this->connection->params = [
            
            
            'batch_ids' => implode(',',$ids),
            'market' => $market,
            'account_id' => $accountId
        ];
        return $this->prepareResult($this->connection->send());
    }

    /*
     * https://github.com/coinexcom/coinex_exchange_api/wiki/0315cancel_all
     */
    /**
     * @param string $market
     * @param int $accountId
     * @return mixed
     */
    public function cancelAllOrder(  string $market, int $accountId){
        $this->connection->url = '/order/pending';
        $this->connection->method = 'DELETE';
        $this->connection->params = [
            'market' => $market,
            'account_id' => $accountId
        ];
        return $this->prepareResult($this->connection->send());
    }


}