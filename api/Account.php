<?php


namespace Roozbeh\CoinexPhp;


class Account
{
    use Initiator\Api;

    /*
     * https://github.com/coinexcom/coinex_exchange_api/wiki/060balance
     */
    /**
     * @return mixed
     */
    public function AcquireAssetConfig(){
        $this->connection->url = '/balance/info';
        return $this->prepareResult($this->connection->send());
    }

    /*
     * https://github.com/coinexcom/coinex_exchange_api/wiki/067margin_account
     */
    public function inquireMarginAccountMarketInfo(){
        $this->connection->url = '/balance/info';
        return $this->prepareResult($this->connection->send());
    }

    /*
     * https://github.com/coinexcom/coinex_exchange_api/wiki/061get_withdraw_list
     */
    /**
     * @param string|null $coinType
     * @param int|null $coinWithdrawId
     * @param int|null $page
     * @param int|null $limit
     * @return mixed
     */
    public function inquireWithdrawalList(string $coinType = null,int $coinWithdrawId = null,int $page = null,int $limit = null){
        $this->connection->url = '/balance/info';
        $this->connection->params = [
            'coin_type'=>$coinType,
            'coin_withdraw_id' => $coinWithdrawId,
            'page' => $page,
            'Limit' => $limit
        ];
        return $this->prepareResult($this->connection->send());
    }

    /*
     * https://github.com/coinexcom/coinex_exchange_api/wiki/069market_fee
     */
    /**
     * @param string $market
     * @param string|null $businessType
     * @return mixed
     */
    public function inquireMarketFee(string $market,string $businessType = null){
        $this->connection->url = '/account/market/fee';
        $this->connection->params = [
            'business_type'=>$businessType,
            'market'=>$market
        ];
        return $this->prepareResult($this->connection->send());
    }

    /*
     * https://github.com/coinexcom/coinex_exchange_api/wiki/062submit_withdraw
     */
    /**
     * @param string $coinType
     * @param string $coinAddress
     * @param string $transferMethod
     * @param string $actualAmount
     * @param string|null $smartContractName
     * @return mixed
     */
    public function submitWithdrawalOrder(string $coinType,string $coinAddress,string $transferMethod,string $actualAmount ,string $smartContractName = null){
        $this->connection->url = '/balance/coin/withdraw';
        $this->connection->method = 'POST';
        $this->connection->params = [
            'coin_type'=>$coinType,
            'coin_address'=>$coinAddress,
            'smart_contract_name' => $smartContractName,
            'transfer_method' => $transferMethod,
            'actual_amount' => $actualAmount

        ];
        return $this->prepareResult($this->connection->send());
    }

    /*
     * https://github.com/coinexcom/coinex_exchange_api/wiki/064cancel_withdraw
     */
    /**
     * @param int $coinWithdrawId
     * @return mixed
     */
    public function cancelWithdrawal(int $coinWithdrawId){
        $this->connection->url = '/balance/coin/withdraw';
        $this->connection->method = 'DELETE';
        $this->connection->params = [
            'coin_withdraw_id'=>$coinWithdrawId
        ];
        return $this->prepareResult($this->connection->send());
    }

    /*
     * https://github.com/coinexcom/coinex_exchange_api/wiki/065get_deposit_list
     */
    /**
     * @param string|null $coinType
     * @param string|null $status
     * @param int|null $page
     * @param int|null $limit
     * @return mixed
     */
    public function inquireDepositList(string $coinType = null,string $status = null,int $page = null,int $limit = null){
        $this->connection->url = '/balance/coin/deposit';
        $this->connection->params = [
            'page' => $page,
            'coinType' => $coinType,
            'status' => $status,
            'Limit'=>$limit
        ];
        return $this->prepareResult($this->connection->send());
    }

    /*
     * https://github.com/coinexcom/coinex_exchange_api/wiki/066sub_account
     */
    /**
     * @param string $coinType
     * @param string $amount
     * @param string|null $transferAccount
     * @param string|null $transferSide
     * @return mixed
     */
    public function transferBetweenMainAccountAndSubAccount(string $coinType ,string $amount ,string $transferAccount = null ,string $transferSide = null){
        $this->connection->url = '/sub_account/transfer';
        $this->connection->method = 'POST';
        $this->connection->params = [
            'coin_type' => $coinType,
            'amount'=>$amount,
            'transfer_account' => $transferAccount,
            'transfer_side' => $transferSide
        ];
        return $this->prepareResult($this->connection->send());
    }

    /*
     * https://github.com/coinexcom/coinex_exchange_api/wiki/068margin_transfer
     */
    /**
     * @param string $coinType
     * @param string $amount
     * @param string $fromAccount
     * @param string $toAccount
     * @return mixed
     */
    public function transferBetweenMainAccountAndMarginAccount(string $coinType ,string $amount ,string $fromAccount ,string $toAccount ){
        $this->connection->url = '/margin/transfer';
        $this->connection->method = 'POST';
        $this->connection->params = [
            'coin_type' => $coinType,
            'amount'=>$amount,
            'from_account' => $fromAccount,
            'to_account' => $toAccount
        ];
        return $this->prepareResult($this->connection->send());
    }

