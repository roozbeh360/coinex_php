<?php


namespace Roozbeh\CoinexPhp;


class Contract
{
    use Initiator\Api;


    /*
     * https://github.com/coinexcom/coinex_exchange_api/wiki/091balance_transfer
     */
    /**
     * @param string $transfer_side
     * @param string $coinType
     * @param string $amount
     * @return mixed
     */
    public function placeFlat(string $transfer_side,string $coinType ,string  $amount ){
        $this->connection->url = '/contract/balance/transfer';
        $this->connection->method = 'POST';
        $this->connection->params = [
            'transfer_side' => $transfer_side,
            'coin_type' => $coinType,
            'amount' => $amount
        ];
        return $this->prepareResult($this->connection->send());
    }

}