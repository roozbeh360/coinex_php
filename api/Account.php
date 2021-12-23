<?php


namespace Roozbeh\CoinexPhp;

use phpDocumentor\Reflection\Types\Integer;

class Account
{
    use Initiator\Api;

    /*
     * https://github.com/coinexcom/coinex_exchange_api/wiki/060balance
     */
    /**
     * @param string $accessId
     * @param int $tonce
     * @return mixed
     */
    public function AcquireAssetConfig(string $accessId ,int $tonce){
        $this->connection->url = '/balance/info';
        $this->connection->params = ['access_id'=>$accessId,'tonce'=>$tonce];
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
     * @param string $accessId
     * @param int $tonce
     * @param string|null $coinType
     * @param int|null $coinWithdrawId
     * @param int|null $page
     * @param int|null $limit
     * @return mixed
     */
    public function inquireWithdrawalList(string $accessId ,int $tonce,string $coinType = null,int $coinWithdrawId = null,int $page = null,int $limit = null){
        $this->connection->url = '/balance/info';
        $this->connection->params = [
            'access_id'=>$accessId,
            'tonce'=>$tonce,
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
     * @param string $accessId
     * @param int $tonce
     * @param string $market
     * @param string|null $businessType
     * @return mixed
     */
    public function inquireMarketFee(string $accessId ,int $tonce,string $market,string $businessType = null){
        $this->connection->url = '/account/market/fee';
        $this->connection->params = [
            'access_id'=>$accessId,
            'tonce'=>$tonce,
            'business_type'=>$businessType,
            'market'=>$market
        ];
        return $this->prepareResult($this->connection->send());
    }

    /*
     * https://github.com/coinexcom/coinex_exchange_api/wiki/062submit_withdraw
     */
    /**
     * @param string $accessId
     * @param int $tonce
     * @param string $coinType
     * @param string $coinAddress
     * @param string $transferMethod
     * @param string $actualAmount
     * @param string|null $smartContractName
     * @return mixed
     */
    public function submitWithdrawalOrder(string $accessId ,int $tonce,string $coinType,string $coinAddress,string $transferMethod,string $actualAmount ,string $smartContractName = null){
        $this->connection->url = '/balance/coin/withdraw';
        $this->connection->method = 'POST';
        $this->connection->params = [
            'access_id'=>$accessId,
            'tonce'=>$tonce,
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
     * @param string $accessId
     * @param int $tonce
     * @param int $coinWithdrawId
     * @return mixed
     */
    public function cancelWithdrawal(string $accessId ,int $tonce,int $coinWithdrawId){
        $this->connection->url = '/balance/coin/withdraw';
        $this->connection->method = 'DELETE';
        $this->connection->params = [
            'access_id'=>$accessId,
            'tonce'=>$tonce,
            'coin_withdraw_id'=>$coinWithdrawId
        ];
        return $this->prepareResult($this->connection->send());
    }

    /*
     * https://github.com/coinexcom/coinex_exchange_api/wiki/065get_deposit_list
     */
    public function inquireDepositList(string $accessId ,int $tonce,string $coinType = null,string $status = null,int $page = null,int $limit = null){
        $this->connection->url = '/balance/coin/deposit';
        $this->connection->params = [
            'access_id'=>$accessId,
            'tonce'=>$tonce,
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
    public function transferBetweenMainAccountAndSubAccount(string $accessId ,int $tonce,string $coinType ,string $amount ,string $transferAccount = null ,string $transferSide = null){
        $this->connection->url = '/sub_account/transfer';
        $this->connection->method = 'POST';
        $this->connection->params = [
            'access_id'=>$accessId,
            'tonce'=>$tonce,
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
    public function transferBetweenMainAccountAndMarginAccount(string $accessId ,int $tonce,string $coinType ,string $amount ,string $fromAccount ,string $toAccount ){
        $this->connection->url = '/margin/transfer';
        $this->connection->method = 'POST';
        $this->connection->params = [
            'access_id'=>$accessId,
            'tonce'=>$tonce,
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
    public function getDepositAddress(string $accessId ,int $tonce,string $coinType,int $smartContractName = null ,int $isSplit = null ){
        $this->connection->url = '/balance/deposit/address/'.$coinType;
        $this->connection->params = [
            'access_id'=>$accessId,
            'tonce'=>$tonce,
            'smart_contract_name' => $smartContractName,
            'is_split'=>$isSplit
        ];
        return $this->prepareResult($this->connection->send());
    }

    /*
    * https://github.com/coinexcom/coinex_exchange_api/wiki/073generate_new_deposit_address
    */
    public function generateDepositAddress(string $accessId ,int $tonce,string $coinType,int $smartContractName = null  ){
        $this->connection->url = '/balance/deposit/address/'.$coinType;
        $this->connection->method = 'PUT';
        $this->connection->params = [
            'access_id'=>$accessId,
            'tonce'=>$tonce,
            'smart_contract_name' => $smartContractName
        ];
        return $this->prepareResult($this->connection->send());
    }

    /*
    * https://github.com/coinexcom/coinex_exchange_api/wiki/074sub_account_balance
    */
    public function subAccountBalance(string $accessId ,int $tonce,string $coinType = null,int $subUserName = null  ){
        $this->connection->url = '/sub_account/balance';
        $this->connection->params = [
            'access_id'=>$accessId,
            'tonce'=>$tonce,
            'coin_type'=>$coinType,
            'sub_user_name' => $subUserName
        ];
        return $this->prepareResult($this->connection->send());
    }

    /*
    * https://github.com/coinexcom/coinex_exchange_api/wiki/074sub_account_balance
    */
    public function balanceTransferHistory(string $accessId ,int $tonce,string $coinType = null,int $subUserName = null ,int $page = null , int $limit = null ){
        $this->connection->url = '/sub_account/balance';
        $this->connection->params = [
            'access_id'=>$accessId,
            'tonce'=>$tonce,
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
     * @param string $accessId
     * @param string|null $startTime format : YY-mm-dd hh:MM
     * @param string|null $endTime format : YY-mm-dd hh:MM
     * @param string|null $transferType
     * @param string|null $asset
     * @param int|null $page
     * @param int|null $limit
     * @return mixed
     */
    public function inquireTransferHistoryList(string $accessId ,string $startTime = null ,string $endTime = null,string $transferType = null,string $asset = null ,int $page = null , int $limit = null ){
        $this->connection->url = '/sub_account/balance';
        $this->connection->params = [
            'access_id'=>$accessId,
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
     * @param string $accessId
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
            'access_id'=>$accessId,
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
    public function inquireInvestmentTransferHistoryList(string $accessId,int $startTime = null ,int $endTime = null,string $opType = null,string $asset = null ,int $page = null , int $limit = null ){
        $this->connection->url = '/investment/transfer/history';
        $this->connection->params = [
            'access_id'=>$accessId,
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