    /*
     * https://github.com/coinexcom/coinex_exchange_api/wiki/072get_deposit_address
     */
    /**
     * @param string $coinType
     * @param int|null $smartContractName
     * @param int|null $isSplit
     * @return mixed
     */
    public function getDepositAddress(string $coinType,int $smartContractName = null ,int $isSplit = null ){
        $this->connection->url = '/balance/deposit/address/'.$coinType;
        $this->connection->params = [
            'smart_contract_name' => $smartContractName,
            'is_split'=>$isSplit
        ];
        return $this->prepareResult($this->connection->send());
    }

    /*
    * https://github.com/coinexcom/coinex_exchange_api/wiki/073generate_new_deposit_address
    */
    /**
     * @param string $coinType
     * @param int|null $smartContractName
     * @return mixed
     */
    public function generateDepositAddress(string $coinType,int $smartContractName = null  ){
        $this->connection->url = '/balance/deposit/address/'.$coinType;
        $this->connection->method = 'PUT';
        $this->connection->params = [
            'smart_contract_name' => $smartContractName
        ];
        return $this->prepareResult($this->connection->send());
    }

    /*
    * https://github.com/coinexcom/coinex_exchange_api/wiki/074sub_account_balance
    */
    /**
     * @param string|null $coinType
     * @param int|null $subUserName
     * @return mixed
     */
    public function subAccountBalance(string $coinType = null,int $subUserName = null  ){
        $this->connection->url = '/sub_account/balance';
        $this->connection->params = [
            'coin_type'=>$coinType,
            'sub_user_name' => $subUserName
        ];
        return $this->prepareResult($this->connection->send());
    }

    /*
    * https://github.com/coinexcom/coinex_exchange_api/wiki/074sub_account_balance
    */
    /**
     * @param string|null $coinType
     * @param int|null $subUserName
     * @param int|null $page
     * @param int|null $limit
     * @return mixed
     */
    public function balanceTransferHistory(string $coinType = null,int $subUserName = null ,int $page = null , int $limit = null ){
        $this->connection->url = '/sub_account/balance';
        $this->connection->params = [
            'coin_type'=>$coinType,
            'sub_user_name' => $subUserName,
            'page' => $page,
            'limit' => $limit
        ];
        return $this->prepareResult($this->connection->send());
    }

    /*
    * https://github.com/coinexcom/coinex_exchange_api/wiki/100acquire_credit_account_info
    */
    public function acquireCreditAccountInfo(){
        $this->connection->url = '/credit/info';
        return $this->prepareResult($this->connection->send());
    }

    /*
    * https://github.com/coinexcom/coinex_exchange_api/wiki/099get_transfer_history_list
    */
    /**
     * @param string|null $startTime format : YY-mm-dd hh:MM
     * @param string|null $endTime format : YY-mm-dd hh:MM
     * @param string|null $transferType
     * @param string|null $asset
     * @param int|null $page
     * @param int|null $limit
     * @return mixed
     */
    public function inquireTransferHistoryList(string $startTime = null ,string $endTime = null,string $transferType = null,string $asset = null ,int $page = null , int $limit = null ){
        $this->connection->url = '/sub_account/balance';
        $this->connection->params = [
            
            'page' => $page,
            'limit' => $limit,
            'transfer_type' => $transferType,
            'asset' =>$asset,
            'start_time' => $startTime,
            'end_time' => $endTime
        ];
        return $this->prepareResult($this->connection->send());
    }

    /*
    * https://github.com/coinexcom/coinex_exchange_api/wiki/0101margin_transfer_history_list
    */
    /**
     * @param string|null $market
     * @param int|null $startTime Timestamp
     * @param int|null $endTime Timestamp
     * @param string|null $transferType
     * @param string|null $asset
     * @param int|null $page
     * @param int|null $limit
     * @return mixed
     */
    public function inquireMarginTransferHistoryList(string $accessId,string $market = null ,int $startTime = null ,int $endTime = null,string $transferType = null,string $asset = null ,int $page = null , int $limit = null ){
        $this->connection->url = '/margin/transfer/history';
        $this->connection->params = [
            
            'page' => $page,
            'limit' => $limit,
            'transfer_type' => $transferType,
            'asset' =>$asset,
            'start_time' => $startTime,
            'end_time' => $endTime,
            'market' => $market
        ];
        return $this->prepareResult($this->connection->send());
    }

    /*
    * https://github.com/coinexcom/coinex_exchange_api/wiki/0102investment_transfer_history_list
    */
    /**
     * @param int|null $startTime
     * @param int|null $endTime
     * @param string|null $opType
     * @param string|null $asset
     * @param int|null $page
     * @param int|null $limit
     * @return mixed
     */
    public function inquireInvestmentTransferHistoryList(string $accessId,int $startTime = null ,int $endTime = null,string $opType = null,string $asset = null ,int $page = null , int $limit = null ){
        $this->connection->url = '/investment/transfer/history';
        $this->connection->params = [
            
            'page' => $page,
            'limit' => $limit,
            'op_type' => $opType,
            'asset' =>$asset,
            'start_time' => $startTime,
            'end_time' => $endTime
        ];
        return $this->prepareResult($this->connection->send());
    }


}