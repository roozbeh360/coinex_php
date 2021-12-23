<?php


namespace Roozbeh\CoinexPhp;


class Margin
{
    use Initiator\Api;

    /*
     * https://github.com/coinexcom/coinex_exchange_api/wiki/081margin_account
     */
    /**
     * @param string $accessId
     * @param int $tonce
     * @param string $market
     * @return mixed
     */
    public function inquireMarginAccountInfo(string $accessId, int $tonce, string $market){
        $this->connection->url = '/margin/account';
        $this->connection->params = [
            'access_id'=>$accessId,
            'tonce' => $tonce,
            'market' => $market
        ];
        return $this->prepareResult($this->connection->send());
    }

    /*
     * https://github.com/coinexcom/coinex_exchange_api/wiki/082margin_single_account
     */
    /**
     * @param string $accessId
     * @param int $tonce
     * @param string $market
     * @return mixed
     */
    public function inquireMarginAccountofACurrency(string $accessId, int $tonce, string $market){
        $this->connection->url = '/margin/account';
        $this->connection->params = [
            'access_id'=>$accessId,
            'tonce' => $tonce,
            'market' => $market
        ];
        return $this->prepareResult($this->connection->send());
    }

    /*
     * https://github.com/coinexcom/coinex_exchange_api/wiki/083margin_account_settings
     */
    public function acquireMarginAccountSettings(string $accessId, int $tonce){
        $this->connection->url = '/margin/config';
        $this->connection->params = [
            'access_id'=>$accessId,
            'tonce' => $tonce
        ];
        return $this->prepareResult($this->connection->send());
    }

    /*
     * https://github.com/coinexcom/coinex_exchange_api/wiki/084margin_single_account_settings
     */
    /**
     * @param string $accessId
     * @param int $tonce
     * @param string $market
     * @return mixed
     */
    public function acquireMarginAccountSettingsofACurrency(string $accessId, int $tonce,string $market){
        $this->connection->url = '/margin/config';
        $this->connection->params = [
            'access_id'=>$accessId,
            'tonce' => $tonce,
            'market' => $market
        ];
        return $this->prepareResult($this->connection->send());
    }

    /*
     * https://github.com/coinexcom/coinex_exchange_api/wiki/085margin_loan_history
     */
    /**
     * @param string $accessId
     * @param int $tonce
     * @param string|null $market
     * @param string|null $status
     * @param int|null $page
     * @param int|null $limit
     * @return mixed
     */
    public function acquireLoanList(string $accessId, int $tonce,string $market = null,string $status = null,int $page = null,int $limit = null){
        $this->connection->url = '/margin/loan/history';
        $this->connection->params = [
            'access_id'=>$accessId,
            'tonce' => $tonce,
            'market' => $market,
            'status' => $status,
            'page' => $page,
            'limit' => $limit
        ];
        return $this->prepareResult($this->connection->send());
    }

    /*
     * https://github.com/coinexcom/coinex_exchange_api/wiki/086margin_loan
     */
    /**
     * @param string $accessId
     * @param int $tonce
     * @param string $market
     * @param string $coinType
     * @param string $amount
     * @param bool|null $renew
     * @return mixed
     */
    public function placeLoan(string $accessId, int $tonce,string $market,string $coinType ,string  $amount ,bool $renew = null ){
        $this->connection->url = '/margin/loan';
        $this->connection->method = 'POST';
        $this->connection->params = [
            'access_id'=>$accessId,
            'tonce' => $tonce,
            'market' => $market,
            'coin_type' => $coinType,
            'amount' => $amount,
            'renew' => $renew
        ];
        return $this->prepareResult($this->connection->send());
    }

    /*
     * https://github.com/coinexcom/coinex_exchange_api/wiki/087margin_flat
     */
    /**
     * @param string $accessId
     * @param int $tonce
     * @param string $market
     * @param string $coinType
     * @param string $amount
     * @param int|null $loanId
     * @return mixed
     */
    public function placeFlat(string $accessId, int $tonce,string $market,string $coinType ,string  $amount ,int $loanId = null ){
        $this->connection->url = '/margin/loan';
        $this->connection->method = 'POST';
        $this->connection->params = [
            'access_id'=>$accessId,
            'tonce' => $tonce,
            'market' => $market,
            'coin_type' => $coinType,
            'amount' => $amount,
            'loan_id' => $loanId
        ];
        return $this->prepareResult($this->connection->send());
    }

}